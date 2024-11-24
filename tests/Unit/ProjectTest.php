<?php

namespace Tests\Unit;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// use PHPUnit\Framework\TestCase; 
// Make sure your Unit Test extends the Tests\TestCase class; not the PHPUnit `TestCase class

class ProjectTest extends TestCase
{
    // use RefreshDatabase;

    // php artisan test --filter test_it_has_a_path
    public function test_it_has_a_path(): void
    {
        $project = Project::factory()->create();

        // called project path

        $this->assertEquals('/projects/' . $project->id, $project->path());
    }
}
