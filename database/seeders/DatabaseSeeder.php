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
        
        // Seeders para serem usados em ambiente de Teste
        $this->call([
            CargosSeeder::class
        ]);
    }
}
