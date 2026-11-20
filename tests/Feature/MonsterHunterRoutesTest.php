<?php

namespace Tests\Feature;

use Tests\TestCase;

class MonsterHunterRoutesTest extends TestCase
{
    public function test_monster_hunters_index_page_renders(): void
    {
        $response = $this->get('/monsterhunters');

        $response->assertOk();
        $response->assertSee('Game Library');
    }

    public function test_monster_hunter_detail_page_renders(): void
    {
        $response = $this->get('/monsterhunters/1');

        $response->assertOk();
        $response->assertSee('Monster Hunter: World');
    }

    public function test_monster_hunter_edit_page_prefills_existing_values(): void
    {
        $response = $this->get('/monsterhunters/1/edit');

        $response->assertOk();
        $response->assertSee('value="Monster Hunter: World"', false);
    }
}
