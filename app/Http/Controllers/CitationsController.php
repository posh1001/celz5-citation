<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Exports\CitationsExport;
use App\Models\DepartmentForm;
use App\Models\GroupForm;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class CitationsController extends Controller
{
    /**
     * Display dashboard with both department and group forms.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // -------------------------
        // Departments Table
        // -------------------------
        $departmentsQuery = DepartmentForm::query();

        if ($search) {
            $departmentsQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('fullname', 'like', "%{$search}%")
                  ->orWhere('unit', 'like', "%{$search}%")
                  ->orWhere('designation', 'like', "%{$search}%")
                  ->orWhere('kingschat', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('period', 'like', "%{$search}%")
                  ->orWhere('citation', 'like', "%{$search}%");
            });
        }

        $departments = $departmentsQuery->orderByDesc('created_at')
            ->paginate(10, ['*'], 'departmentsPage');

        // -------------------------
        // Groups Table
        // -------------------------
        $groupsQuery = GroupForm::query();

        if ($search) {
            $groupsQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('fullname', 'like', "%{$search}%")
                  ->orWhere('unit', 'like', "%{$search}%")
                  ->orWhere('designation', 'like', "%{$search}%")
                  ->orWhere('kingschat', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('group_name', 'like', "%{$search}%")
                  ->orWhere('period', 'like', "%{$search}%")
                  ->orWhere('citation', 'like', "%{$search}%");
            });
        }

        $groups = $groupsQuery->orderByDesc('created_at')
            ->paginate(10, ['*'], 'groupsPage');

        // -------------------------
        // Counts
        // -------------------------
        $departmentsCount = DepartmentForm::count();
        $groupsCount = GroupForm::count();
        $citationsCount = $departmentsCount + $groupsCount;

        // -------------------------
        // Return view with both tables
        // -------------------------
        return view('citations', [
            'departmentCitations' => $departments,
            'groupCitations' => $groups,
            'departmentsCount' => $departmentsCount,
            'groupsCount' => $groupsCount,
            'citationsCount' => $citationsCount,
            'filter' => 'all',
        ]);
    }

    // ------------------- EXPORT METHODS -------------------

    public function exportExcel(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $data = $this->getFilteredData($filter);
        return Excel::download(new CitationsExport($data), $filter.'_citations.xlsx');
    }

    public function exportCSV(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $data = $this->getFilteredData($filter);
        return Excel::download(new CitationsExport($data), $filter.'_citations.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportPDF(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $data = $this->getFilteredData($filter);
        return Pdf::loadView('exports.citations_pdf', ['citations' => $data])->download($filter.'_citations.pdf');
    }

    public function exportWord(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $data = $this->getFilteredData($filter);

        $export = new CitationsExport($data);
        $rows = $export->collection()->toArray();
        $headers = $export->headings();

        $phpWord = new PhpWord;
        $section = $phpWord->addSection();
        $section->addText(ucfirst($filter).' Citations Report', ['bold' => true, 'size' => 16]);

        $phpWord->addTableStyle('CitationsTable', [
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80,
        ]);

        $table = $section->addTable('CitationsTable');

        // Header row
        $table->addRow();
        foreach ($headers as $header) {
            $table->addCell(2000)->addText($header, ['bold' => true]);
        }

        // Data rows
        foreach ($rows as $row) {
            $table->addRow();
            foreach ($row as $cell) {
                $table->addCell(2000)->addText($cell ?? 'N/A');
            }
        }

        $fileName = $filter.'_citations.docx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        IOFactory::createWriter($phpWord, 'Word2007')->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    /**
     * Helper: get data based on filter
     */
    private function getFilteredData($filter)
    {
        if ($filter === 'departments') {
            return DepartmentForm::all();
        } elseif ($filter === 'groups') {
            return GroupForm::all();
        } else {
            return DepartmentForm::all()->merge(GroupForm::all())->map(function ($item) {
                $item->created_at = Carbon::parse($item->created_at);
                return $item;
            });
        }
    }
}
