<?php

namespace Tests\Feature;

use App\Models\Film;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MakeReviewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_make_a_review()
    {
        $user = User::factory()->create();
        $film = Film::factory()->create();

        $response = $this->actingAs($user)->get("/review/{$film->id}");
        $response->assertStatus(200);

        $response = $this->actingAs($user)->post("/review/{$film->id}", ["rate" => 10]);
        $this->assertTrue($user->refresh()->reviews()->where("film_id", $film->id)->first() !== null);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_without_login_make_a_review()
    {
        $user = User::factory()->create();
        $film = Film::factory()->create();

        $response = $this->get("/review/{$film->id}");
        $response->assertStatus(302);
    }
}
