<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $courses = Course::all();

        Student::factory()->count(20)->create()->each(function($student) use ($courses) {
            if ($courses->isNotEmpty()) {
                $student->course_id = $courses->random()->id;
                $student->save();
            }
        });
    }
}
