

<?php $__env->startSection('content'); ?>
<!-- IMPORTANT: Ce template utilise Tailwind CSS (v3+) et un petit script vanilla pour l'accessibilité.
     Optionnel: tu peux remplacer les icônes SVG par heroicons ou lucide si tu veux.
     Ajout: Groupement par catégorie avec IDs pour classification (e.g., id="category-ia"). Styles différents par catégorie (couleurs Tailwind).
     Groupement manuel via PHP in Blade (assume $books trié par module ; pour perf, groupe en contrôleur).
-->

<div class="min-h-screen bg-gradient-to-b from-slate-50 to-white py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Header / Hero -->
    <header class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
      <div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">Explorer les catégories</h1>
        <p class="mt-3 text-lg text-slate-600 max-w-2xl">Choisis un domaine et découvre des ressources, tutoriels et documents partagés par la communauté.</p>
      </div>

      <div class="w-full md:w-auto flex items-center gap-3">
        <!-- Search -->
        <form method="GET" action="<?php echo e(url()->current()); ?>" class="flex items-center gap-2 w-full md:w-80">
          <label for="q" class="sr-only">Rechercher</label>
          <div class="relative w-full">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35"></path><circle cx="11" cy="11" r="6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle></svg>
            <input id="q" name="q" value="<?php echo e(request('q')); ?>" class="w-full pl-10 pr-4 py-2 rounded-lg border border-slate-200 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Rechercher titre, auteur, module...">
          </div>
        </form>

        <!-- Explore modal trigger -->
        <button onclick="openExplore()" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow"> 
          <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
          Explorer
        </button>
      </div>
    </header>

    <!-- Filters / Stats bar -->
    <div class="mt-8 flex items-center justify-between gap-4">
      <div class="flex items-center gap-3 text-sm text-slate-600">
        <span class="font-medium text-slate-800"><?php echo e($books->total()); ?> documents</span>
        <span>&middot;</span>
        <span><?php echo e($books->count()); ?> affichés</span>
      </div>

      <div class="flex items-center gap-3">
        <a href="/books?sort=new" class="px-3 py-1 rounded-md text-sm bg-slate-100 hover:bg-slate-200">Plus récents</a>
        <a href="/books?sort=popular" class="px-3 py-1 rounded-md text-sm bg-slate-100 hover:bg-slate-200">Populaires</a>
      </div>
    </div>

    <!-- Groupement par Catégorie (IDs pour classification, styles différents par cat) -->
    <?php
        // Groupement manuel par module (catégorie)
        $groupedBooks = $books->groupBy('module');
        $categories = [
            'ia' => ['name' => 'IA & Machine Learning', 'color' => 'indigo'],
            'web' => ['name' => 'Développement Web', 'color' => 'purple'],
            'bd' => ['name' => 'Bases de Données', 'color' => 'green'],
            'securite' => ['name' => 'Sécurité Informatique', 'color' => 'red'],
            'prog' => ['name' => 'Programmation', 'color' => 'yellow'],
        ];
    ?>

    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <section id="category-<?php echo e($slug); ?>" class="mb-12">
            <h2 class="text-2xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                <span class="px-3 py-1 rounded-full bg-<?php echo e($cat['color']); ?>-100 text-<?php echo e($cat['color']); ?>-800 font-semibold text-sm">
                    <?php echo e($cat['name']); ?>

                </span>
                <span class="text-sm text-slate-500">(<?php echo e($groupedBooks->get($slug, collect())->count()); ?> docs)</span>
            </h2>

            <?php if($groupedBooks->get($slug, collect())->count() > 0): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $groupedBooks->get($slug); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="bg-white rounded-2xl shadow-sm hover:shadow-md transform hover:-translate-y-1 transition p-5 flex flex-col border border-<?php echo e($cat['color']); ?>-100">
                            <div class="flex items-start gap-4">
                                <!-- Miniature avec style cat -->
                                <div class="flex-shrink-0 w-20 h-28 bg-gradient-to-br from-<?php echo e($cat['color']); ?>-50 to-<?php echo e($cat['color']); ?>-100 rounded-md overflow-hidden flex items-center justify-center">
                                    <span class="text-xs font-semibold text-<?php echo e($cat['color']); ?>-700"><?php echo e(strtoupper(substr($book->title, 0, 3))); ?></span>
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-slate-900"><?php echo e($book->title); ?></h3>
                                    <p class="mt-1 text-sm text-slate-500">Par <span class="font-medium text-slate-700"><?php echo e($book->author); ?></span> · <?php echo e($book->niveau_etude); ?></p>

                                    <p class="mt-3 text-slate-700 text-sm leading-relaxed"><?php echo e(Str::limit($book->description, 140)); ?></p>

                                    <div class="mt-4 flex items-center gap-2">
                                        <a href="<?php echo e(route('books.show', $book)); ?>" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg border border-transparent bg-<?php echo e($cat['color']); ?>-600 text-white hover:bg-<?php echo e($cat['color']); ?>-700">Voir</a>

                                        <?php if(auth()->guard()->check()): ?>
                                            <a href="<?php echo e(Storage::url($book->file_path)); ?>" download class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg border border-<?php echo e($cat['color']); ?>-200 bg-white text-<?php echo e($cat['color']); ?>-700 hover:bg-<?php echo e($cat['color']); ?>-50">Télécharger</a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg border border-slate-200 bg-white text-slate-800 hover:bg-slate-50">Créer un compte</a>
                                        <?php endif; ?>

                                        <?php if($book->tutoriel): ?>
                                            <span class="ml-auto text-xs inline-flex items-center gap-2 px-2 py-1 rounded-full bg-emerald-50 text-emerald-700">📘 Tutoriel</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="bg-<?php echo e($cat['color']); ?>-50 border border-<?php echo e($cat['color']); ?>-200 rounded-xl p-8 text-center">
                    <h3 class="text-xl font-semibold text-<?php echo e($cat['color']); ?>-800 mb-2">Aucun document dans <?php echo e($cat['name']); ?></h3>
                    <p class="text-<?php echo e($cat['color']); ?>-600 mb-4">Soyez le premier à contribuer à cette catégorie !</p>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="/books/create?module=<?php echo e($slug); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-<?php echo e($cat['color']); ?>-600 text-white rounded-lg font-medium hover:bg-<?php echo e($cat['color']); ?>-700">+ Ajouter un Document</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-600 text-white rounded-lg font-medium hover:bg-slate-700">Créer un Compte</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- Pagination globale -->
    <div class="mt-8 flex items-center justify-center">
      <?php echo e($books->appends(request()->query())->links()); ?>

    </div>

  </div>
