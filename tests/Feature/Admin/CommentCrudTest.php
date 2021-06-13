<?php

namespace Tests\Feature\Admin;

use App\Models\Comment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentCrudTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_comment()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);

        $response = $this->actingAs($user)->get('/admin/comments');
        $response->assertStatus(200);
    }

    public function test_update_a_comment()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);


        $comment = Comment::factory()->create();
        $response = $this->actingAs($user)->put("/admin/comments/{$comment->id}", [
            "body" => "Hello world",
        ]);

        $this->assertTrue($comment->fresh()->body === "Hello world");
    }

    public function test_delete_a_comment()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);

        $target = Comment::factory()->create();
        $response = $this->actingAs($user)->delete("/admin/comments/{$target->id}");

        $this->assertTrue(Comment::where("id", $target->id)->count() === 0);
    }
}
