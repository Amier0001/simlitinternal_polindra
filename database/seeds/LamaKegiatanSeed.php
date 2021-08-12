<?php

use Illuminate\Database\Seeder;
use App\Models\Lama_kegiatan;

class LamaKegiatanSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lama_kegiatan::create([
            'lama_kegiatan_tahun' => 1
        ]);

        Lama_kegiatan::create([
            'lama_kegiatan_tahun' => 2
        ]);
    }
}