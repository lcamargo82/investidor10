<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notícias</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body class="d-flex flex-column min-vh-100">
<header class="bg-primary text-white py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="<?php echo e(route('news.index')); ?>" class="text-white text-decoration-none">
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
                                <a href="<?php echo e(route('news.listNews')); ?>" class="btn btn-light ms-2 me-4">Exibir Notícias</a>
                            </li>
                            <li class="nav-item">
                                <form class="d-flex" action="<?php echo e(route('news.search')); ?>" method="GET">
                                    <input class="form-control me-1" type="search" placeholder="Buscar notícias" aria-label="Buscar" name="q" value="<?php echo e(request('q')); ?>">
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

<div class="content">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<footer class="mt-auto bg-dark text-white py-3">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p>&copy; 2025 - Desenvolvido por Leandro Camargo</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
<?php /**PATH /var/www/news/resources/views/layouts/app.blade.php ENDPATH**/ ?>