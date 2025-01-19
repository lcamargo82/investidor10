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

        <h1>Categoria: <?php echo e($category->name); ?></h1>

        <div class="mb-3">
            <a href="#"
               class="btn btn-primary"
               data-bs-toggle="modal"
               data-bs-target="#editCategoryModal">
                Editar
            </a>

            <a href="#"
               class="btn btn-danger"
               data-bs-toggle="modal"
               data-bs-target="#deleteCategoryModal">
                Deletar
            </a>
        </div>

        <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Editar Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?php echo e(route('admin.category.update', $category->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="form-group mb-3">
                                <label for="name">Nome da Categoria</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $category->name)); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCategoryModalLabel">Confirmar Deleção</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja excluir esta categoria?</p>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="<?php echo e(route('admin.category.destroy', $category->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/news/resources/views/news/admin/category/show.blade.php ENDPATH**/ ?>