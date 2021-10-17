<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;


class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            "name"=>"Lix Compan",
            "nit"=>"89008888-1",
            "email"=>"lix@gmail.com",
            "telephone"=>"4444444",
            "address"=>"call vista linda",
        ]);

        Company::create([
            "name"=>"Mx Compan",
            "nit"=>"890034232-1",
            "email"=>"mx@gmail.com",
            "telephone"=>"53453253",
            "address"=>"calle  33 # 44-66",
        ]);

        Company::create([
            "name"=>"Flign Compan",
            "nit"=>"890777-1",
            "email"=>"Flign@gmail.com",
            "telephone"=>"4444444",
            "address"=>"Carrera 33 # 74-6016",
        ]);

       
    }
}
