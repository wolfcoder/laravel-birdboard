<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    // RefreshDatabase
    use WithFaker;

    public function guests_cannot_create_projects()
    {
        $attributes = Project::factory()->raw();
        $this->post('/projects', $attributes)->assertRedirect('login');
    }


    public function test_guests_cannot_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');
    }

    public function test_guests_cannot_view_a_single_projects()
    {
        $project = Project::factory()->create();
        $this->get($project->path())->assertRedirect('login');
    }

    public function test_user_can_create_a_project(): void
    {
        $this->withoutExceptionHandling();

        // required auth user
        $this->actingAs(User::factory()->create());

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

    public function test_a_user_can_view_their_project(): void
    {
        $this->be(User::factory()->create());

        $this->withoutExceptionHandling();

        $project = Project::factory()->create(['owner_id' => Auth::user()->id]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->be(User::factory()->create());

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_a_project_requires_a_title()
    {
        // required auth user
        $this->actingAs(User::factory()->create());

        // factory raw return json,
        // $attributes = Project::factory()->make(['title' => ''])->toArray();
        $attributes = Project::factory()->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    // php artisan test --filter test_a_project_requires_a_description
    public function test_a_project_requires_a_description()
    {
        // required auth user
        $this->actingAs(User::factory()->create());


        $attributes = Project::factory()->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    // a test --filter test_a_project_requires_an_owner
    public function test_a_project_requires_an_owner()
    {
        $attributes = Project::factory()->raw(['owner_id' => null]);
        $this->post('/projects', $attributes)->assertRedirect('login');
    }
}
