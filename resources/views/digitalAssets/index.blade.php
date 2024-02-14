@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Digital Assets</h1>
    <div class="row">
        @foreach ($digitalAssets as $asset)
        <div class="col-md-4 mb-4">
            <a href="{{ route('digitalAssets.view', $asset->id) }}">
            <div class="card">
                <img src="{{ Storage::url($asset->filename) }}" class="card-img-top" alt="{{ $asset->alt_text }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $asset->title }}</h5>
                    <p class="card-text">{{ $asset->caption }}</p>
                    <!-- Add more details you want to show -->
                </div>
            </div>
            </a>
        </div>
        @endforeach
    </div>
    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {!! $digitalAssets->links() !!}
    </div>
</div>
@endsection
