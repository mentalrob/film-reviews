<?php

namespace Tests\Feature;

use App\Models\Film;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MakeCommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_make_a_comment()
    {

        $user = User::factory()->create();
        $film = Film::factory()->create();

        $response = $this->actingAs($user)->get("/review/{$film->id}");
        $response->assertStatus(200);

        $response = $this->actingAs($user)->post("/comment/{$film->id}", ["comment" => "lorem ipsum dolor some test"]);
        $this->assertTrue($user->refresh()->comments()->count() > 0);
    }
}
