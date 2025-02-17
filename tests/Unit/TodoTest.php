<?php

namespace Tests\Unit;

use App\Models\ToDo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    protected string $api_version;

    /**
     * Set up the test
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->api_version = config('app.api_version');
    }

    /**
     * Test to create a to-do item.
     *
     * @return void
     */
    public function test_create_todo()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson("/api/{$this->api_version}/todos", [
            'title' => 'Code cleanup',
            'description' => 'Code cleanup Description',
        ]);

        $response->assertStatus(201)
            ->assertJson(['title' => 'Code cleanup']);
    }

    /**
     * Checks that users can only access their own to-do items
     */
    public function todos_not_accessible()
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $todo = ToDo::factory()->create(['user_id' => $anotherUser->id]);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson("/api/{$this->api_version}/todos/{$todo->id}");

        $response->assertStatus(403);
    }
}