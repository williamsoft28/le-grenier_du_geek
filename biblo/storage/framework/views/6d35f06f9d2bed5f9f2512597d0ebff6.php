

<?php $__env->startSection('content'); ?>
<div class="py-8 max-w-6xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Forum du Grenier du Geek</h1>
        <p class="text-lg text-gray-600">Échangez sur vos domaines préférés : IA, web, BD, sécurité et programmation. Démarrez une discussion dans une catégorie !</p>
    </div>

    <?php if(auth()->guard()->check()): ?>
        <div class="mb-8 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
            <h2 class="font-semibold text-blue-800 mb-2">Prêt à discuter ?</h2>
            <p class="text-blue-700">Choisissez une catégorie pour démarrer une nouvelle discussion.</p>
        </div>
    <?php else: ?>
        <div class="mb-8 p-4 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
            <h2 class="font-semibold text-yellow-800 mb-2">Connectez-vous pour Poster</h2>
            <p class="text-yellow-700">Créez un compte pour démarrer des discussions et interagir.</p>
            <a href="<?php echo e(route('register')); ?>" class="mt-2 inline-block bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">S'inscrire</a>
        </div>
    <?php endif; ?>

    <!-- Grille des Catégories -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <h3 class="text-xl font-semibold mb-2"><?php echo e($category->title); ?></h3>
                <p class="text-gray-600 mb-4"><?php echo e(Str::limit($category->description, 100)); ?></p>
                <p class="text-sm text-gray-500 mb-4"><?php echo e($category->threads_count); ?> discussions · <?php echo e($category->posts_count); ?> posts</p>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('forum.thread.create', $category->id)); ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm font-medium">Démarrer Discussion</a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 text-sm font-medium">Se Connecter pour Poster</a>
                <?php endif; ?>
                <a href="<?php echo e(route('forum.category.show', $category)); ?>" class="block mt-3 text-blue-600 hover:underline text-sm">Voir les Discussions</a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if($categories->isEmpty()): ?>
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Aucune catégorie disponible pour le moment.</p>
            <?php if(auth()->guard()->check()): ?>
                <a href="/admin/categories/create" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Créer la Première</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\Desktop\2G\le-grenier_du_geek\biblo\resources\views/forum/index.blade.php ENDPATH**/ ?>