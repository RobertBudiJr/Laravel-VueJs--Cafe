<?php

namespace Database\Seeders;

use App\Models\Meja;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mejas = [
            [
                'nomor_meja' => '14',
                'status_meja' => '1'
            ],
            [
                'nomor_meja' => '15',
                'status_meja' => '1'
            ],
            [
                'nomor_meja' => '24',
                'status_meja' => '2'
            ],
            [
                'nomor_meja' => '25',
                'status_meja' => '2'
            ],
        ];

        foreach ($mejas as $key => $meja) {
            Meja::create($meja);
        }
    }
}
