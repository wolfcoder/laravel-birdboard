<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    // RefreshDatabase
    use WithFaker, RefreshDatabase;

    public function test_user_can_create_a_project(): void
    {
        $this->withoutExceptionHandling();

        // create attributes or data to send
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        // sent post request with attibutes as payload data
        $this->post('/projects', $attributes)->assertRedirect('/projects');

        // check if the data is in the database
        $this->assertDatabaseHas('projects', $attributes);

        // // get the data from the database
        $this->get('/projects')->assertSee($attributes['title']);
    }

    // php artisan test --filter test_a_project_requires_a_title
    public function test_a_project_requires_a_title()
    {
        // factory attribute
        // $attributes = Project::factory()->make(['title' => ''])->toArray();
        $attributes = Project::factory()->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    // php artisan test --filter test_a_project_requires_a_description
    public function test_a_project_requires_a_description()
    {
        $attributes = Project::factory()->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
