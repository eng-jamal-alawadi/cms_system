<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //     Admin::factory(10)->create();

    $admin =Admin::create([
        'name'=>'Super Admin',
        'active'=>'1',
        'email'=>'admin@cms.com',
        'password'=>bcrypt('123456789'),

        ]);
        $admin->assignRole('Super-Admin');


    }

}
