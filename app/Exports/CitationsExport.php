<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class CitationsExport implements FromCollection, WithHeadings
{
    protected $citations;

    public function __construct($citations)
    {
        $this->citations = $citations;
    }

    public function collection()
    {
        return collect($this->citations)->map(function ($c) {
            $get = fn($key) => is_array($c) ? ($c[$key] ?? '') : ($c->$key ?? '');

            $createdAt = '';
            $rawDate = $get('created_at');
            if ($rawDate && strtotime($rawDate)) {
                try {
                    $createdAt = Carbon::parse($rawDate)->format('d-m-Y H:i');
                } catch (\Exception $e) {
                    $createdAt = '';
                }
            }

            return [
                'title'       => $get('title') ?: 'N/A',
                'fullname'    => $get('fullname') ?: 'N/A',
                'unit'        => $get('unit') ?: 'N/A',
                'designation' => $get('designation') ?: 'N/A',
                'kingschat'   => $get('kingschat') ?: 'N/A',
                'phone'       => $get('phone') ?: 'N/A',
                'department'  => $get('department') ?: 'N/A',
                'group'       => $get('group') ?: 'N/A',
                'period'      => $get('period') ?: 'N/A',
                'citation'    => $get('citation') ?: 'N/A',
                'created_at'  => $createdAt ?: 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Title.',
            'Full Name.',
            'Unit.',
            'Designation.',
            'Kingschat Handle.',
            'Phone.',
            'Department.',
            'Group.',
            'Period.',
            'Citation.',
            'Created At.',
        ];
    }
}
