@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Digital Assets</h1>
    <a href="{{ route('digitalAssets.create') }}" class="btn btn-primary mb-3">Create New Asset</a>

    <div class="row mb-3">
        <div class="col-12 col-md-6 col-lg-3">
            <form method="GET" action="{{ route('digitalAssets.index') }}">
                <div class="form-group">
                    <label for="category">Filter by Category</label>
                    <select class="form-control" id="category" name="category" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (isset($selectedCategory) && $selectedCategory==
                                $category->id) ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @foreach ($digitalAssets as $asset)
        <div class="col-md-4 mb-4">
            <div class="card">
                <a href="{{ route('digitalAssets.view', $asset->id) }}">
                    <img src="{{ Storage::url($asset->filename) }}" class="card-img-top" alt="{{ $asset->alt_text }}">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $asset->title }}</h5>
                    <p class="card-text">
                        {{ $asset->caption }}</p>
                    <p class="card-text">Created on {{ $asset->created_at->format('d-m-Y') }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {!! $digitalAssets->links() !!}
    </div>
</div>
@endsection
