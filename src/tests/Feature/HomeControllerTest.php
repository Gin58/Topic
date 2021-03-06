<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testExample()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->get('/home');

        $response->assertStatus(200)
            ->assertViewIs('home')
            ->assertSee('You are logged in!');
    }
}
