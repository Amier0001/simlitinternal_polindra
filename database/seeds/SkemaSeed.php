<?php

use Illuminate\Database\Seeder;

use App\Models\Skema;

class SkemaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skema::create([
            'skema_label' => "Penelitian Dasar"
        ]);

        Skema::create([
            'skema_label' => "Penelitian Dosen Pemula (PDP)"
        ]);

        Skema::create([
            'skema_label' => "Penelitian Kerjasama Perguruan Tinggi (PKPT)"
        ]);

        Skema::create([
            'skema_label' => "Penelitian Pengembangan"
        ]);

        Skema::create([
            'skema_label' => "Penelitian Terapan"
        ]);
    }
}
