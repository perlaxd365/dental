<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1= Role::create(['name'=>'Admin']);
        $role2= Role::create(['name'=>'Doctor']);
 
        // PERMISOS DE USUARIO
        Permission::create(['name'=>'admin.users.index'])->syncRoles($role1);
        Permission::create(['name'=>'admin.users.create'])->syncRoles($role1);
        Permission::create(['name'=>'admin.users.update'])->syncRoles($role1);
        Permission::create(['name'=>'admin.users.delete'])->syncRoles($role1);

        // PERMISOS DE DOCTOR
        Permission::create(['name'=>'admin.doctors.index'])->syncRoles($role2);
        Permission::create(['name'=>'admin.doctors.create'])->syncRoles($role2);
        Permission::create(['name'=>'admin.doctors.update'])->syncRoles($role2);
        Permission::create(['name'=>'admin.doctors.delete'])->syncRoles($role2);
    }
}
