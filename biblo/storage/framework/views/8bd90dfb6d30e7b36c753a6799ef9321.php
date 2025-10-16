<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Bibliothèque Numérique')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-blue-600 text-white p-4 shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <a href="/" class="text-xl font-bold">Bibliothèque Numérique</a>
                <div class="space-x-4">
                    <a href="/books" class="hover:underline">Livres</a>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="/forum" class="hover:underline">Forum</a>
                        <a href="/chat" class="hover:underline">Chat</a>
                        <span class="font-medium">Bonjour, <?php echo e(auth()->user()->full_name); ?></span>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="hover:underline">Déconnexion</button>
                        </form>
                        <a href="/books/create" class="bg-green-500 px-3 py-1 rounded hover:bg-green-600">Soumettre</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="hover:underline">Connexion</a>
                        <a href="<?php echo e(route('register')); ?>" class="hover:underline">S'inscrire</a>
                        <a href="<?php echo e(route('books.create')); ?>" class="bg-green-500 px-3 py-1 rounded hover:bg-green-600">Soumettre Document</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <?php if(isset($header)): ?>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <!-- Page Content -->
        <main class="container mx-auto py-6 px-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html><?php /**PATH C:\Users\pc\Desktop\2G\le-grenier_du_geek\biblo\resources\views/layouts/app.blade.php ENDPATH**/ ?>