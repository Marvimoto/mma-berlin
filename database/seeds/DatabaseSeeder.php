<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i<10;$i++) {
            DB::table('trainer')->insert([
                'name' => str_random(8)
            ]);
        }
    }
}
