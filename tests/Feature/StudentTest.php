<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Student;
use App\Models\User;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Authenticate a test user for protected student routes
        $this->actingAs(User::factory()->create());
    }

    /**
     * Test listing all students (GET /students).
     */
    public function test_lists_students()
    {
        // Create sample students using factory
        $students = Student::factory()->count(3)->create();

        $response = $this->get('/students');

        $response->assertStatus(200);

        // Ensure each student's name appears on the page
        foreach ($students as $student) {
            $response->assertSeeText($student->name);
        }
    }

    /**
     * Test showing a single student (GET /students/{id}).
     */
    public function test_shows_single_student()
    {
        $student = Student::factory()->create();

        $response = $this->get('/students/' . $student->id);

        $response->assertStatus(200);
        $response->assertSeeText($student->name);
        $response->assertSeeText($student->email);
    }

    /**
     * Test creating a student (POST /students).
     */
    public function test_creates_student()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'phone' => '0771234567',
        ];

        $response = $this->post('/students', $data);

        // Expect redirect after successful create (resource index)
        $response->assertStatus(302);
        $response->assertRedirect('/students');

        // Database assertion
        $this->assertDatabaseHas('students', [
            'email' => 'testuser@example.com',
            'name' => 'Test User',
        ]);
    }

    /**
     * Test updating a student (PUT /students/{id}).
     */
    public function test_updates_student()
    {
        $student = Student::factory()->create([
            'name' => 'Original Name',
            'email' => 'orig@example.com',
            'phone' => '0770000000',
        ]);

        $updateData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'phone' => '0779999999',
        ];

        $response = $this->put('/students/' . $student->id, $updateData);

        $response->assertStatus(302);
        $response->assertRedirect('/students');

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    }

    /**
     * Test deleting a student (DELETE /students/{id}).
     */
    public function test_deletes_student()
    {
        $student = Student::factory()->create();

        $response = $this->delete('/students/' . $student->id);

        $response->assertStatus(302);

        // Allow redirect to either /students (typical) or / (app may redirect home)
        $location = $response->headers->get('Location');
        $path = parse_url($location, PHP_URL_PATH) ?: '/';
        $this->assertTrue(in_array($path, ['/students', '/']), "Unexpected redirect to {$location}");

        $this->assertDatabaseMissing('students', [
            'id' => $student->id,
        ]);
    }
}
