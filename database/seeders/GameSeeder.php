<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Platform;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $base = Platform::firstOrCreate(['name' => 'Base Game']);
        $expansion = Platform::firstOrCreate(['name' => 'Expansion']);
        $spinoff = Platform::firstOrCreate(['name' => 'Spin-off']);

        $games = [
            ['title' => 'Monster Hunter: World', 'platform_id' => $base->id, 'price' => 1299.00, 'stock' => 25, 'is_available' => true],
            ['title' => 'Monster Hunter: World - Iceborne', 'platform_id' => $expansion->id, 'price' => 1799.00, 'stock' => 18, 'is_available' => true],
            ['title' => 'Monster Hunter Rise', 'platform_id' => $base->id, 'price' => 1499.00, 'stock' => 30, 'is_available' => true],
            ['title' => 'Monster Hunter Rise: Sunbreak', 'platform_id' => $expansion->id, 'price' => 1399.00, 'stock' => 12, 'is_available' => true],
            ['title' => 'Monster Hunter Wilds', 'platform_id' => $base->id, 'price' => 2499.00, 'stock' => 40, 'is_available' => true],
            ['title' => 'Monster Hunter Generations Ultimate', 'platform_id' => $base->id, 'price' => 1199.00, 'stock' => 8, 'is_available' => true],
            ['title' => 'Monster Hunter Stories 2: Wings of Ruin', 'platform_id' => $spinoff->id, 'price' => 1599.00, 'stock' => 15, 'is_available' => true],
            ['title' => 'Monster Hunter Stories', 'platform_id' => $spinoff->id, 'price' => 999.00, 'stock' => 10, 'is_available' => false],
            ['title' => 'Monster Hunter 4 Ultimate', 'platform_id' => $base->id, 'price' => 899.00, 'stock' => 5, 'is_available' => false],
            ['title' => 'Monster Hunter 3 Ultimate', 'platform_id' => $base->id, 'price' => 799.00, 'stock' => 4, 'is_available' => false],
            ['title' => 'Monster Hunter Freedom Unite', 'platform_id' => $base->id, 'price' => 599.00, 'stock' => 3, 'is_available' => false],
            ['title' => 'Monster Hunter Portable 3rd', 'platform_id' => $base->id, 'price' => 650.00, 'stock' => 6, 'is_available' => false],
            ['title' => 'Monster Hunter Frontier Z', 'platform_id' => $spinoff->id, 'price' => 1100.00, 'stock' => 0, 'is_available' => false],
            ['title' => 'Monster Hunter Now', 'platform_id' => $spinoff->id, 'price' => 100.00, 'stock' => 99, 'is_available' => true],
            ['title' => 'Monster Hunter Online', 'platform_id' => $spinoff->id, 'price' => 500.00, 'stock' => 0, 'is_available' => false],
            ['title' => 'Monster Hunter Tri', 'platform_id' => $base->id, 'price' => 750.00, 'stock' => 2, 'is_available' => false],
            ['title' => 'Monster Hunter Dos', 'platform_id' => $base->id, 'price' => 450.00, 'stock' => 1, 'is_available' => false],
            ['title' => 'Monster Hunter Freedom 2', 'platform_id' => $base->id, 'price' => 550.00, 'stock' => 4, 'is_available' => false],
            ['title' => 'Monster Hunter G', 'platform_id' => $expansion->id, 'price' => 499.00, 'stock' => 2, 'is_available' => false],
            ['title' => 'Monster Hunter Diary: Poka Poka Airou Village', 'platform_id' => $spinoff->id, 'price' => 699.00, 'stock' => 7, 'is_available' => true],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}