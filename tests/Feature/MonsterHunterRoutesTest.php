<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class MonsterHunterRoutesTest extends TestCase
{
    public function test_monster_hunters_index_page_renders(): void
    {
        $response = $this->get('/monsterhunters');

        $response->assertOk();
        $response->assertSee('Game Library');
        $response->assertSee('Log in');
        $response->assertSee('Register');
        $response->assertDontSee('Log out');
        $response->assertDontSee('Add New Game');
        $response->assertDontSee('Actions');
        $response->assertDontSee('Edit');
        $response->assertDontSee('Delete');
    }

    public function test_monster_hunter_detail_page_renders(): void
    {
        $response = $this->get('/monsterhunters/1');

        $response->assertOk();
        $response->assertSee('Monster Hunter: World');
    }

    public function test_monster_hunter_edit_page_prefills_existing_values(): void
    {
        $this->actingAs(User::factory()->make(['name' => 'Test Hunter']));

        $response = $this->get('/monsterhunters/1/edit');

        $response->assertOk();
        $response->assertSee('value="Monster Hunter: World"', false);
    }

    public function test_only_mutating_resource_routes_require_authentication(): void
    {
        foreach (['monsterhunters.create', 'monsterhunters.store', 'monsterhunters.edit', 'monsterhunters.update', 'monsterhunters.destroy'] as $name) {
            $this->assertContains('auth', Route::getRoutes()->getByName($name)->gatherMiddleware(), $name);
        }

        foreach (['monsterhunters.index', 'monsterhunters.show'] as $name) {
            $this->assertNotContains('auth', Route::getRoutes()->getByName($name)->gatherMiddleware(), $name);
        }
    }

    public function test_guests_are_redirected_from_create_and_edit_but_can_browse(): void
    {
        $this->get(route('monsterhunters.create'))->assertRedirect(route('login'));
        $this->get(route('monsterhunters.edit', 1))->assertRedirect(route('login'));
        $this->get(route('monsterhunters.index'))->assertOk();
        $this->get(route('monsterhunters.show', 1))->assertOk();
    }

    public function test_authenticated_users_see_navigation_and_list_actions(): void
    {
        $this->actingAs(User::factory()->make(['name' => 'Test Hunter']));

        $response = $this->get(route('monsterhunters.index'));

        $response->assertOk();
        $response->assertSee('Test Hunter');
        $response->assertSee('Log out');
        $response->assertSee('Add New Game');
        $response->assertSee('Actions');
        $response->assertSee('Edit');
        $response->assertSee('Delete');
        $response->assertDontSee('Log in');
        $response->assertDontSee('Register');
    }

    public function test_guest_empty_list_has_no_actions_column(): void
    {
        $response = $this->get(route('monsterhunters.index', ['platform' => 999999]));

        $response->assertOk();
        $response->assertSee('colspan="5"', false);
        $response->assertDontSee('Actions');
    }

    public function test_authenticated_user_can_log_out_from_the_navbar(): void
    {
        $this->actingAs(User::factory()->make(['name' => 'Test Hunter']));

        $this->get(route('monsterhunters.index'))
            ->assertSee('action="' . route('logout') . '"', false)
            ->assertSee('name="_token"', false);

        $this->post(route('logout'))
            ->assertRedirect(route('home'));

        $this->get(route('monsterhunters.index'))
            ->assertSee('Log in')
            ->assertDontSee('Log out');
    }
}
