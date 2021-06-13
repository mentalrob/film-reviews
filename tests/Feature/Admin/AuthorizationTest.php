<?php

namespace Tests\Feature\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_authorization()
    {
        $user = User::factory()->create();
        $role = Role::create(["slug" => "admin", "title" => "Admin"]);
        $user->roles()->sync($role);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
    }
}
