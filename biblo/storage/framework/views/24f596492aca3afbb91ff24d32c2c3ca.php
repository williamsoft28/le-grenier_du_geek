<?php $__env->startSection('content'); ?>
<!-- Conteneur plein écran sans marge -->
<div class="relative min-h-screen w-full bg-cover bg-center bg-fixed"
     style="background-image: url('https://th.bing.com/th/id/R.3dc220e921cbdf66dc22295c6d9a1f5b?rik=F6bneYjessyCXA&riu=http%3a%2f%2fwww.pearltrees.com%2fs%2fbackground%2fimage%2fc8%2f0b%2fc80b7d56ffc7dae0df5de301cfd83518.jpg&ehk=DsrS9XV0eTCQlmhCnTKd6vzUcFMFqVaSwG3iN3EA8xU%3d&risl=&pid=ImgRaw&r=0'); margin: 0; padding: 0;">

    <!-- Superposition sombre pour contraste -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <!-- Contenu principal -->
    <div class="relative z-10 flex items-center justify-center min-h-screen px-6">
        <div class="bg-white/70 backdrop-blur-md rounded-3xl shadow-2xl text-center p-10 max-w-3xl mx-auto">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Le Grenier du Geek</h1>
            <p class="text-lg text-gray-800 mb-8 leading-relaxed">
                Découvrez des ressources numériques dédiées aux étudiants en informatique :
                <br>
                cours, tutoriels et documents par domaine. Partagez et apprenez ensemble
                dans une communauté sécurisée.
            </p>
            <a href="/explore"
               class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl text-xl font-semibold shadow-lg transition transform hover:scale-105">
                🔍 Explorer les Ressources
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\Desktop\2G\le-grenier_du_geek\biblo\resources\views/dashboard.blade.php ENDPATH**/ ?>