<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Student;

// Create 15 students manually
for ($i = 1; $i <= 15; $i++) {
    Student::create([
        'name' => "Student $i",
        'email' => "student$i@example.com",
        'phone' => "123-456-789$i",
        'nic' => "12345678$i",
        'age' => rand(18, 25)
    ]);
}

echo "Created 15 students successfully!\n";