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
        // $this->call(UsersTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(PaketSeeder::class);
        $this->call(SoalSeeder::class);
        $this->call(PesertaSeeder::class);
    }
}
