<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::first();

        $company->users()->create([
            'company_id' => Company::first()->id,
            'name'       => 'Bruno Oliveira',
            'email'      => 'admin@admin.com.br',
            'password'   => bcrypt('teste123'),
        ]);
    }
}
