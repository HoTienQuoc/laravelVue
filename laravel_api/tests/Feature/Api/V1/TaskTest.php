<?php

namespace Tests\Feature\Api\V1;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


// HOW DOES A TEST WORK?
// • Arrange set up the data we need
// • Act perform an action
// • Assert make sure the results are what we expect
// Arrange -> Act -> Assert pattern


class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_get_list_of_tasks(): void{
        //Arrange: create 2 fake tasks
        $tasks = Task::factory()->count(2)->create();
        //Action: make a Get request to the endpoint
        $response = $this->getJson('/api/v1/tasks');
        //Assert: status is 200 OK and data has 2 items
        $response->assertOk();
        $response->assertJsonCount(2, 'data');
        $response->assertJsonStructure([
            "data"=>[
                ['id', 'name', 'is_completed']
            ]
        ]);
    }


    public function test_user_can_get_single_task(): void{
        //Arrange: create a fake task
        $task = Task::factory()->create();
        //Action: make a Get request to the endpoint with Task Id
        $response = $this->getJson('/api/v1/tasks/'.$task->id);
        //Assert: status is 200 OK and data has 1 item
        $response->assertOk();
        $response->assertJsonStructure([
            "data"=>[
                'id', 'name', 'is_completed'
            ]
        ]);
        $response->assertJson([
            "data"=>[
                'id' => $task->id,
                'name' => $task->name,
                'is_completed' => $task->is_completed
            ]
        ]);
    }
}
