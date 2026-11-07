<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus angka ranking lama yang tidak memiliki sumber/tahun terverifikasi.
        DB::table('universities')->update([
            'ranking' => null,
            'ranking_source' => null,
            'ranking_year' => null,
            'ranking_category' => null,
            'ranking_url' => null,
        ]);

        $sourceUrl = 'https://www.topuniversities.com/world-university-rankings?countries=id&order_by=asc&sort_by=rank';

        $verified = [
            'universitas indonesia' => [191, 'Peringkat dunia #191', $sourceUrl],
            'universitas gadjah mada' => [206, 'Peringkat dunia #206', $sourceUrl],
            'institut teknologi bandung' => [287, 'Peringkat dunia #287', $sourceUrl],
            'ipb university' => [419, 'Peringkat dunia #419', $sourceUrl],
            'universitas padjadjaran' => [496, 'Peringkat dunia #496', $sourceUrl],
            'institut teknologi sepuluh nopember' => [497, 'Peringkat dunia #497', $sourceUrl],
            'telkom university' => [1201, 'Peringkat dunia 1201–1400', $sourceUrl],
            'universitas pendidikan indonesia' => [1401, 'Peringkat dunia 1401+', $sourceUrl],
        ];

        foreach ($verified as $name => [$rank, $display, $url]) {
            DB::table('universities')
                ->whereRaw('LOWER(TRIM(name)) = ?', [$name])
                ->update([
                    'ranking' => $rank, // batas bawah untuk pengurutan numerik
                    'ranking_source' => 'QS',
                    'ranking_year' => 2027,
                    'ranking_category' => $display,
                    'ranking_url' => $url,
                ]);
        }
    }

    public function down(): void
    {
        // Ranking sebelumnya tidak dipulihkan karena berisi angka yang tidak terverifikasi.
        DB::table('universities')->update([
            'ranking' => null,
            'ranking_source' => null,
            'ranking_year' => null,
            'ranking_category' => null,
            'ranking_url' => null,
        ]);
    }
};
