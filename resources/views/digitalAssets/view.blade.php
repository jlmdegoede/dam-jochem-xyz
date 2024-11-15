@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-3 mb-3">
            <a href="{{ route('digitalAssets.index') }}" class="btn btn-secondary">Back to Index</a>
    </div>
    <div class="col-12">
        <div class="card">
            <img src="{{ Storage::url($digitalAsset->filename) }}" class="card-img-top" alt="{{ $digitalAsset->alt_text }}">
            <div class="card-body">
                <h5 class="card-title">{{ $digitalAsset->title }}</h5>
                <p class="card-text">
                    {{ $digitalAsset->caption }} <br/>
                    Category: {{ $digitalAsset->category->title }} <br/>
                    Language: {{ $digitalAsset->language }} <br/>

                    URL to embed: https://assets.techword.nl/{{ $digitalAsset->filename }}
                </p>
                <a href="{{ route('digitalAssets.edit', $digitalAsset->id) }}" class="btn btn-primary">Edit Asset</a>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
