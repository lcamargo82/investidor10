<?php $__env->startSection('content'); ?>
    <div class="container my-4">
        <h1 class="mb-3"><?php echo e($new->title); ?></h1>

        <p class="text-muted" style="font-size: 0.9rem;">
            <span><strong>Autor:</strong> <?php echo e($new->author->name); ?></span> |
            <span><strong>Data:</strong> <?php echo e($new->created_at->format('d/m/Y')); ?></span>
        </p>

        <div class="news-content">
            <p class="lead"><?php echo nl2br(e($new->content)); ?></p>
        </div>

        <div class="mt-4">
            <a href="<?php echo e(route('news.edit', $new->id)); ?>" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editNewsModal">
                Editar
            </a>
            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteNewsModal">
                Deletar
            </a>
        </div>
    </div>

    <div class="modal fade" id="editNewsModal" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewsModalLabel">Editar Notícia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo e(route('news.update', $new->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo e($new->title); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Conteúdo</label>
                            <textarea class="form-control" id="content" name="content" rows="3"><?php echo e($new->content); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="author" class="form-label">Autor</label>
                            <select class="form-select" id="author" name="author_id">
                                <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($author->id); ?>" <?php echo e($author->id == $new->author_id ? 'selected' : ''); ?>>
                                        <?php echo e($author->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Categoria</label>
                            <select class="form-select" id="category" name="category_id">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e($category->id == $new->category_id ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                    <form method="POST" action="<?php echo e(route('news.destroy', $new->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/news/resources/views/news/admin/news/show.blade.php ENDPATH**/ ?>