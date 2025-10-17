<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Le Grenier du Geek - Bibliothèque Numérique</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1; /* Indigo pour pro */
            --secondary: #10b981; /* Vert pour actions */
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: var(--card-shadow);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logo::before {
            content: "📚";
            margin-right: 0.5rem;
            font-size: 1.25rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
            border-bottom: 2px solid transparent;
        }

        .nav-link:hover {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-greeting {
            font-size: 0.875rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .btn {
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: #4f46e5;
            border-color: #4f46e5;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: var(--secondary);
            color: white;
            border-color: var(--secondary);
        }

        .btn-secondary:hover {
            background: #059669;
            border-color: #059669;
            transform: translateY(-1px);
        }

        .logout-form {
            display: inline;
        }

        .logout-btn {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-weight: 500;
            transition: color 0.2s;
        }

        .logout-btn:hover {
            color: var(--primary);
        }

        /* Contenu Principal */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            min-height: calc(100vh - 80px);
        }

        .dashboard-hero {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 1rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }

        .dashboard-hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .dashboard-hero p {
            font-size: 1.125rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .explore-btn {
            display: inline-block;
            padding: 1rem 2rem;
            background: var(--primary);
            color: white;
            border-radius: 0.75rem;
            font-size: 1.125rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: var(--card-shadow);
        }

        .explore-btn:hover {
            background: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }

        .categories-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }

        .categories-section h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .category-card {
            background: var(--bg-gradient);
            border-radius: 1rem;
            padding: 1.5rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.2s;
            border: 1px solid var(--border);
        }

        .category-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow);
        }

        .category-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .category-card p {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .nav-links {
                gap: 1rem;
            }

            .main-content {
                padding: 1rem;
            }

            .dashboard-hero {
                padding: 2rem 1rem;
            }

            .dashboard-hero h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">Le Grenier du Geek</a>
            <div class="nav-links">
                <a href="/books" class="nav-link">Livres</a>
                <?php if(auth()->guard()->check()): ?>
                    <a href="/forum" class="nav-link">Forum</a>
                    <a href="/chat" class="nav-link">Chat</a>
                    <div class="user-info">
                        <span class="user-greeting">Bonjour, <?php echo e(auth()->user()->full_name); ?></span>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="logout-form">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="logout-btn">Déconnexion</button>
                        </form>
                        <a href="/books/create" class="btn btn-secondary">+ Soumettre</a>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="nav-link">Connexion</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">S'inscrire</a>
                    <a href="/books/create" class="btn btn-secondary">Soumettre Document</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <main class="main-content">
        <!-- Messages d'Alert -->
        <?php if(session('success')): ?>
            <div class="alert alert-success mx-auto max-w-md">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-error mx-auto max-w-md">
                <ul class="list-disc list-inside">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html><?php /**PATH C:\Users\pc\Desktop\2G\le-grenier_du_geek\biblo\resources\views/layouts/app.blade.php ENDPATH**/ ?>