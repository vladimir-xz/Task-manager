<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected Task $task;
    protected User $user;
    protected array $body;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->task = Task::all()->first();
        $this->user = User::all()->first();
        $this->body = [
            'store' => [
                'name' => 'Test',
                'description' => 'test',
                'status_id' => $this->task->status->id
            ],
            'update' => [
                'name' => 'Test2',
                'description' => 'test2',
                'status_id' => $this->task->status->id
            ]
        ];
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
    }

    public function testShow(): void
    {
        $response = $this->get(route('tasks.show', $this->task));

        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->getJson(route('tasks.create'));
        $response = $this->get(route('tasks.create'));

        $response->assertStatus(200);
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)->getJson(route('tasks.create'));
        $response = $this->get(route('tasks.create'));
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $response = $this->actingAs($this->user)->post(route('tasks.store'), $this->body['store']);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $this->body['store']);
    }

    public function testUpdate(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('tasks.update', $this->task), $this->body['update']);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', [
            'id' => $this->task->id,
            ...$this->body['update']
        ]);
    }

    public function testDestroy(): void
    {
        $task = Task::factory()->for($this->user, 'author')->create();
        $response = $this
            ->actingAs($this->user)
            ->delete(route('tasks.destroy', $task));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', $this->body);
    }
}
