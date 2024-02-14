@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Digital Asset</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('digitalAssets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="filename" class="form-label">File</label>
            <input type="file" class="form-control" id="filename" name="filename" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-control" id="category_id" name="category_id">
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <!-- Add other fields as necessary -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
