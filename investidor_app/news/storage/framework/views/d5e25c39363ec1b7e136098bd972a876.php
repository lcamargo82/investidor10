<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1 class="my-4">Últimas Notícias</h1>

        <div class="row">
            <?php if(isset($news) && $news->isNotEmpty()): ?>
                <div class="row">
                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 d-flex flex-column">
                                <div class="card-header">
                                    <h5 class="card-title"><?php echo e($new->title); ?></h5>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <p class="card-text"><?php echo e(Str::limit($new->content, 150)); ?></p>
                                    <div class="mt-auto">
                                        <a href="<?php echo e(route('news.show', $new->id)); ?>" class="btn btn-primary">Acessar</a>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    Publicado em: <?php echo e($new->created_at->format('d/m/Y')); ?> por <?php echo e($new->author->name); ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    <nav aria-label="Navegação de página">
                        <ul class="pagination">
                            <li class="page-item <?php echo e($news->onFirstPage() ? 'disabled' : ''); ?>">
                                <a class="page-link" href="<?php echo e($news->previousPageUrl()); ?>" aria-label="Anterior">
                                    Anterior
                                </a>
                            </li>
                            <li class="page-item">
                            <span class="page-link">
                                Mostrando <?php echo e($news->firstItem()); ?> a <?php echo e($news->lastItem()); ?> de <?php echo e($news->total()); ?> resultados
                            </span>
                            </li>
                            <li class="page-item <?php echo e($news->hasMorePages() ? '' : 'disabled'); ?>">
                                <a class="page-link" href="<?php echo e($news->nextPageUrl()); ?>" aria-label="Próximo">
                                    Próximo
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <?php else: ?>
                <p class="text-muted">Nenhuma notícia encontrada.</p>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/news/resources/views/news/index.blade.php ENDPATH**/ ?>