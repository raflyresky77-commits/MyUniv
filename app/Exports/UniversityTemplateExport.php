<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UniversityTemplateExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'name', 'type', 'location', 'website', 'description',
            'ranking', 'ranking_source', 'ranking_year', 'ranking_category',
            'ranking_url', 'accreditation', 'branch_notes',
        ];
    }

    public function array(): array
    {
        return [[
            'Universitas Contoh', 'PTN', 'Bandung', 'https://contoh.ac.id',
            'Deskripsi singkat universitas', '', '', '', '', '', '', '',
        ]];
    }
}
