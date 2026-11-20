@extends('layouts.app')

@section('title', 'Server Error')

@section('content')
<div class="text-center py-5">
    <h1 class="display-1 fw-bold text-warning">500</h1>
    <h2 class="h3 mb-3">Something Went Wrong</h2>
    <p class="text-secondary mb-4">An unexpected system error occurred on our server while processing your Monster Hunter request. Our team has been notified.</p>
    <a href="{{ route('monsterhunters.index') }}" class="btn btn-secondary">Return to Safety</a>
</div>
@endsection