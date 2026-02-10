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
            'finances.create',
            'finances.view',
            'finances.update',

            //System /RBAC /SuperAdmin
            'users.manage',
            'roles.manage'
        ];
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' =>'sanctum']);
        }

        // Roles with guard
        $roles = [
            'super-admin' => $permissions, // explicit access
            'pg-leader' => ['members.add','members.update', 'prayers.add', 'prayers.update'],
            'finance-admin'=>['finances.update'],
        ];

        foreach ($roles as $roleName => $rolePerms) {
            $role = Role::firstOrCreate(
                [
                    'name' => $roleName,
                    'guard_name' => 'sanctum',
                ]);
        }

        // syncing the correct permissions
        $role->syncPermissions($rolePerms);

        // cache clearing
        \Artisan::call('permission:cache-reset');

        // // Defining the roles
        // $superAdmin = Role::firstOrCreate(['name'=>'super-admin', 'guard_name' =>'sanctum']);
        // $groupLeader = Role::firstOrCreate(['name'=>'pg-leader', 'guard_name' =>'sanctum']);
        // $secretary = Role::firstOrCreate(['name' => 'finance-admin', 'guard_name' =>'sanctum']);

        // // Defining permissions
        // Permission::firstOrCreate(['name'=>'users.manage', 'guard_name'=>'sanctum']);
        // Permission::firstOrCreate(['name'=>'members.add', 'guard_name'=>'sanctum']);

        // // Syncing permissions
        // // Total access to super-admin
        // $superAdmin->syncPermissions(Permission::all());

        // // Prayer Group Leader
        // $groupLeader->syncPermissions([
        //     'members.create',
        //     'members.view',
        //     'members.update',

        //     'prayers.create',
        //     'prayers.view',
        //     'prayers.update',
        // ]);

        // // Secretary
        // $secretary->syncPermissions([
        //     'finance.create',
        //     'finance.view',
        //     'finance.update',

        //     'members.view',
        //     'members.update',
        // ]);
    }
}
