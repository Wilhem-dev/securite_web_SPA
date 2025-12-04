<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_non_admin_user_gets_forbidden_response(): void
    {
        $user = User::factory()->withoutTwoFactor()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertForbidden();
    }

    public function test_admin_user_can_view_dashboard(): void
    {
        $admin = User::factory()->admin()->withoutTwoFactor()->create();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('Admin/Dashboard'));
    }

    public function test_admin_dashboard_lists_only_users_with_user_role(): void
    {
        $admin = User::factory()->admin()->withoutTwoFactor()->create();
        $regularUsers = User::factory()->count(3)->withoutTwoFactor()->create();
        User::factory()->admin()->withoutTwoFactor()->create();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Admin/Dashboard')
                ->has('users', $regularUsers->count())
                ->where('users', function (Collection $users) use ($regularUsers): bool {
                    $actualIds = $users->pluck('id')->sort()->values()->all();
                    $expectedIds = $regularUsers->pluck('id')->sort()->values()->all();

                    $allHaveUserRole = collect($users)->every(
                        fn (array $user) => $user['role'] === User::ROLE_USER
                    );

                    return $expectedIds === $actualIds && $allHaveUserRole;
                })
            );
    }
}
