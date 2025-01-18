@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Últimas Notícias</h1>

        <div class="row">
            @if(isset($news) && $news->isNotEmpty())
                <div class="row">
                @foreach($news as $new)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 d-flex flex-column">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $new->title }}</h5>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <p class="card-text">{{ Str::limit($new->content, 150) }}</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('news.show', $new->id) }}" class="btn btn-primary">Acessar</a>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    Publicado em: {{ $new->created_at->format('d/m/Y') }} por {{ $new->author->name }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    <nav aria-label="Navegação de página">
                        <ul class="pagination">
                            <li class="page-item {{ $news->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $news->previousPageUrl() }}" aria-label="Anterior">
                                    Anterior
                                </a>
                            </li>
                            <li class="page-item">
                            <span class="page-link">
                                Mostrando {{ $news->firstItem() }} a {{ $news->lastItem() }} de {{ $news->total() }} resultados
                            </span>
                            </li>
                            <li class="page-item {{ $news->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $news->nextPageUrl() }}" aria-label="Próximo">
                                    Próximo
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @else
                <p class="text-muted">Nenhuma notícia encontrada.</p>
            @endif
        </div>
    </div>
@endsection
