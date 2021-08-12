<?php

use Illuminate\Database\Seeder;

class TemplateDokumenSeedJson extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destination = base_path('local_db/template_dokumen.json');

        // Data
        $data = [
            [
                'id' => uniqid() . strtotime(now()),
                'name'     => "dokumen_usulan",
                'original_name'   => '',
                'hash_name' => '',
                'base_name' => '',
                'extension' => '',
                'size' => '',
                'datetime' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => uniqid() . strtotime(now()),
                'name'     => "dokumen_rab",
                'original_name'   => '',
                'hash_name' => '',
                'base_name' => '',
                'extension' => '',
                'size' => '',
                'datetime' => date('Y-m-d H:i:s'),
            ],
        ];

        // Mengencode data menjadi json
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);

        // Menyimpan data ke dalam anggota.json
        file_put_contents($destination, $jsonfile);
    }
}