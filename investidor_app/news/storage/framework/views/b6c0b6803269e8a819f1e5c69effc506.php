<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1 class="my-4">Lista de Notícias</h1>

        <?php if(session('success')): ?>
            <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

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
            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($item->id); ?></th>
                    <td><?php echo e($item->title); ?></td>
                    <td><?php echo e($item->author->name); ?></td>
                    <td><?php echo e($item->category->name); ?></td>
                    <td>
                        <a href="<?php echo e(route('news.show', $item->id)); ?>" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i> Visualizar
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="modal fade" id="deleteNewsModal" tabindex="-1" aria-labelledby="deleteNewsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteNewsModalLabel">Confirmar Deleção</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza de que deseja excluir esta notícia?</p>
                    </div>
                    <div class="modal-footer">
ß                        <form id="deleteForm" method="POST" action="">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                    </div>
                </div>
            </div>
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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/news/resources/views/news/list.blade.php ENDPATH**/ ?>