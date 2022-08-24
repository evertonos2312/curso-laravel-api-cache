<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    /**
     * @return void
     */
    public function test_all_modules_by_course()
    {
        $course = Course::factory()->create();
        Module::factory()->count(10)->create([
            'course_id' => $course->id
        ]);
        $response = $this->getJson("courses/{$course->uuid}/modules");
        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    /**
     *
     * @return void
     */
    public function test_not_found_modules_by_course()
    {
        $response = $this->getJson("courses/fake_value/modules");
        $response->assertStatus(404);
    }

    /**
     *
     * @return void
     */
    public function test_module_by_course()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);
        $response = $this->getJson("courses/{$course->uuid}/modules/$module->uuid");
        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function test_validations_create_module_by_course()
    {
        $course = Course::factory()->create();
        $response = $this->postJson("courses/{$course->uuid}/modules", []);
        $response->assertStatus(422);
    }

    /**
     *
     * @return void
     */
    public function test_create_module_by_course()
    {
        $course = Course::factory()->create();
        $response = $this->postJson("courses/{$course->uuid}/modules", [
            'course' => $course->uuid,
            'name' => 'Modulo 01'
        ]);
        $response->assertStatus(201);
    }

    /**
     *
     * @return void
     */
    public function test_validations_update_module_by_course()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);
        $response = $this->putJson("courses/{$course->uuid}/modules/{$module->uuid}", []);
        $response->assertStatus(422);
    }

    /**
     *
     * @return void
     */
    public function test_update_module_by_course()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);
        $response = $this->putJson("courses/{$course->uuid}/modules/{$module->uuid}", [
            'course' => $course->uuid,
            'name' => 'Modulo updated'
        ]);
        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function test_not_found_delete_module_by_course()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);
        $response = $this->deleteJson("courses/{$course->uuid}/modules/fake_value");
        $response->assertStatus(404);
    }

    /**
     *
     * @return void
     */
    public function test_delete_module_by_course()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);
        $response = $this->deleteJson("courses/{$course->uuid}/modules/{$module->uuid}");
        $response->assertStatus(204);
    }
}
