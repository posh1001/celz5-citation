<?php

namespace App\Http\Controllers;

use App\Models\Citation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CitationsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class CitationDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Card counts
        $departmentsCount = Citation::distinct('unit')->count();
        $groupsCount = Citation::distinct('groups')->count();
        $citationsCount = Citation::count();

        // Table query with search
        $query = Citation::query();
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('title', 'like', "%$s%")
                  ->orWhere('name', 'like', "%$s%")
                  ->orWhere('unit', 'like', "%$s%")
                  ->orWhere('groups', 'like', "%$s%")
                  ->orWhere('designation', 'like', "%$s%")
                  ->orWhere('handle', 'like', "%$s%");
            });
        }

        $citations = $query->orderBy('created_at', 'desc')
                           ->paginate(10)
                           ->withQueryString();

        return view('dashboard', compact(
            'citations', 'departmentsCount', 'groupsCount', 'citationsCount'
        ));
    }

    // Export CSV
    public function exportCsv()
    {
        return Excel::download(new CitationsExport, 'citations.csv');
    }

    // Export Excel
    public function exportExcel()
    {
        return Excel::download(new CitationsExport, 'citations.xlsx');
    }

    // Export PDF
    public function exportPdf()
    {
        $citations = Citation::all();
        $pdf = Pdf::loadView('admin.exports.citations_pdf', compact('citations'));
        return $pdf->download('citations.pdf');
    }

    // Show single citation (optional)
    public function show($id)
    {
        $citation = Citation::findOrFail($id);
        return view('dashboard', compact('citation'));
    }

    // Delete citation
    public function destroy($id)
    {
        $citation = Citation::findOrFail($id);
        $citation->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Citation deleted.');
    }
}
