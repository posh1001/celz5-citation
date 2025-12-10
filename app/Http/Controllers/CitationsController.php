<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentForm;
use App\Exports\CitationsExport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

class CitationsController extends Controller
{
    /**
     * Display dashboard cards and paginated citations table.
     */
    public function index(Request $request)
    {
        $query = DepartmentForm::query();

        // Apply search filter if provided
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('fullname', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('unit', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('designation', 'like', "%{$search}%")
                  ->orWhere('kingschat', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('citation', 'like', "%{$search}%");
            });
        }

        // Paginate results with query string preservation
        $citations = $query->latest()->paginate(10)->withQueryString();

        // Dashboard counts
        $departmentsCount = DepartmentForm::whereNotNull('department')
            ->where('department', '!=', '')
            ->distinct('department')
            ->count('department');

        $citationsCount = DepartmentForm::count();

        return view('citations', compact('citations', 'departmentsCount', 'citationsCount'));
    }

    /**
     * Export all citations as Excel, CSV, or PDF.
     */
    public function export(Request $request)
    {
        $type = $request->query('type', 'excel');
        $all = (bool) $request->query('all', true);

        // Fetch data
        $citations = $all
            ? DepartmentForm::latest()->get()
            : DepartmentForm::latest()->paginate(50);

        switch ($type) {
            case 'csv':
                return Excel::download(new CitationsExport($citations), 'citations.csv', \Maatwebsite\Excel\Excel::CSV);

            case 'pdf':
                $pdf = Pdf::loadView('exports.citations_pdf', ['citations' => $citations]);
                return $pdf->download('citations.pdf');

            case 'excel':
            default:
                return Excel::download(new CitationsExport($citations), 'citations.xlsx');
        }
    }

    /**
     * Export all citations as a Word document.
     */
    public function exportWord()
    {
        $citations = DepartmentForm::latest()->get();
        $export = new CitationsExport($citations);

        $data = $export->collection()->toArray(); // array of rows
        $headers = $export->headings();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $section->addText("Citations Report", ['bold' => true, 'size' => 16]);

        // Table style
        $tableStyle = [
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80
        ];
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
                $table->addCell(2000)->addText($cell ?? 'N/A');
            }
        }

        // Prepare Word file
        $fileName = 'citations.docx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}
