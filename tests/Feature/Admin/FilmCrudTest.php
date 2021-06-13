<?php

namespace Tests\Feature\Admin;

use App\Models\Film;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FilmCrudTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_film()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);

        $response = $this->actingAs($user)->get('/admin/films');
        $response->assertStatus(200);
    }

    public function test_update_a_film()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);

        $film = Film::factory()->create();
        $posterOld = $film->poster;
        $response = $this->actingAs($user)->put("/admin/films/{$film->id}", [
            "title" => "Hello world",
            "poster" => UploadedFile::fake()->image('poster.png'),
        ]);

        $this->assertTrue($film->refresh()->title === "Hello world");
        $this->assertTrue($film->poster !== $posterOld);
    }

    public function test_create_a_film()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);

        $film = Film::factory()->make();
        $posterOld = $film->poster;
        $data = $film->toArray();
        $data["poster"] = UploadedFile::fake()->image('poster.png');
        $response = $this->actingAs($user)->post("/admin/films/{$film->id}", $data);

        $this->assertCount(1, Film::where("title", $data["title"])->get());
    }

    public function test_delete_a_film()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);

        $film = Film::factory()->create();
        $response = $this->actingAs($user)->delete("/admin/films/{$film->id}");

        $this->assertTrue(Film::where("id", $film->id)->count() === 0);
    }
}
