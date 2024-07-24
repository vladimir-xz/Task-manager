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
            'name' => 'test',
            'status_id' => $this->task->status->id
        ];
    }

    public function testIndex(): void
    {
        $response = $this->getJson(route('tasks.index'));

        $response->assertStatus(200);
    }

    public function testShow(): void
    {
        $response = $this->getJson(route('tasks.show', $this->task));

        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        // $response = $this->getJson(route('tasks.create'));
        // $response->assertStatus(302);

        $response = $this->actingAs($this->user)->getJson(route('tasks.create'));
        $response = $this->getJson(route('tasks.create'));

        $response->assertStatus(200);
    }

    public function testEdit(): void
    {
        // $response = $this->getJson(route('tasks.create'));
        // $response->assertStatus(302);

        $response = $this->actingAs($this->user)->getJson(route('tasks.create'));
        $response = $this->getJson(route('tasks.create'));
        $response->dump();
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $response = $this->actingAs($this->user)->post(route('tasks.store'), $this->body);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $this->body);
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

    public function testDestroy(): void
    {
        $task = Task::factory()->for($this->user, 'creator')->create();
        $response = $this
            ->actingAs($this->user)
            ->delete(route('tasks.destroy', $task));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', $this->body);
    }
}
