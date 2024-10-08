<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskComment;
use Database\Seeders\LabelSeeder;
use Database\Seeders\TaskCommentSeeder;
use Database\Seeders\TaskSeeder;
use Database\Seeders\TaskStatusSeeder;
use Database\Seeders\UserSeeder;
use Error;

class TaskCommentTest extends TestCase
{
    protected ?Task $task;
    protected User $user;
    protected ?TaskComment $comment;
    protected array $body;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $this->seed(LabelSeeder::class);
        $this->seed(TaskStatusSeeder::class);
        $this->seed(TaskSeeder::class);

        $user = User::first();
        if (is_null($user)) {
            exit();
        }
        $this->task = Task::first();
        $this->user = $user;
        $this->comment = TaskComment::factory()
            ->for($user, 'author')
            ->create();
        $this->body = ['content' => 'test2'];
    }

    public function testStore()
    {
        $body = [
            'content' => 'test',
        ];
        $response = $this->actingAs($this->user)->post(route('tasks.comments.store', $this->task), $body);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_comments', $body);
    }

    public function testUpdateNotAuthor()
    {
        $author = User::factory()->create();
        $task = Task::first();

        if (is_null($task)) {
            exit();
        }
        $comment = TaskComment::factory()
            ->for($author, 'author')
            ->for($task, 'task')
            ->create();

        $response = $this
            ->actingAs($this->user)
            ->patch(route('tasks.comments.update', [$task, $comment]), $this->body);

        $response->assertSessionHasNoErrors();
        $response->assertForbidden();

        $this->assertDatabaseMissing('task_comments', [
            'id' => $this->comment?->id,
            ...$this->body
        ]);
    }

    public function testUpdate()
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('tasks.comments.update', [$this->task, $this->comment]), $this->body);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_comments', [
            'id' => $this->comment?->id,
            ...$this->body
        ]);
    }

    public function testDeleteNotAuthor()
    {
        if (is_null($this->task)) {
            exit();
        }
        $newUser = User::factory()->create();
        $comment = TaskComment::factory()
            ->for($newUser, 'author')
            ->for($this->task, 'task')
            ->create();

        $response = $this
            ->actingAs($this->user)
            ->delete(route('tasks.comments.destroy', [$this->task, $comment]));

        $response->assertSessionHasNoErrors();
        $response->assertForbidden();

        $this->assertNotSoftDeleted($comment);
    }

    public function testDelete()
    {
        if (is_null($this->task)) {
            throw new Error('Task is null');
        }
        $comment = TaskComment::factory()
            ->for($this->user, 'author')
            ->for($this->task, 'task')
            ->create();

        $response = $this
            ->actingAs($this->user)
            ->delete(route('tasks.comments.destroy', [$this->task, $comment]));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertSoftDeleted($comment);
    }
}
