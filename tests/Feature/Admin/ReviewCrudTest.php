<?php

namespace Tests\Feature\Admin;

use App\Models\Review;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ReviewCrudTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_review()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);

        $response = $this->actingAs($user)->get('/admin/reviews');
        $response->assertStatus(200);
    }

    public function test_update_a_review()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);


        $review = Review::factory()->create();
        $response = $this->actingAs($user)->put("/admin/reviews/{$review->id}", [
            "rate" => 10,
        ]);

        $this->assertTrue($review->fresh()->rate === 10);
    }

    public function test_delete_a_review()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);

        $target = Review::factory()->create();
        $response = $this->actingAs($user)->delete("/admin/reviews/{$target->id}");

        $this->assertTrue(Review::where("id", $target->id)->count() === 0);
    }
}
