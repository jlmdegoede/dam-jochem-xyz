@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create New Category</a>
    <div class="list-group">
        @foreach ($categories as $category)
        <a href="#" class="list-group-item list-group-item-action">
            <h5 class="mb-1">{{ $category->title }}</h5>
            <p class="mb-1">{{ $category->description }}</p>
            <!-- Add more details or actions here -->
        </a>
        @endforeach
    </div>
</div>
@endsection
