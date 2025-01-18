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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/news/resources/views/news/show.blade.php ENDPATH**/ ?>