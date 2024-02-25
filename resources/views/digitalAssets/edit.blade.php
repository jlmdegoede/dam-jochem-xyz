@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Digital Asset</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('digitalAssets.update', $asset->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" value="{{ $asset->title }}" name="title" required>
        </div>
        <div class="mb-3">
            <label for="caption" class="form-label">Caption</label>
            <input type="text" class="form-control" id="caption"  value="{{ $asset->caption }}" name="caption">
        </div>
        <div class="mb-3">
            <label for="alt_text" class="form-label">Alt text</label>
            <input type="text" class="form-control" id="alt_text"  value="{{ $asset->alt_text }}" name="alt_text" required>
        </div>
        <div class="mb-3">
            <p>Current File: {{ $asset->filename }}</p>
            <label for="filename" class="form-label">File</label>
            <input type="file" class="form-control" id="filename"  value="{{ $asset->filename }}" name="filename">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Language</label>
            <input type="text" class="form-control" id="language" name="language"  value="{{ $asset->language }}" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-control" id="category_id" name="category_id">
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        @if ($asset->category_id == $category->id)
                            selected="selected"
                        @endif
                    >{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <!-- Add other fields as necessary -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
