<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeed::class);
        $this->call(JurusanSeed::class);
        $this->call(BidangSeed::class);
        $this->call(SkemaSeed::class);
        $this->call(LamaKegiatanSeed::class);
        $this->call(UnlockFeatureSeed::class);

        $this->call(UnlockFeatureSeedJson::class);
        $this->call(TemplateDokumenSeedJson::class);
        $this->call(WilayahIndonesiaSeed::class);
    }
}
