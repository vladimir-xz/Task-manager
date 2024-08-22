<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Database\Seeders\TaskStatusSeeder;
use App\Models\TaskStatus;
use App\Models\Task;
use Database\Seeders\LabelSeeder;

class TaskStatusTest extends TestCase
{
    protected ?TaskStatus $taskStatus;
    protected User $user;
    protected array $body;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(TaskStatusSeeder::class);
        $this->taskStatus = TaskStatus::first();
        $this->user = User::factory()->create();
        $this->body = [ 'name' => 'test'];
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));

        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));

        $response->assertStatus(200);
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.edit', $this->taskStatus));
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $response = $this->actingAs($this->user)->post(route('task_statuses.store'), $this->body);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $this->body);
    }


    public function testUpdate(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('task_statuses.update', $this->taskStatus), $this->body);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->taskStatus?->refresh();

        $this->assertEquals($this->taskStatus?->name, $this->body['name']);
        $this->assertDatabaseHas('task_statuses', [
            'id' => $this->taskStatus?->id,
            ...$this->body
        ]);
    }

    public function testCantDestroyWhenAssignedToTask(): void
    {
        $newStatus = TaskStatus::factory()->create();
        Task::factory()->for($newStatus, 'status')->create();
        $response = $this
            ->actingAs($this->user)
            ->delete(route('task_statuses.destroy', $newStatus));

        $this->assertModelExists($newStatus);
    }

    public function testDestroy(): void
    {
        $newStatus = TaskStatus::factory()->create();
        $response = $this
            ->actingAs($this->user)
            ->delete(route('task_statuses.destroy', $newStatus));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertModelMissing($newStatus);
    }
}
