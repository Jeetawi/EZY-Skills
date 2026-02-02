<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all teachers
        $teachers = User::role('teacher')->get();

        if ($teachers->isEmpty()) {
            $this->command->warn('No teachers found. Please run UserSeeder first.');
            return;
        }

        $courses = [
            [
                'title' => 'Introduction to Web Development',
                'description' => 'Learn the fundamentals of web development including HTML, CSS, and JavaScript. Perfect for beginners who want to start their journey in web development.',
                'max_students' => 30,
                'start_date' => now()->addDays(7),
                'end_date' => now()->addDays(67),
            ],
            [
                'title' => 'Advanced PHP Programming',
                'description' => 'Master advanced PHP concepts including OOP, design patterns, and modern PHP frameworks. Build robust and scalable web applications.',
                'max_students' => 25,
                'start_date' => now()->addDays(14),
                'end_date' => now()->addDays(74),
            ],
            [
                'title' => 'Database Design and SQL',
                'description' => 'Comprehensive course on database design principles, SQL queries, optimization, and best practices for relational databases.',
                'max_students' => 35,
                'start_date' => now()->addDays(10),
                'end_date' => now()->addDays(50),
            ],
            [
                'title' => 'Laravel Framework Masterclass',
                'description' => 'Deep dive into Laravel framework. Learn routing, Eloquent ORM, authentication, API development, and deployment strategies.',
                'max_students' => 20,
                'start_date' => now()->addDays(21),
                'end_date' => now()->addDays(81),
            ],
            [
                'title' => 'JavaScript and Modern Frontend',
                'description' => 'Explore modern JavaScript (ES6+), React, Vue.js, and build interactive user interfaces. Includes state management and API integration.',
                'max_students' => 40,
                'start_date' => now()->addDays(5),
                'end_date' => now()->addDays(65),
            ],
            [
                'title' => 'RESTful API Development',
                'description' => 'Learn to build robust RESTful APIs using Laravel. Covers authentication, versioning, documentation, and best practices.',
                'max_students' => 28,
                'start_date' => now()->addDays(15),
                'end_date' => now()->addDays(55),
            ],
            [
                'title' => 'Git and Version Control',
                'description' => 'Master Git for version control, collaboration workflows, branching strategies, and GitHub/GitLab best practices.',
                'max_students' => 50,
                'start_date' => now()->addDays(3),
                'end_date' => now()->addDays(33),
            ],
            [
                'title' => 'Software Testing and Quality Assurance',
                'description' => 'Comprehensive testing course covering unit tests, integration tests, PHPUnit, and TDD principles for reliable software.',
                'max_students' => 22,
                'start_date' => now()->addDays(20),
                'end_date' => now()->addDays(70),
            ],
        ];

        foreach ($courses as $index => $courseData) {
            // Assign teachers in round-robin fashion
            $teacher = $teachers[$index % $teachers->count()];
            
            Course::create([
                'teacher_id' => $teacher->id,
                'title' => $courseData['title'],
                'description' => $courseData['description'],
                'max_students' => $courseData['max_students'],
                'start_date' => $courseData['start_date'],
                'end_date' => $courseData['end_date'],
            ]);
        }

        $this->command->info('Created ' . count($courses) . ' courses successfully!');
    }
}
