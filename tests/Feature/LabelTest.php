<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Label;
use App\Models\User;
use App\Models\Task;
use Database\Seeders\TaskStatusSeeder;
use Database\Seeders\LabelSeeder;

class LabelTest extends TestCase
{
    protected ?Label $label;
    protected User $user;
    protected array $body;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(TaskStatusSeeder::class);
        $this->seed(LabelSeeder::class);
        $this->label = Label::first();
        $this->user = User::factory()->create();
        $this->body = [
            'name' => 'test',
            'description' => 'test'
        ];
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));

        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));

        $response->assertStatus(200);
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.edit', $this->label));
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $response = $this->actingAs($this->user)->post(route('labels.store'), $this->body);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $this->body);
    }


    public function testUpdate(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('labels.update', $this->label), $this->body);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->label?->refresh();

        $this->assertEquals($this->label?->name, $this->body['name']);

        $this->assertDatabaseHas('labels', [
            'id' => $this->label?->id,
            ...$this->body
        ]);
    }

    public function testCantDestroyWhenAssignedToTask(): void
    {
        $newlabel = Label::firstOrCreate(['name' => 'test']);
        Task::factory()->create()->labels()->sync($newlabel);
        $response = $this
            ->actingAs($this->user)
            ->delete(route('labels.destroy', $newlabel));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertModelExists($newlabel);
    }

    public function testDestroy(): void
    {
        $newlabel = Label::firstOrCreate(['name' => 'test']);
        $response = $this
            ->actingAs($this->user)
            ->delete(route('labels.destroy', $newlabel));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertModelMissing($newlabel);
    }
}
