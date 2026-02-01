<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample users with roles
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
        ]);
        $admin->assignRole('admin');

        $teacher = User::factory()->create([
            'name' => 'Teacher User',
            'email' => 'teacher@example.com',
            'password' => Hash::make('123'),
        ]);
        $teacher->assignRole('teacher');

        $student = User::factory()->create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => Hash::make('123'),
        ]);
        $student->assignRole('student');
    }
}
