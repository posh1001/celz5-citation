<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupForm;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CitationsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class GroupFormController extends Controller
{
    /**
     * Show the form for creating a group submission.
     */
    public function create()
    {
        return view('group-form');
    }

    /**
     * Store a new group submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'fullname' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'designation' => 'required|string|max:100',
            'kingschat' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'department' => 'required|string|max:255',
            'period' => 'required|string|max:50',
            'citation' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $wordCount = str_word_count($value);
                    if ($wordCount > 150) {
                        $fail("The $attribute may not be greater than 150 words. Current word count: $wordCount.");
                    }
                },
            ],
        ]);

        GroupForm::create($validated);

        return redirect()->back()->with('success', 'Group Form submitted successfully!');
    }

    /**
     * Display all group submissions (for dashboard).
     */
    public function index(Request $request)
    {
        $query = GroupForm::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('fullname', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('unit', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%");
        }

        $submissions = $query->latest()->get();

        $departmentsCount = GroupForm::distinct('department')->count('department');
        $citationsCount = GroupForm::count();

        return view('citations', compact(
            'submissions',
            'departmentsCount',
            'citationsCount'
        ));
    }

    /**
     * Export group submissions as Excel.
     */
    public function exportExcel()
    {
        $submissions = GroupForm::latest()->get();
        return Excel::download(new CitationsExport($submissions), 'group_citations.xlsx');
    }

    /**
     * Export group submissions as CSV.
     */
    public function exportCSV()
    {
        $submissions = GroupForm::latest()->get();
        return Excel::download(new CitationsExport($submissions), 'group_citations.csv');
    }

    /**
     * Export group submissions as PDF.
     */
    public function exportPDF()
    {
        $submissions = GroupForm::latest()->get();
        $pdf = Pdf::loadView('group_citations_pdf', compact('submissions'));
        return $pdf->download('group_citations.pdf');
    }

    /**
     * Export group submissions as Word document.
     */
    public function exportWord()
    {
        $submissions = GroupForm::latest()->get();
        $export = new CitationsExport($submissions);
        $data = $export->collection()->toArray();
        $headers = $export->headings();

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();

        $section->addText("Group Citations", ['bold' => true, 'size' => 16]);

        $tableStyle = ['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 80];
        $phpWord->addTableStyle('CitationsTable', $tableStyle);
        $table = $section->addTable('CitationsTable');

        // Header row
        $table->addRow();
        foreach ($headers as $header) {
            $table->addCell(2000)->addText($header, ['bold' => true]);
        }

        // Data rows
        foreach ($data as $row) {
            $table->addRow();
            foreach ($row as $cell) {
                $table->addCell(2000)->addText($cell);
            }
        }

        $fileName = 'group_citations.docx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}
