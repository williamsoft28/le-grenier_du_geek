<?php $__env->startSection('content'); ?>
    <h1>Créer une nouvelle catégorie</h1>
    
    <?php if($errors->any()): ?>
        <div style="color:red;">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.categories.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div>
            <label for="title">Titre :</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="slug">Slug :</label>
            <input type="text" name="slug" id="slug" required>
        </div>
        <div>
            <label for="description">Description :</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <button type="submit">Créer la catégorie</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\Desktop\2G\le-grenier_du_geek\biblo\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>