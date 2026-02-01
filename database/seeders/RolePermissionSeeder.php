<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User Management
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Student Management
            'view students',
            'create students',
            'edit students',
            'delete students',
            'view student grades',
            'edit student grades',

            // Teacher Management
            'view teachers',
            'create teachers',
            'edit teachers',
            'delete teachers',

            // Course Management
            'view courses',
            'create courses',
            'edit courses',
            'delete courses',
            'enroll courses',
            'unenroll courses',

            // Attendance Management
            'view attendance',
            'create attendance',
            'edit attendance',
            'delete attendance',

            // Settings
            'manage settings',
            'manage roles',
            'manage permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Admin Role
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Create Teacher Role
        $teacherRole = Role::create(['name' => 'teacher']);
        $teacherRole->givePermissionTo([
            'view courses',
            'create courses',
            'edit courses',
            'delete courses',
            'enroll courses',
            'unenroll courses',
        ]);

        // Create Student Role
        $studentRole = Role::create(['name' => 'student']);
        $studentRole->givePermissionTo([
            'view courses',
            'enroll courses',
        ]);
    }
}
