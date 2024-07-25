<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\TaskStatusSeeder;
use App\Models\TaskStatus;
use Database\Seeders\LabelSeeder;
use Illuminate\Database\Eloquent\Collection;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    protected TaskStatus $taskStatus;
    protected User $user;
    protected array $body = [
        'name' => 'test'
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(TaskStatusSeeder::class);
        $this->seed(LabelSeeder::class);
        $this->taskStatus = TaskStatus::all()->first();
        $this->user = User::factory()->create();
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

        $this->assertDatabaseHas('task_statuses', [
            'id' => $this->taskStatus->id,
            ...$this->body
        ]);
    }

    public function testDestroy(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->delete(route('task_statuses.destroy', $this->taskStatus));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('task_statuses', $this->body);
    }
}
