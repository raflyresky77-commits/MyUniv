<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MajorTemplateExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'name', 'description', 'category_id', 'university_name',
            'accreditation', 'additional_info',
        ];
    }

    public function array(): array
    {
        return [[
            'Sistem Informasi',
            'Mempelajari pengelolaan sistem dan teknologi informasi.',
            '',
            'Universitas Contoh',
            '',
            '',
        ]];
    }
}
