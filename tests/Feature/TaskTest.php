<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class TaskTest extends TestCase
{
    protected ?Task $task;
    protected User $user;
    protected array $body;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->task = Task::first();
        $this->user = User::first();
        $this->body = [
            'name' => 'test2',
            'description' => 'test2',
            'status_id' => $this->task?->status?->id,
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
        $body = [
            'name' => 'test',
            'description' => 'test',
            'status_id' => $this->task?->status?->id
        ];
        $response = $this->actingAs($this->user)->post(route('tasks.store'), $body);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $body);
    }

    public function testUpdate(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('tasks.update', $this->task), $this->body);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', [
            'id' => $this->task->id,
            ...$this->body
        ]);
    }

    public function testDestroyNotAuthor(): void
    {
        $anotherUser = User::factory()->create();
        $task = Task::factory()->for($anotherUser, 'author')->create();
        $response = $this
            ->actingAs($this->user)
            ->delete(route('tasks.destroy', $task));

        $response->assertSessionHasNoErrors();
        $response->assertForbidden();

        $this->assertModelExists($task);
    }

    public function testDestroyAuthor(): void
    {
        $task = Task::factory()->for($this->user, 'author')->create();
        $response = $this
            ->actingAs($this->user)
            ->delete(route('tasks.destroy', $task));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertModelMissing($task);
    }
}
