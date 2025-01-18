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

        <!-- Botões de Ação -->
        <div class="mt-4">
            <a href="{{ route('news.edit', $new->id) }}" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editNewsModal">
                Editar
            </a>
            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteNewsModal">
                Deletar
            </a>
        </div>
    </div>

    <!-- Modal de Edição -->
    <div class="modal fade" id="editNewsModal" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewsModalLabel">Editar Notícia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulário de Edição -->
                    <form method="POST" action="{{ route('news.update', $new->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $new->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Conteúdo</label>
                            <textarea class="form-control" id="content" name="content" rows="3">{{ $new->content }}</textarea>
                        </div>

                        <!-- Selecionar Autor -->
                        <div class="mb-3">
                            <label for="author" class="form-label">Autor</label>
                            <select class="form-select" id="author" name="author_id">
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ $author->id == $new->author_id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Selecionar Categoria -->
                        <div class="mb-3">
                            <label for="category" class="form-label">Categoria</label>
                            <select class="form-select" id="category" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $new->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Deleção -->
    <div class="modal fade" id="deleteNewsModal" tabindex="-1" aria-labelledby="deleteNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteNewsModalLabel">Confirmar Deleção</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir esta notícia?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('news.destroy', $new->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
