<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->companies()->create([
            'cnpj'    => '64996965000169',
            'name'    => 'Empresa Teste',
            'url'     => 'empresa-teste',
            'email'   => 'empresa.teste@gmail.com',
        ]);
    }
}
