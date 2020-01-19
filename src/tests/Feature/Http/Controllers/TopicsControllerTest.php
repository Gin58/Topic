<?php

namespace Tests\Feature\Http\Controllers;
use App\User;
use App\Topic;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TopicsControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testIndex()
    {
        $user = factory(User::class)->create();
        factory(Topic::class)->create();

        $response = $this
            ->actingAs($user)
            ->get(route('topics.index'));

        $response->assertStatus(200)
            ->assertViewIs('topics.index')
            ->assertStatus(200)
            ->assertCount(1, $this->viewVariable('topics'));

    }
}
