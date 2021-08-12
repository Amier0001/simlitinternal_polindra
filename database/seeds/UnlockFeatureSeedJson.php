<?php

use Illuminate\Database\Seeder;

class UnlockFeatureSeedJson extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destination = base_path('local_db/unlock_feature.json');

        // Data
        $data = [
            [
                'id' => uniqid(),
                'name'     => "tambah_usulan_pengabdian",
                'start_year'   => date('Y'),
                'end_year' => date('Y'),
                'start_time' => date('Y-m-d H:i:s'),
                'end_time' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => uniqid(),
                'name'     => "nilai_usulan_pengabdian",
                'start_year'   => date('Y'),
                'end_year' => date('Y'),
                'start_time' => date('Y-m-d H:i:s'),
                'end_time' => date('Y-m-d H:i:s'),
            ],
        ];

        // Mengencode data menjadi json
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);

        // Menyimpan data ke dalam anggota.json
        file_put_contents($destination, $jsonfile);
    }
}
