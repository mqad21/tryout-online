<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class RegionsTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->delimiter = ',';
        $this->file = '/database/seeders/csvs/regions.csv';
        $this->timestamps = false;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        parent::run();
    }
}
