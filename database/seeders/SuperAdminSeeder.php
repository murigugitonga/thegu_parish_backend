<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name'=>'super-admin', 'guard_name'=>'web']);
        $user = User::updateOrCreate(
            ['email' => 'admin@theguparish.com'],
            [
                'name'=> 'Thegu Admin',
                'password' => Hash::make('thegu@002'),
            ]
        );
        
        // assign super admin role
        if (!$user->hasRole('super-admin')){
            $user->assignRole($role);
        }
        // $superAdmin = User::updateOrCreate(
        //     ['email' => 'admin@theguparish.com'],
        //     [
        //         'name' => 'Thegu Admin',
        //         'password' => Hash::make('thegu@002'),
        //     ]
        // ); 
        // if(!$superAdmin->hasRole('super-admin')){
        //     $superAdmin->assignRole('super-admin');
        // }
    }
}
