@extends('layouts.app')
@section('title', 'Monster Hunter List')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <h1 class="h2 mb-0">Game Library</h1>
    <a class="btn btn-primary" href="{{ route('monsterhunters.create') }}">Add New Game</a>
</div>

<form method="GET" action="{{ route('monsterhunters.index') }}" class="row g-2 mb-4">
    <div class="col-md-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search title">
    </div>
    <div class="col-md-3">
        <select name="platform" class="form-select">
            <option value="">All Platforms</option>
            @foreach ($platforms as $platform)
                <option value="{{ $platform->id }}" @selected(request('platform') == $platform->id)>{{ $platform->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <select name="availability" class="form-select">
            <option value="">Any Availability</option>
            <option value="1" @selected(request('availability') === '1')>Available</option>
            <option value="0" @selected(request('availability') === '0')>Unavailable</option>
        </select>
    </div>
    <div class="col-md-2">
        <select name="sort" class="form-select">
            <option value="title" @selected(request('sort', 'title') === 'title')>Sort: Title</option>
            <option value="price" @selected(request('sort') === 'price')>Sort: Price</option>
            <option value="stock" @selected(request('sort') === 'stock')>Sort: Stock</option>
        </select>
    </div>
    <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-primary">Apply</button>
        <a href="{{ route('monsterhunters.index') }}" class="btn btn-secondary">Clear</a>
    </div>
</form>

<div class="table-responsive">
<table class="table table-striped table-hover align-middle mb-0">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Platform</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($games as $game)
            <tr>
                <td>{{ $games->firstItem() + $loop->index }}</td>
                <td>
                    <a href="{{ route('monsterhunters.show', ['monsterhunter' => $game->id]) }}">
                        {{ $game->title }}
                    </a>
                </td>

                <td>{{ $game->platform->name }}</td>

                <td>₱{{ number_format($game->price, 2) }}</td>
                <td>{{ $game->stock }}</td>
                <td>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('monsterhunters.edit', ['monsterhunter' => $game->id]) }}">Edit</a>

                    <form method="POST" action="{{ route('monsterhunters.destroy', ['monsterhunter' => $game->id]) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this game?')">Delete</button>
                    </form>
            </tr>
        @empty
            <tr>
                <td class="text-center text-secondary py-4" colspan="6">No games found matching that filter.</td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>

<div class="mt-3">
    {{ $games->links() }}
</div>

<p class="text-center text-muted mt-4">Prepared By: Ezekiel Adz F. Molina | BSIT 4C</p>
@endsection