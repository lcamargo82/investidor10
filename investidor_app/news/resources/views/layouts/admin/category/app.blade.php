<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notícias</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body class="d-flex flex-column min-vh-100">
<header class="bg-primary text-white py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('news.index') }}" class="text-white text-decoration-none">
                    <h3>Logo</h3>
                </a>
            </div>

            <div class="d-flex">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <button type="button" class="btn btn-light me-4" data-bs-toggle="modal" data-bs-target="#createNewsModal">
                                    Cadastrar Notícia
                                </button>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.category') }}" class="btn btn-light ms-2 me-4">Visualizar Categorias</a>
                            </li>
                            <li class="nav-item">
                                <form class="d-flex" action="{{ route('admin.category.search') }}" method="GET">
                                    <input class="form-control me-1" type="search" placeholder="Buscar categoria" aria-label="Buscar" name="q" value="{{ request('q') }}">
                                    <button class="btn btn-outline-light" type="submit">Buscar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<div class="modal fade" id="createNewsModal" tabindex="-1" aria-labelledby="createNewsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createNewsModalLabel">Cadastrar Nova Notícia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('news.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Título da notícia">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Conteúdo</label>
                        <textarea class="form-control" id="content" name="content" rows="3" placeholder="Conteúdo da notícia"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Autor</label>
                        <select class="form-select" id="author" name="author_id">
                            <option selected>Escolha o autor</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria</label>
                        <select class="form-select" id="category" name="category_id">
                            <option selected>Escolha a categoria</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Notícia</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
