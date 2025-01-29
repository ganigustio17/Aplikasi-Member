<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'admin-blog']);
        Permission::firstOrCreate(['name' => 'admin-page']);
        Permission::firstOrCreate(['name' => 'admin-user']);

        $adminBlog = User::create([
            'name' => 'Admin Blog',
            'email_verified_at' => Carbon::now(),
            'email' => 'adminblog@gmail.com',
            'password' => bcrypt('password123'),
            'remember_token' => Str::random(60),
        ]);
        
        $adminPage = User::create([
            'name' => 'Admin Page',
            'email_verified_at' => Carbon::now(),
            'email' => 'adminpage@gmail.com',
            'password' => bcrypt('password123'),
            'remember_token' => Str::random(60),
        ]);

        $adminUser = User::create([
            'name' => 'Admin User',
            'email_verified_at' => Carbon::now(),
            'email' => 'adminuser@gmail.com',
            'password' => bcrypt('password123'),
            'remember_token' => Str::random(60),
        ]);

        $adminBlog->givePermissionTo('admin-blog');
        $adminPage->givePermissionTo('admin-page');
        $adminUser->givePermissionTo('admin-user');
    }
}
