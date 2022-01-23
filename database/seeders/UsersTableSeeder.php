<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use JeroenZwart\CsvSeeder\CsvSeeder;


class UsersTableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->delimiter = ',';
        $this->file = '/database/seeders/csvs/users.csv';
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
