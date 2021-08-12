<?php

use Illuminate\Database\Seeder;

use App\Models\Unlock_feature;

class UnlockFeatureSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unlock_feature::create([
            'unlock_feature_name' => 'tambah_usulan_pengabdian',
            'unlock_feature_start_year' => date('Y'),
            'unlock_feature_end_year' => date('Y'),
            'unlock_feature_start_time' => date('Y-m-d H:i:s'),
            'unlock_feature_end_time' => date('Y-m-d H:i:s'),
        ]);

        Unlock_feature::create([
            'unlock_feature_name' => 'nilai_usulan_pengabdian',
            'unlock_feature_start_year' => date('Y'),
            'unlock_feature_end_year' => date('Y'),
            'unlock_feature_start_time' => date('Y-m-d H:i:s'),
            'unlock_feature_end_time' => date('Y-m-d H:i:s'),
        ]);
    }
}
