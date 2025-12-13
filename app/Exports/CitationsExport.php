<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CitationsExport implements FromCollection, WithHeadings
{
    protected $data;

    /**
     * Accepts a collection of citations directly
     */
    public function __construct($data)
    {
        $this->data = $data;
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
                'Group Name' => $item->group_name ?? 'N/A',
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
            'Group Name',
            'Period',
            'Citation',
            'Created At',
        ];
    }
}
