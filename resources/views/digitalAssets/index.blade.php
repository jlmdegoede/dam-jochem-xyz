@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Digital Assets</h1>
    <a href="{{ route('digitalAssets.create') }}" class="btn btn-primary mb-3">Create New Asset</a>
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
                        {{ $asset->caption }}
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
