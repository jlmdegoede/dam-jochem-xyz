@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Category</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $category->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $category->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="parent_id" class="form-label">Parent Category (Optional)</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">None</option>
                @foreach ($categories as $childCategory)
                    <option value="{{ $childCategory->id }}"
                        @if ($childCategory->id == $category->category)
                            selected
                        @endif
                    >{{ $childCategory->title }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit Category</button>
    </form>
</div>
@endsection
