<?php

namespace Database\Seeders;

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
        $this->call(AreasTableSeeder::class);
        $this->call(SeederRolesC3::class);
        $this->call(SeederPermisosC3::class);
        $this->call(UserSeeder::class);
        $this->call(EvaluadosSeeder::class);
    }
}
