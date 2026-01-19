<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            ['name' => 'Computer Science', 'description' => 'BSc Computer Science'],
            ['name' => 'Business Administration', 'description' => 'BBA Program'],
            ['name' => 'Electrical Engineering', 'description' => 'BEng Electrical'],
            ['name' => 'Mathematics', 'description' => 'BSc Mathematics'],
            ['name' => 'Physics', 'description' => 'BSc Physics'],
        ];

        foreach ($courses as $c) {
            Course::firstOrCreate(['name' => $c['name']], $c);
        }
    }
}
