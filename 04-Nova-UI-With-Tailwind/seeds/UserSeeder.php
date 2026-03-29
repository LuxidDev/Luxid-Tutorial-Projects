<?php

namespace Seeds;

use Rocket\Seed\Seeder;
use App\Entities\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = new User();
        $admin->email = 'admin@example.com';
        $admin->password = 'admin123';
        $admin->firstname = 'Admin';
        $admin->lastname = 'User';
        $admin->save();
        
        echo "  ✓ Created admin user\n";
        
        // Create 10 regular users
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->email = "user{$i}@example.com";
            $user->password = 'password123';
            $user->firstname = "User";
            $user->lastname = "{$i}";
            $user->save();
        }
        
        echo "  ✓ Created 10 regular users\n";
    }
}