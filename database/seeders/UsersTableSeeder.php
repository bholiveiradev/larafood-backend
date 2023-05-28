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

        $user = $company->users()->create([
            'company_id' => Company::first()->id,
            'name'       => 'Bruno Oliveira',
            'email'      => 'admin@admin.com.br',
            'password'   => bcrypt('teste123'),
        ]);

        $role = $user->roles()->create([
            'name' => 'Admin',
            'description' => 'Administrador'
        ]);

        $role->permissions()->createMany([
            ['name' => 'users'],
            ['name' => 'categories'],
            ['name' => 'permissions']
        ]);
    }
}
