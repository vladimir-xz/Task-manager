<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testEdit(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testDestroy(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
