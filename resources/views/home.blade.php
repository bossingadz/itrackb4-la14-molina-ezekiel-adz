@extends('layouts.app')

@section('title', 'Monster Hunter Portal')

@section('content')
<div class="row align-items-center g-4 mb-4">
    <div class="col-auto">
        <img src="{{ asset('img/profile.jpg') }}" width="96" height="96" class="rounded-circle border" alt="Profile photo">
    </div>
    <div class="col">
        <p class="mb-1"><strong>Ezekiel Adz F. Molina</strong></p>
        <p class="mb-0">BSIT &middot; 4th Year &middot; Block C</p>
    </div>
</div>

<h2>Explore and Manage Monster Hunter Games</h2>
<p class="lead">Browse, filter, and maintain a collection of Monster Hunter Games across platforms.</p>
<a href="{{ route('monsterhunters.index') }}" class="btn btn-primary">Browse the Game List</a>

<div class="row g-3 mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="h5">Games</h3>
                <p class="display-6 mb-0">{{ $gameCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="h5">Platforms</h3>
                <p class="display-6 mb-0">{{ $platformCount }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
