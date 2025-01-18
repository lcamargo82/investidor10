@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Lista de Notícias</h1>

        @if(session('success'))
            <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Autor</th>
                <th scope="col">Categoria</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($news as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->author->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>
                        <a href="{{ route('admin.news.show', $item->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i> Visualizar
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

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
    </div>
@endsection
