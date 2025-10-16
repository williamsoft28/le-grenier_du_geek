

<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold mb-4">Catalogue de Livres</h1>
<form method="GET" class="mb-4">
    <input type="text" name="q" placeholder="Rechercher par titre, auteur, niveau ou module..." class="border p-2 rounded" value="<?php echo e(request('q')); ?>">
    <button type="submit" class="bg-blue-500 text-white p-2 rounded ml-2">Chercher</button>
    <a href="<?php echo e(route('books.create')); ?>" class="bg-green-500 text-white p-2 rounded ml-2">Soumettre Document</a>
</form>
<?php if($books->count() > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold"><?php echo e($book->title); ?></h2>
            <p class="text-sm text-gray-600">Auteur: <?php echo e($book->author); ?></p>
            <p class="text-sm">Niveau: <?php echo e($book->niveau_etude); ?> | Module: <?php echo e($book->module); ?></p>
            <p><?php echo e(Str::limit($book->description, 100)); ?></p>
            <?php if($book->tutoriel): ?>
                <p class="text-xs text-blue-600">Tutoriel disponible</p>
            <?php endif; ?>
            <a href="<?php echo e(route('books.show', $book)); ?>" class="text-blue-500 hover:underline">Voir/Télécharger</a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php echo e($books->links()); ?>

<?php else: ?>
    <p>Aucun livre pour l'instant. <a href="<?php echo e(route('books.create')); ?>" class="text-blue-500">Soumettez le premier !</a></p>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\Desktop\2G\le-grenier_du_geek\biblo\resources\views/books/index.blade.php ENDPATH**/ ?>