<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notícias</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header>
    <div class="container">
        botoes
{{--        <nav>--}}
{{--            <ul>--}}
{{--                <li><a href="#">Início</a></li>--}}
{{--                <li><a href="{{ route('noticias') }}">Notícias</a></li>--}}
{{--                <li><a href="{{ route('sobre') }}">Sobre</a></li>--}}
{{--                <li><a href="{{ route('contato') }}">Contato</a></li>--}}
{{--            </ul>--}}
{{--        </nav>--}}
{{--        <div class="search-bar">--}}
{{--            <form action="{{ route('pesquisar') }}" method="GET">--}}
{{--                <input type="text" name="q" placeholder="Pesquisar notícias..." required>--}}
{{--                <button type="submit">Pesquisar</button>--}}
{{--            </form>--}}
{{--        </div>--}}
    </div>
</header>

<!-- Conteúdo específico da página -->
<div class="content">
    @yield('content')
</div>

<!-- Rodapé incluído ao final -->
<footer>
    <div class="container">
        <p>&copy; 2025 - Desenvolvido por Leandro Camargo</p>
    </div>
</footer>

</body>
</html>
