<?php

namespace Tests\Feature\Api\V2;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and authenticate using Sanctum
        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'sanctum');
    }

    public function test_user_can_get_list_of_tasks(): void
    {
        // Arrange: create 2 tasks for the user
        $tasks = Task::factory()->count(2)->create([
            'user_id' => $this->user->id
        ]);

        // Act: Make a GET request
        $response = $this->getJson('/api/v2/tasks');
        
        // Assert
        $response->assertOk();
        $response->assertJsonCount(2, 'data');
        $response->assertJsonStructure([
            'data' => [
                ['id', 'name', 'is_completed']
            ]
        ]);
    }

    public function test_user_can_get_single_task(): void
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->getJson('/api/v2/tasks/' . $task->id);

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => ['id', 'name', 'is_completed']
        ]);
        $response->assertJson([
            'data' => [
                'id' => $task->id,
                'name' => $task->name,
                'is_completed' => $task->is_completed,
            ]
        ]);
    }

    public function test_user_can_create_a_task(): void
    {
        $response = $this->postJson('/api/v2/tasks', [
            'name' => 'New task'
        ]);

        $response->assertCreated();
        $response->assertJsonStructure([
            'data' => ['id', 'name', 'is_completed']
        ]);
        $this->assertDatabaseHas('tasks', [
            'name' => 'New task'
        ]);
    }

    public function test_user_cannot_create_invalid_task(): void
    {
        $response = $this->postJson('/api/v2/tasks', [
            'name' => ''
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }

    public function test_user_can_update_task(): void
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->putJson('/api/v2/tasks/' . $task->id, [
            'name' => 'Updated Task'
        ]);

        $response->assertOk();
        $response->assertJsonFragment([
            'name' => 'Updated Task'
        ]);
    }

    public function test_user_cannot_update_task_with_invalid_data(): void
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->putJson('/api/v2/tasks/' . $task->id, [
            'name' => ''
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }

    public function test_user_can_toggle_task_completion(): void
    {
        $task = Task::factory()->create([
            'is_completed' => false,
            'user_id' => $this->user->id
        ]);

        $response = $this->patchJson('/api/v2/tasks/' . $task->id . '/complete', [
            'is_completed' => true
        ]);

        $response->assertOk();
        $response->assertJsonFragment([
            'is_completed' => true
        ]);
    }

    public function test_user_cannot_toggle_completed_with_invalid_data(): void
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->patchJson('/api/v2/tasks/' . $task->id . '/complete', [
            'is_completed' => 'yes'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['is_completed']);
    }

    public function test_user_can_delete_task(): void
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->deleteJson('/api/v2/tasks/' . $task->id);

        $response->assertNoContent();
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
