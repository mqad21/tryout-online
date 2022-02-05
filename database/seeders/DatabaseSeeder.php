<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call([
            RolesTableSeeder::class,
            RegionsTableSeeder::class,
            UsersTableSeeder::class,
            QuestionCategoriesTableSeeder::class,
            QuestionsTableSeeder::class,
            QuestionOptionsTableSeeder::class,
            TryOutsTableSeeder::class,
            QuestionTryOutTableSeeder::class,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
