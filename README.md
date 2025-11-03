# le-grenier_du_geek

📘Description du projet

Le Grenier du Geek est une plateforme communautaire open source qui combine :

Un espace de partage de ressources et de livres techniques

Un forum de discussion collaboratif(inovation)

Un chatbot intelligent pour assister les utilisateurs(inovation)
on a egalement une section bon plan qui donne tout ce qui est  nouveaute
Ce projet est développé avec Laravel 12, TailwindCSS, et une architecture modulaire orientée vers la communauté.


⚙️ Fonctionnalités principales

✅ Gestion complète des livres : ajout, affichage, exploration
✅ Forum de discussion avec catégories et fils de discussion
✅ Authentification utilisateur (inscription, connexion, profil)
✅ Interface administrateur pour gérer les catégories
✅ Chatbot intégré pour répondre aux questions techniques
✅ Interface moderne, responsive et ergonomique

🏗️ Technologies utilisées
Catégorie	        Outils
Framework Backend	Laravel 12
Frontend	        Blade / TailwindCSS
Base de données 	MySQL / MariaDB
Authentification	Laravel Breeze
Chatbot	            API interne Laravel
Forum	            Package riari/laravel-forum
Serveur	            PHP 8.4, Composer 2.x


Prérequis

Avant de démarrer, assurez-vous d’avoir installé :

PHP ≥ 8.2

Composer

MySQL 

Node.js & npm

Git (optionnel)

Installation
1. Cloner le dépôt :
     ```bash
     git clone <URL_DU_DEPOT>
     cd le-grenier_du_geek
     ```
2. Installer les dépendances PHP :
     ```bash
     composer install
     ```
3. Installer les dépendances front (si présentes) :
     ```bash
     npm install
     ```
4. Copier le .env et générer la clé :
     ```bash
     cp .env.example .env
     php artisan key:generate
     ```
5. Configurer .env (connexion DB, services externes, APP_URL, etc.)

Base de données
- Lancer les migrations et, si besoin, les seeders :
    ```bash
    php artisan migrate
    php artisan db:seed   # optionnel
    ```

Exécution en développement
- Lancer le serveur intégré :
    ```bash
    php artisan serve
    ```
- Compiler les assets en mode dev :
    ```bash
    npm run dev
    ```

Mode production
- Compiler les assets optimisés :
    ```bash
    npm run prod
    ```
- Optimiser Laravel :
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```


une fois lance le server acceder a http://localhost:8000/books sans cree un compte utilisateur
maitenant pour aceder a toute les fonctionalite tel que le dashbord le forum le chat   il faut cree un compte a  http://localhost:8000/login




