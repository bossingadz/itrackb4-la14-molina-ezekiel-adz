<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MonsterHunterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $platformId = $request->query('platform');
        $availability = $request->query('availability');
        $sort = $request->query('sort', 'title');

        $query = Game::with('platform');

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        if ($platformId !== null && $platformId !== '') {
            $query->where('platform_id', $platformId);
        }

        if ($availability !== null && $availability !== '') {
            $query->where('is_available', $availability);
        }

        if (! in_array($sort, ['title', 'price', 'stock', 'id'], true)) {
            $sort = 'title';
        }

        $games = $query->orderBy($sort)->paginate(5)->withQueryString();
        $platforms = Platform::all();

        return view('monsterhunters.index', [
            'games' => $games,
            'platforms' => $platforms,
        ]);
    }

    public function create()
    {
        $platforms = Platform::all();
        return view('monsterhunters.create', compact('platforms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:200',
            'platform_id' => 'required|exists:platforms,id',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:1|max:100',
        ]);

        $game =Game::create($validated);

        Log::info('Monster Hunter game created', [
        'id' => $game->id,
        ]);

        return redirect()->route('monsterhunters.index')
            ->with('success', 'New record added successfully!');

            
    }

    public function show(Game $monsterhunter)
    {
        return view('monsterhunters.show', ['game' => $monsterhunter]);
    }

    public function edit(Game $monsterhunter)
    {
        $platforms = Platform::all();
        return view('monsterhunters.edit', [
            'game' => $monsterhunter,
            'platforms' => $platforms,
        ]);
    }

    public function update(Request $request, Game $monsterhunter)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:200',
            'platform_id' => 'required|exists:platforms,id',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:1|max:100',
        ]);

        $monsterhunter->update($validated);

        Log::info('Monster Hunter game updated', [
        'id' => $monsterhunter->id,
       ]);

        return redirect()->route('monsterhunters.index') ->with('success', 'Record updated successfully!');
    }

    public function destroy(Game $monsterhunter)
    {
        abort_if($monsterhunter->platform->games()->count() === 1, 403);
        
        $monsterhunter->delete();

        return redirect()->route('monsterhunters.index');
    }

    public function featured()
    {
        $game = Game::first();
        return view('monsterhunters.show', compact('game'));
    }
}