<?php $__env->startSection('content'); ?>
    <h1>Liste des catégories</h1>
    
    <?php if(session('success')): ?>
        <div style="color:green;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <a href="<?php echo e(route('admin.categories.create')); ?>">Créer une nouvelle catégorie</a>

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top:20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Slug</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($cat->id); ?></td>
                <td><?php echo e($cat->title); ?></td>
                <td><?php echo e($cat->slug); ?></td>
                <td><?php echo e($cat->description); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\Desktop\2G\le-grenier_du_geek\biblo\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>