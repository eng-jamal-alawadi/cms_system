<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'Super-Admin', 'guard_name'=>'admin']);
        Role::create(['name'=>'Content-Admin', 'guard_name'=>'admin']);
        Role::create(['name'=>'HR-Admin', 'guard_name'=>'admin']);

    }
}
