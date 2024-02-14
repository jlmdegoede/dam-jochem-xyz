@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-12">
        <div class="card">
            <img src="{{ Storage::url($digitalAsset->filename) }}" class="card-img-top" alt="{{ $digitalAsset->alt_text }}">
            <div class="card-body">
                <h5 class="card-title">{{ $digitalAsset->title }}</h5>
                <p class="card-text">{{ $digitalAsset->caption }}</p>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
