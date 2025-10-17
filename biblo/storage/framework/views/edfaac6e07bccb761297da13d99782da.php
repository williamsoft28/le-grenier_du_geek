

<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold mb-4"><?php echo e($book->title); ?></h1>
<p class="text-lg mb-2">Auteur: <?php echo e($book->author); ?></p>
<p class="mb-2">Niveau: <?php echo e($book->niveau_etude); ?> | Module: <?php echo e($book->module); ?></p>
<p class="mb-4"><?php echo e($book->description); ?></p>
<?php if($book->tutoriel): ?>
    <div class="bg-yellow-100 p-4 rounded mb-4">
        <h3 class="font-semibold">Tutoriel :</h3>
        <p><?php echo e($book->tutoriel); ?></p>
    </div>
<?php endif; ?>
<iframe src="<?php echo e(Storage::url($book->file_path)); ?>" class="w-full h-96 border rounded mb-4" title="Aperçu"></iframe>
<a href="<?php echo e(Storage::url($book->file_path)); ?>" download class="bg-blue-500 text-white px-4 py-2 rounded">Télécharger</a>
<a href="<?php echo e(route('books.index')); ?>" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Retour</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\Desktop\2G\le-grenier_du_geek\biblo\resources\views/books/show.blade.php ENDPATH**/ ?>