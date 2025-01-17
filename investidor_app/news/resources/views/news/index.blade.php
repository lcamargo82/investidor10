@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Últimas Notícias</h1>
                @foreach($news as $new)
                    <div class="noticia">
                        <h2>{{ $new->title }}</h2>
                        <p>{{ $new->content }}</p>
                        <a href="#">Acessar</a>
                    </div>
                @endforeach
    </div>
@endsection
