@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="text-center py-5">
    <h1 class="display-1 fw-bold text-danger">404</h1>
    <h2 class="h3 mb-3">Monster Hunter Record Not Found</h2>
    <p class="text-secondary mb-4">The game or page you are looking for does not exist in our catalog.</p>
    <a href="{{ route('monsterhunters.index') }}" class="btn btn-primary">Back to the list</a>
</div>
@endsection