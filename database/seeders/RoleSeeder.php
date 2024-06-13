<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::table('user_infos')->truncate();
        DB::table('roles')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        DB::beginTransaction();

        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'content-manager']);

        $user = User::firstOrCreate(
            ['email' => 'super-admin@email.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'username' => 'superadmin',
                'phone' => '09121234567',
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
                'password' => Hash::make('password')
            ]
        );

        $contentManager = User::firstOrCreate(
            ['email' => 'content-manager@email.com'],
            [
                'first_name' => 'Content',
                'last_name' => 'Manager',
                'username' => 'contentmanager',
                'phone' => '09122345678',
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
                'password' => Hash::make('password')
            ]
        );
        $user->assignRole('super-admin');
        $contentManager->assignRole('content-manager');

        DB::commit();
    }
}
