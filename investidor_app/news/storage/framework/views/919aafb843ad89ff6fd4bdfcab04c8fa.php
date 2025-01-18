<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Últimas Notícias</h1>
                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="noticia">
                        <h2><?php echo e($new->title); ?></h2>
                        <p><?php echo e($new->content); ?></p>
                        <a href="#">Acessar</a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/news/resources/views/home.blade.php ENDPATH**/ ?>