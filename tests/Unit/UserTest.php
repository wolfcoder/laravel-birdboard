<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    // a test --filter test_a_user_has_project
    public function test_a_user_has_project(): void
    {
        $this->assertTrue(true);

        // TODO: Implement test_a_user_has_project() method.
        // $user = User::factory()->create();


        // $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->projects);
    }
}
