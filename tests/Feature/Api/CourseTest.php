<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    /**
     * Get all courses.
     *
     * @return void
     */
    public function test_get_all_courses()
    {
        $response = $this->getJson('/courses');

        $response->assertStatus(200);
    }

    /**
     * Create and count 10 courses.
     *
     * @return void
     */
    public function test_get_create_count_courses()
    {
        Course::factory()->count(10)->create();
        $response = $this->getJson('/courses');
        $response->assertJsonCount(10, 'data');
        $response->assertStatus(200);
    }

    /**
     * Test not found.
     *
     * @return void
     */
    public function test_not_found_course()
    {
        $response = $this->getJson('/courses/fake_value');
        $response->assertStatus(404);
    }

    /**
     * Test get one course after created.
     *
     * @return void
     */
    public function test_get_course()
    {
        $course = Course::factory()->create();
        $response = $this->getJson("/courses/{$course->uuid}");
        $response->assertStatus(200);
    }

    /**
     * Test validation error.
     *
     * @return void
     */
    public function test_validation_create_course()
    {
        $response = $this->postJson("/courses", []);
        $response->assertStatus(422);
    }

    /**
     * Test create one course.
     *
     * @return void
     */
    public function test_create_course()
    {
        $response = $this->postJson("/courses", [
            'name' => 'Novo Curso'
        ]);
        $response->assertStatus(201);
    }

    /**
     * Test validation update course.
     *
     * @return void
     */
    public function test_validation_update_course()
    {
        $course = Course::factory()->create();
        $response = $this->putJson("/courses/{$course->uuid}", []);
        $response->assertStatus(422);
    }

    /**
     * Test 404 update course.
     *
     * @return void
     */
    public function test_404_update_course()
    {
        $response = $this->putJson("/courses/fake_value", [
            'name' => 'Course updated'
        ]);
        $response->assertStatus(404);
    }

    /**
     * Test update course.
     *
     * @return void
     */
    public function test_update_course()
    {
        $course = Course::factory()->create();
        $response = $this->putJson("/courses/{$course->uuid}", [
            'name' => 'Course updated'
        ]);
        $response->assertStatus(200);
    }

    /**
     * Test 404 delete course.
     *
     * @return void
     */
    public function test_404_delete_course()
    {
        $response = $this->deleteJson("/courses/fake_value");
        $response->assertStatus(404);
    }

    /**
     * Test delete course.
     *
     * @return void
     */
    public function test_delete_course()
    {
        $course = Course::factory()->create();
        $response = $this->deleteJson("/courses/{$course->uuid}");
        $response->assertStatus(204);
    }


}