</div>

<!-- Overlay / Modal d'exploration (accessible) -->
<div id="overlay" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="overlay-title">
  <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeExplore()"></div>
  <div class="fixed inset-0 flex items-center justify-center p-6">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg overflow-hidden">
      <div class="p-6 border-b flex items-center justify-between">
        <h2 id="overlay-title" class="text-xl font-semibold">Catégories Informatique</h2>
        <div class="flex items-center gap-3">
          <button onclick="closeExplore()" aria-label="Fermer" class="rounded-md p-2 hover:bg-slate-100">
            <svg class="h-6 w-6 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>
      </div>

      <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="/books?cat=ia" class="group p-4 border rounded-lg hover:shadow transition flex flex-col">
          <h3 class="font-semibold text-indigo-800 group-hover:text-indigo-900">IA & Machine Learning</h3>
          <p class="text-sm text-slate-500 mt-1">Algorithmes, Deep Learning, NLP</p>
        </a>
        <a href="/books?cat=web" class="group p-4 border rounded-lg hover:shadow transition flex flex-col">
          <h3 class="font-semibold text-purple-800 group-hover:text-purple-900">Développement Web</h3>
          <p class="text-sm text-slate-500 mt-1">HTML, JavaScript, Frameworks</p>
        </a>
        <a href="/books?cat=bd" class="group p-4 border rounded-lg hover:shadow transition flex flex-col">
          <h3 class="font-semibold text-green-800 group-hover:text-green-900">Bases de données</h3>
          <p class="text-sm text-slate-500 mt-1">SQL, NoSQL, Modélisation</p>
        </a>
        <a href="/books?cat=securite" class="group p-4 border rounded-lg hover:shadow transition flex flex-col">
          <h3 class="font-semibold text-red-800 group-hover:text-red-900">Sécurité</h3>
          <p class="text-sm text-slate-500 mt-1">Cryptographie, Réseau, Audit</p>
        </a>
        <a href="/books?cat=prog" class="group p-4 border rounded-lg hover:shadow transition flex flex-col">
          <h3 class="font-semibold text-yellow-800 group-hover:text-yellow-900">Programmation</h3>
          <p class="text-sm text-slate-500 mt-1">Python, Java, Rust</p>
        </a>
        <a href="/books" class="group p-4 border rounded-lg hover:shadow transition flex flex-col">
          <h3 class="font-semibold text-slate-800 group-hover:text-slate-900">Tous les domaines</h3>
          <p class="text-sm text-slate-500 mt-1">Recherche globale</p>
        </a>
      </div>

    </div>
  </div>
</div>

<script>
// Simple accessible show/hide for the modal
function openExplore(){
  const el = document.getElementById('overlay');
  el.classList.remove('hidden');
  // focus trap simple approach
  const focusable = el.querySelector('a, button, input');
  if(focusable) focusable.focus();
}
function closeExplore(){
  const el = document.getElementById('overlay');
  el.classList.add('hidden');
}

// Close modal on ESC
document.addEventListener('keydown', function(e){
  if(e.key === 'Escape'){
    const el = document.getElementById('overlay');
    if(!el.classList.contains('hidden')) closeExplore();
  }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\Desktop\2G\le-grenier_du_geek\biblo\resources\views/explore.blade.php ENDPATH**/ ?>