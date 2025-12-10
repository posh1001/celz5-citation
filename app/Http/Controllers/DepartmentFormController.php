<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentForm;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CitationsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class DepartmentFormController extends Controller
{
    /**
     * Show the department form.
     */
    public function create()
    {
        return view('department-form');
    }

    /**
     * Store the department form submission.
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
                    if (str_word_count($value) > 150) {
                        $fail("The $attribute may not be greater than 150 words.");
                    }
                },
            ],
        ]);

        DepartmentForm::create($validated);

        return redirect()->back()->with('success', 'Department Form submitted successfully!');
    }

    /**
     * Display dashboard + citations list with search.
     */
    public function index(Request $request)
    {
        $query = DepartmentForm::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('fullname', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('unit', 'like', "%{$search}%")
                  ->orWhere('designation', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('kingschat', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('citation', 'like', "%{$search}%");
            });
        }

        // Paginated citations
        $citations = $query->latest()->paginate(10)->withQueryString();

        // Dashboard statistics
        $departmentsCount = DepartmentForm::distinct('department')->count('department');
        $citationsCount = DepartmentForm::count();

        return view('citations', compact(
            'citations',
            'departmentsCount',
            'citationsCount'
        ));
    }

    /**
     * Export to Excel.
     */
    public function exportExcel()
    {
        return Excel::download(new CitationsExport, 'department_forms.xlsx');
    }

    /**
     * Export to CSV.
     */
    public function exportCSV()
    {
        return Excel::download(new CitationsExport, 'department_forms.csv');
    }

    /**
     * Export to PDF.
     */
    public function exportPDF()
    {
        $citations = DepartmentForm::latest()->get();

        $pdf = Pdf::loadView('exports.citations_pdf', [
            'citations' => $citations
        ]);

        return $pdf->download('citations.pdf');
    }
}
