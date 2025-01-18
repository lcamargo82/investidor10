<?php $__env->startSection('content'); ?>
    <div class="container">
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

        <h1 class="my-4">Categorias</h1>

        <button type="button" class="btn btn-success me-4" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
            Cadastrar Categoria
        </button>

        <table class="table table-sm mt-3">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($category->id); ?></td>
                    <td><?php echo e($category->name); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.category.show', $category->id)); ?>" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i> Visualizar
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Criar Nova Categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo e(route('admin.category.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-3">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Criar Categoria</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" id="editModal<?php echo e($category->id); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo e($category->id); ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel<?php echo e($category->id); ?>">Editar Categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('admin.category.update', $category->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $category->name)); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        <nav aria-label="Navegação de página">
            <ul class="pagination">
                <li class="page-item <?php echo e($categories->onFirstPage() ? 'disabled' : ''); ?>">
                    <a class="page-link" href="<?php echo e($categories->previousPageUrl()); ?>" aria-label="Anterior">
                        Anterior
                    </a>
                </li>
                <li class="page-item">
                            <span class="page-link">
                                Mostrando <?php echo e($categories->firstItem()); ?> a <?php echo e($categories->lastItem()); ?> de <?php echo e($categories->total()); ?> resultados
                            </span>
                </li>
                <li class="page-item <?php echo e($categories->hasMorePages() ? '' : 'disabled'); ?>">
                    <a class="page-link" href="<?php echo e($categories->nextPageUrl()); ?>" aria-label="Próximo">
                        Próximo
                    </a>
                </li>
            </ul>
        </nav>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.category.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/news/resources/views/news/admin/category/index.blade.php ENDPATH**/ ?>