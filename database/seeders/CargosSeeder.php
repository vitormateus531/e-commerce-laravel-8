<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CargosModel;



class CargosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data_array = [
            [
                'id' => 1,
                'nome' => 'Caixa',
            ],
            [
                'id' => 2,
                'nome' => 'Gerente',
            ],
            [
                'id' => 3,
                'nome' => 'Estoquista',
            ],
        ];

        foreach($data_array as $data)
        {
            CargosModel::firstOrCreate(['id' => $data['id']], $data);
        }
    }
}
