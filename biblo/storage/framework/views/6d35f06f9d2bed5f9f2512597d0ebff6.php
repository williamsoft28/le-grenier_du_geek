

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-b from-gray-100 to-gray-200 py-16 px-4">
    <div class="max-w-5xl mx-auto text-center mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Forum du Grenier du Geek</h1>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">
            Rejoignez la communauté, échangez sur le développement, la sécurité, les réseaux et bien plus encore.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('forum.category.show', $category->slug)); ?>" 
               class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-2"><?php echo e($category->name); ?></h2>
                <p class="text-gray-500 text-sm">Voir les discussions →</p>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500 text-lg">Aucune catégorie disponible pour le moment.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\Desktop\2G\le-grenier_du_geek\biblo\resources\views/forum/index.blade.php ENDPATH**/ ?>