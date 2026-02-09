<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class RbacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // resetting cached roles and permissions
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Defining permissions
        $permissions =[
            //members
            'members.create',
            'members.view',
            'members.update',

            //prayer sessions
            'prayers.create',
            'prayers.view',
            'prayers.update',

            //finance
            'finance.create',
            'finance.view',
            'finance.update',

            //System /RBAC
            'users.manage',
            'roles.manage'
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Defining the roles
        $superAdmin = Role::firstOrCreate(['name'=>'super-admin']);
        $groupLeader = Role::firstOrCreate(['name'=>'pg-leader']);
        $secretary = Role::firstOrCreate(['name' => 'finance-admin']);

        // Assigning permissions to roles 
        // Total access to super-admin
        $superAdmin->syncPermissions(Permission::all());

        // Prayer Group Leader
        $groupLeader->syncPermissions([
            'members.create',
            'members.view',
            'members.update',

            'prayers.create',
            'prayers.view',
            'prayers.update',
        ]);

        // Secretary
        $secretary->syncPermissions([
            'finance.create',
            'finance.view',
            'finance.update',

            'members.view',
            'members.update',
        ]);
    }
}
