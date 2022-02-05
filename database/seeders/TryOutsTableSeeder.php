<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class TryOutsTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->delimiter = ',';
        $this->file = '/database/seeders/csvs/try_outs.csv';
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
