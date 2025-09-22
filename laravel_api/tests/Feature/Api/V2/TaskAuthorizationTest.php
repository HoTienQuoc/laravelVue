<?php

namespace Tests\Feature\Api\V2;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_view_tasks_owned_by_others()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = Task::factory()->for($owner)->create();

        Sanctum::actingAs($otherUser); // ✅

        $this->getJson("/api/v2/tasks/{$task->id}")
            ->assertForbidden();
    }

    public function test_user_cannot_update_tasks_owned_by_others()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = Task::factory()->for($owner)->create();

        $payload = ['name' => 'Unauthorized Update'];

        Sanctum::actingAs($otherUser); // ✅

        $this->putJson("/api/v2/tasks/{$task->id}", $payload)
            ->assertForbidden();
    }

    public function test_user_cannot_delete_tasks_owned_by_others()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = Task::factory()->for($owner)->create();

        Sanctum::actingAs($otherUser); // ✅

        $this->deleteJson("/api/v2/tasks/{$task->id}")
            ->assertForbidden();
    }

    public function test_user_cannot_complete_tasks_owned_by_others()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = Task::factory()->for($owner)->create();

        $payload = ['is_completed' => true];

        Sanctum::actingAs($otherUser); // ✅

        $this->patchJson("/api/v2/tasks/{$task->id}/complete", $payload)
            ->assertForbidden();
    }
    public function test_user_can_view_own_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->for($user)->create();

        Sanctum::actingAs($user);

        $this->getJson("/api/v2/tasks/{$task->id}")
            ->assertOk();
    }

}
