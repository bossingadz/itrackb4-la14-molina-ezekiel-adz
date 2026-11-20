@extends('layouts.app')

@section('title', $game->title)

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <p class="text-secondary mb-1">Game details</p>
        <h1 class="h2 mb-0">{{ $game->title }}</h1>
    </div>
    <span class="badge rounded-pill {{ $game->is_available ? 'text-bg-success' : 'text-bg-secondary' }} fs-6">
        {{ $game->is_available ? 'Available' : 'Unavailable' }}
    </span>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        Game information
    </div>
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3 text-secondary">Record ID</dt>
            <dd class="col-sm-9">{{ $game->id }}</dd>

            <dt class="col-sm-3 text-secondary">Platform</dt>
            <dd class="col-sm-9">{{ $game->platform->name }}</dd>

            <dt class="col-sm-3 text-secondary">Price</dt>
            <dd class="col-sm-9">₱{{ number_format($game->price, 2) }}</dd>

            <dt class="col-sm-3 text-secondary">Stock</dt>
            <dd class="col-sm-9">{{ $game->stock }} pcs</dd>
        </dl>
    </div>
</div>

<div class="d-flex flex-wrap gap-2 mt-4">
    <a href="{{ route('monsterhunters.index') }}" class="btn btn-outline-secondary">Back to Game List</a>
    <a href="{{ route('monsterhunters.edit', $game) }}" class="btn btn-primary">Edit Game</a>
</div>
@endsection