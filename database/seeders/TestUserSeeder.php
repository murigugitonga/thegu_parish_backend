<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super admin
        $superAdmin = User::updateOrCreate(
            [
            'email' => 'superadmin@thegu.com'],
            [
            'name'=> 'Thegu Admin',
            'password'=> bcrypt("pass123"), 
            ]
        );
        $superAdmin->syncRoles(['super-admin']);

        // Prayer group Leader
        $groupLeader = User::updateOrCreate(
            [
                'email'=> 'Terry@gmail.com'],
                [
                'name' => 'Teresa Wangari',
                'password' => bcrypt('terry123')
            ]
        );
        $groupLeader->syncRoles(['pg-leader']);

        // Finance admin (secretary)
        $financeAdmin = User::updateOrCreate(
        ['email' => 'mary@gmail.com'],
    [
            'name' => 'Mary Wambui',
            'password' => bcrypt('Mary1234'),
            ]
        );
        $financeAdmin->syncRoles(['finance-admin']);
    }
}
