@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <h1 class="mb-3">{{ $new->title }}</h1>

        <p class="text-muted" style="font-size: 0.9rem;">
            <span><strong>Autor:</strong> {{ $new->author->name }}</span> |
            <span><strong>Data:</strong> {{ $new->created_at->format('d/m/Y') }}</span>
        </p>

        <div class="news-content">
            <p class="lead">{!! nl2br(e($new->content)) !!}</p>
        </div>
    </div>
@endsection
