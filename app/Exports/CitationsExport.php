<?php

namespace App\Exports;

use App\Models\Citation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CitationsExport implements FromCollection, WithHeadings
{
    protected $data;

    /**
     * Constructor to initialize export data.
     * Accepts 'departments', 'groups', or 'all'.
     */
    public function __construct(string $type = 'all')
    {
        if ($type === 'departments') {
            $this->data = Citation::whereNull('group_name')->get();
        } elseif ($type === 'groups') {
            $this->data = Citation::whereNotNull('group_name')->get();
        } else {
            $this->data = Citation::all();
        }
    }

    /**
     * Return the collection formatted for Excel/CSV.
     */
    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'Title' => $item->title ?? 'N/A',
                'Full Name' => $item->fullname ?? 'N/A',
                'Unit' => $item->unit ?? 'N/A',
                'Designation' => $item->designation ?? 'N/A',
                'Kingschat' => $item->kingschat ?? 'N/A',
                'Phone' => $item->phone ?? 'N/A',
                'Department' => $item->department ?? 'N/A',
                'Group_Name' => $item->group_name ?? 'N/A',
                'Period' => $item->period ?? 'N/A',
                'Citation' => $item->citation ?? 'N/A',
                'Created At' => $item->created_at ? $item->created_at->format('d-m-Y H:i') : 'N/A',
            ];
        });
    }

    /**
     * Column headers for Excel/CSV.
     */
    public function headings(): array
    {
        return [
            'Title',
            'Full Name',
            'Unit',
            'Designation',
            'Kingschat',
            'Phone',
            'Department',
            'Group_Name',
            'Period',
            'Citation',
            'Created At',
        ];
    }
}
