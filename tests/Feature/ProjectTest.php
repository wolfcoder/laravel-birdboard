<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    // RefreshDatabase
    use WithFaker;

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
        // $this->assertDatabaseHas('projects', $attributes);

        // // get the data from the database
        // $this->get('/projects')->assertSee($attributes['title']);
    }
}
