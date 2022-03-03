<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Permission::create(['name'=>'', 'guard_name'=>'']);

        // Permission::create(['name'=>'Read-', 'guard_name'=>'']);
        // Permission::create(['name'=>'Create-', 'guard_name'=>'']);
        // Permission::create(['name'=>'Update-', 'guard_name'=>'']);
        // Permission::create(['name'=>'Delete-', 'guard_name'=>'']);

        Permission::create(['name'=>'Read-Admin', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Create-Admin', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Admin', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Admin', 'guard_name'=>'admin']);

        Permission::create(['name'=>'Read-User', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Create-User', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Update-User', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-User', 'guard_name'=>'admin']);

        Permission::create(['name'=>'Read-Role', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Create-Role', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Role', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Role', 'guard_name'=>'admin']);

        Permission::create(['name'=>'Read-Permission', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Create-Permission', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Permission', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Permission', 'guard_name'=>'admin']);

        Permission::create(['name'=>'Read-Cities', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Create-Cities', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Cities', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Cities', 'guard_name'=>'admin']);

        Permission::create(['name'=>'Read-Categories', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Create-Categories', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Categories', 'guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Categories', 'guard_name'=>'admin']);

        Permission::create(['name'=>'Read-Categories', 'guard_name'=>'user']);
        Permission::create(['name'=>'Create-Categories', 'guard_name'=>'user']);
        Permission::create(['name'=>'Update-Categories', 'guard_name'=>'user']);
        Permission::create(['name'=>'Delete-Categories', 'guard_name'=>'user']);

        Permission::create(['name'=>'Read-Cities', 'guard_name'=>'user']);
        Permission::create(['name'=>'Create-Cities', 'guard_name'=>'user']);
        Permission::create(['name'=>'Update-Cities', 'guard_name'=>'user']);
        Permission::create(['name'=>'Delete-Cities', 'guard_name'=>'user']);

        Permission::create(['name'=>'Read-User', 'guard_name'=>'user']);

        Permission::create(['name'=>'Read-Task', 'guard_name'=>'user']);
        Permission::create(['name'=>'Create-Task', 'guard_name'=>'user']);
        Permission::create(['name'=>'Update-Task', 'guard_name'=>'user']);
        Permission::create(['name'=>'Delete-Task', 'guard_name'=>'user']);





    }
}
