<?php

namespace Tests\Feature\Admin;

use App\Models\Film;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_user()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);

        $response = $this->actingAs($user)->get('/admin/users');
        $response->assertStatus(200);
    }

    public function test_update_a_user()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);

        $target = User::factory()->create();
        $photoOld = $target->profile_photo_url;
        $response = $this->actingAs($user)->put("/admin/users/{$target->id}", [
            "name" => "Hello world",
            "photo" => UploadedFile::fake()->image('poster.png'),
        ]);

        $this->assertTrue($target->refresh()->name === "Hello world");
        $this->assertTrue($target->profile_photo_url !== $photoOld);
    }

    public function test_delete_a_user()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);

        $target = User::factory()->create();
        $response = $this->actingAs($user)->delete("/admin/users/{$target->id}");

        $this->assertTrue(User::where("id", $target->id)->count() === 0);
    }
}
