<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Le Grenier du Geek - Bibliothèque Numérique</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #8B4513;
            --primary-dark: #654321;
            --secondary: #D2691E;
            --accent: #CD853F;
            --light: #FAEBD7;
            --dark: #2F1B0C;
            --success: #228B22;
            --error: #DC143C;
            --border-radius: 10px;
            --shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s ease;
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --text-primary: #2F1B0C;
            --text-secondary: #8B4513;
            --border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: var(--bg-gradient);
            color: var(--text-primary);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: var(--shadow);
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
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link:hover {
            color: var(--primary);
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
            border-radius: var(--border-radius);
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background: var(--secondary);
            color: white;
            border-color: var(--secondary);
        }

        .btn-secondary:hover {
            background: var(--accent);
            border-color: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
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
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            color: var(--primary);
        }

        /* Contenu Principal */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            flex: 1;
            width: 100%;
        }

        /* Section Hero simple */
        .dashboard-hero {
            text-align: center;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
        }

        .dashboard-hero h1 {
            font-size: 2.25rem;
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

        /* Section Catalogue */
        .catalog-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .document-count {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        /* Document unique */
        .document-card {
            background: var(--light);
            border-radius: var(--border-radius);
            padding: 2rem;
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            max-width: 500px;
            margin: 0 auto;
        }

        .document-icon {
            font-size: 4rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .document-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .document-author {
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }

        .document-meta {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .document-actions {
            display: flex;
            gap: 1rem;
        }

        .action-btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .action-btn-primary {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
        }

        .action-btn-primary:hover {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        }

        .action-btn-secondary {
            background: white;
            color: var(--text-primary);
            border: 1px solid var(--border);
        }

        .action-btn-secondary:hover {
            background: var(--light);
            border-color: var(--primary);
        }

        /* Section Communauté */
        .community-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .feature-card {
            background: var(--light);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            border: 1px solid var(--border);
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
        }

        .feature-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .feature-description {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        /* Section d'action */
        .action-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            text-align: center;
        }

        .action-section h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .action-section p {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Alertes */
        .alert {
            padding: 1rem;
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .alert-success {
            background: rgba(34, 139, 34, 0.1);
            color: var(--success);
            border: 1px solid rgba(34, 139, 34, 0.2);
        }

        .alert-error {
            background: rgba(220, 20, 60, 0.1);
            color: var(--error);
            border: 1px solid rgba(220, 20, 60, 0.2);
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: var(--light);
            padding: 2rem 0;
            margin-top: auto;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }

        .footer p {
            margin-bottom: 0.5rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .footer-links a {
            color: var(--light);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--accent);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .nav-links {
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .main-content {
                padding: 1rem;
            }

            .dashboard-hero {
                padding: 2rem 1rem;
            }

            .dashboard-hero h1 {
                font-size: 1.75rem;
            }

            .document-actions {
                flex-direction: column;
                width: 100%;
            }

            .action-btn {
                justify-content: center;
            }

            .features-grid {
                grid-template-columns: 1fr;
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
                <a href="<?php echo e(route('explore')); ?>" class="nav-link">
                    <i class="fas fa-book"></i>
                    Catalogue
                </a>
                <?php if(auth()->guard()->check()): ?>
                    <a href="/forum" class="nav-link">
                        <i class="fas fa-comments"></i>
                        Forum
                    </a>
                    <a href="<?php echo e(route('chatbot.index')); ?>" class="nav-link">
                        <i class="fas fa-comment"></i>
                        Chat
                    </a>
                    <div class="user-info">
                        <span class="user-greeting">Bonjour, <?php echo e(auth()->user()->full_name); ?></span>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="logout-form">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="logout-btn">
                                <i class="fas fa-sign-out-alt"></i>
                                Déconnexion
                            </button>
                        </form>
                        <a href="/books/create" class="btn btn-secondary">
                            <i class="fas fa-plus"></i>
                            Soumettre
                        </a>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="nav-link">
                        <i class="fas fa-sign-in-alt"></i>
                        Connexion
                    </a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        S'inscrire
                    </a>
                    <a href="/books/create" class="btn btn-secondary">
                        <i class="fas fa-plus"></i>
                        Soumettre
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <main class="main-content">
        <!-- Messages d'Alert -->
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-error">
                <ul class="list-disc list-inside">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Section Catalogue -->
        
            
            <!-- Document unique -->
            <

        <!-- Section Communauté -->
        <?php if(auth()->guard()->check()): ?>
        
        <?php endif; ?>

        <!-- Section d'action -->
       

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <p>© <?php echo e(date('Y')); ?> Le Grenier du Geek — Tous droits réservés.</p>
            <p>Développé avec ❤️ par la communauté.</p>
           
        </div>
    </footer>
</body>
</html><?php /**PATH C:\Users\pc\Desktop\2G\le-grenier_du_geek\biblo\resources\views/layouts/app.blade.php ENDPATH**/ ?>