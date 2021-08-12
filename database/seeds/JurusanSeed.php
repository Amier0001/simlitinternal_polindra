<?php

use Illuminate\Database\Seeder;

use App\Models\Jurusan;
use App\Models\Prodi;

class JurusanSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Teknik Informatika
        $query = Jurusan::create([
            'jurusan_nama' => "Teknik Informatika"
        ]);

        Prodi::create([
            'prodi_jurusan_id' => $query->jurusan_id,
            'prodi_nama' => "D3 Teknik Informatika"
        ]);

        Prodi::create([
            'prodi_jurusan_id' => $query->jurusan_id,
            'prodi_nama' => "D4 Rekayasa Perangkat Lunak"
        ]);

        // Teknik Mesin
        $query = Jurusan::create([
            'jurusan_nama' => "Teknik Mesin"
        ]);

        Prodi::create([
            'prodi_jurusan_id' => $query->jurusan_id,
            'prodi_nama' => "D3 Teknik Mesin"
        ]);

        Prodi::create([
            'prodi_jurusan_id' => $query->jurusan_id,
            'prodi_nama' => "D4 Perancangan Manufaktur"
        ]);

        // Teknik Pendingin
        $query = Jurusan::create([
            'jurusan_nama' => "Teknik Pendingin Dan Tata Udara"
        ]);

        Prodi::create([
            'prodi_jurusan_id' => $query->jurusan_id,
            'prodi_nama' => "D3 Teknik Pendingin Dan Tata Udara"
        ]);

        // Keperawatan
        $query = Jurusan::create([
            'jurusan_nama' => "Keperawatan"
        ]);

        Prodi::create([
            'prodi_jurusan_id' => $query->jurusan_id,
            'prodi_nama' => "D3 Keperawatan"
        ]);
    }
}
