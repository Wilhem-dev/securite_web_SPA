<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_regular_user_via_api(): void
    {
        $admin = User::factory()->admin()->withoutTwoFactor()->create();
        $user = User::factory()->withoutTwoFactor()->create();

        $response = $this->actingAs($admin)->delete(route('admin.users.destroy', $user));

        $response
            ->assertOk()
            ->assertJson([
                'message' => __('Utilisateur supprimé avec succès.'),
            ]);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    public function test_admin_cannot_delete_an_admin_account(): void
    {
        $admin = User::factory()->admin()->withoutTwoFactor()->create();
        $otherAdmin = User::factory()->admin()->withoutTwoFactor()->create();

        $response = $this->actingAs($admin)->delete(route('admin.users.destroy', $otherAdmin));

        $response->assertStatus(422);

        $this->assertDatabaseHas('users', [
            'id' => $otherAdmin->id,
        ]);
    }

    public function test_guest_is_redirected_when_trying_to_delete_a_user(): void
    {
        $user = User::factory()->withoutTwoFactor()->create();

        $response = $this->delete(route('admin.users.destroy', $user));

        $response->assertRedirect(route('login'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }
}

