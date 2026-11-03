<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class QuestionTemplateExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        $headings = [
            'question_text',
            'type',
            'image_url',
        ];

        for ($i = 1; $i <= 10; $i++) {
            $headings[] = "option_{$i}";
            $headings[] = "score_{$i}";
            $headings[] = "interest_category_{$i}";
        }

        return $headings;
    }

    public function array(): array
    {
        return [
            [
                'Contoh pertanyaan numerik',
                'multiple_choice',
                '',
                'Pilihan A', 10, '',
                'Pilihan B', 20, '',
                'Pilihan C', 30, '',
                'Pilihan D', 40, '',
            ],
        ];
    }
}
