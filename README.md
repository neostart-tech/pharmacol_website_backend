# Pharmacol Website Backend

Application web Laravel pour la gestion du site Pharmacol, une agence specialisee dans la representation pharmaceutique et la promotion medicale au Togo, Benin et Niger.

## Table des matieres

- [Prerequis](#prerequis)
- [Installation](#installation)
- [Configuration](#configuration)
- [Demarrage du projet](#demarrage-du-projet)
- [Fonctionnalites](#fonctionnalites)
- [Architecture multilingue](#architecture-multilingue)
- [Structure du projet](#structure-du-projet)
- [Gestion des utilisateurs](#gestion-des-utilisateurs)
- [Deploiement](#deploiement)

## Prerequis

Avant de commencer, assurez-vous d'avoir installe les outils suivants sur votre machine:

- PHP 8.1 ou superieur
- Composer (gestionnaire de dependances PHP)
- Node.js et npm (pour la compilation des assets)
- MySQL ou MariaDB
- Git

## Installation

### 1. Cloner le depot

```bash
git clone <url-du-depot>
cd repo_projet
```

### 2. Installer les dependances PHP

```bash
composer install
```

### 3. Installer les dependances JavaScript

```bash
npm install
```

### 4. Configuration de l'environnement

Copier le fichier `.env.example` vers `.env`:

```bash
cp .env.example .env
```

Generer la cle d'application Laravel:

```bash
php artisan key:generate
```

### 5. Configuration de la base de donnees

Editer le fichier `.env` et configurer les parametres de connexion a la base de donnees:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pharmacol_db
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

Creer la base de donnees:

```bash
mysql -u root -p
CREATE DATABASE pharmacol_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 6. Executer les migrations

```bash
php artisan migrate
```

### 7. Peupler la base de donnees (optionnel)

Pour charger les donnees de demonstration:

```bash
php artisan db:seed
```

Ou pour executer un seeder specifique:

```bash
php artisan db:seed --class=UtilisateurSeeder
php artisan db:seed --class=PartenaireSeeder
```

## Demarrage du projet

### En developpement

#### 1. Demarrer le serveur Laravel

```bash
php artisan serve
```

Le serveur sera accessible a l'adresse: `http://localhost:8000`

#### 2. Compiler les assets (optionnel)

Pour compiler les assets CSS/JS en mode developpement:

```bash
npm run dev
```

Pour compiler en mode watch (recompilation automatique):

```bash
npm run watch
```

Pour compiler pour la production:

```bash
npm run build
```

#### 3. Acceder a l'application

- Site public: `http://localhost:8000`
- Dashboard admin: `http://localhost:8000/admin/login`

Identifiants par defaut (si les seeders ont ete executes):
- Email: admin@pharmacol.com
- Mot de passe: password

### En production

Pour deployer en production:

1. Configurer le serveur web (Apache/Nginx)
2. Pointer le document root vers le dossier `public/`
3. Configurer les variables d'environnement dans `.env`
4. Executer les optimisations:

```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

## Configuration

### Configuration de la locale par defaut

Dans le fichier `config/app.php`, vous pouvez definir la langue par defaut:

```php
'locale' => 'fr',
'fallback_locale' => 'en',
```

### Configuration du stockage des fichiers

Les fichiers uploads (images, documents) sont stockes dans `storage/app/public`. Pour creer le lien symbolique:

```bash
php artisan storage:link
```

## Fonctionnalites

### Modules principaux

1. **Gestion du blog**: Creation, modification et suppression d'articles
2. **Gestion du recrutement**: Publication et suivi des offres d'emploi
3. **Newsletter**: Gestion des abonnes a la newsletter
4. **Entreprises**: Gestion des entreprises partenaires avec geolocalisation
5. **Utilisateurs**: Gestion des utilisateurs admin (roles: admin/user)
6. **Statistiques**: Gestion des chiffres cles par pays
7. **Partenaires**: Gestion des logos et liens des partenaires

### Acces au dashboard administrateur

Le dashboard est accessible uniquement aux utilisateurs authentifies. Pour creer un nouvel utilisateur admin:

```bash
php artisan tinker
```

Puis executer:

```php
$user = new \App\Models\Utilisateur();
$user->mail = 'votre@email.com';
$user->mot_de_passe = bcrypt('votre_mot_de_passe');
$user->role = 'admin';
$user->save();
```

## Architecture multilingue

### Vue d'ensemble

L'application supporte plusieurs langues (francais et anglais) grace au systeme de localisation de Laravel.

### Implementation

#### 1. Structure des fichiers de traduction

Les fichiers de traduction sont organises dans `resources/lang/`:

```
resources/lang/
├── en/
│   └── messages.php    (Traductions anglaises)
└── fr/
    └── messages.php    (Traductions francaises)
```

Chaque fichier contient un tableau associatif de cles-valeurs:

```php
<?php
return [
    'dashboard' => 'Tableau de bord',
    'blog' => 'Blog',
    'users' => 'Utilisateurs',
    // ...
];
```

#### 2. Middleware SetLocale

Le middleware `App\Http\Middleware\SetLocale` est charge de definir la langue active pour chaque requete:

```php
public function handle(Request $request, Closure $next)
{
    $locale = session('locale', config('app.locale'));
    App::setLocale($locale);
    return $next($request);
}
```

Ce middleware est enregistre dans le groupe `web` du fichier `app/Http/Kernel.php`:

```php
protected $middlewareGroups = [
    'web' => [
        // ...
        \App\Http\Middleware\SetLocale::class,
        // ...
    ],
];
```

#### 3. Controleur LocaleController

Le controleur `App\Http\Controllers\LocaleController` gere le changement de langue:

```php
public function switch($locale)
{
    $allowed = ['fr', 'en'];
    if (!in_array($locale, $allowed)) {
        $locale = config('app.locale');
    }
    session(['locale' => $locale]);
    App::setLocale($locale);
    return redirect()->back();
}
```

#### 4. Route de changement de langue

La route est definie dans `routes/web.php`:

```php
Route::get('/lang/{locale}', [LocaleController::class, 'switch'])->name('lang.switch');
```

#### 5. Utilisation dans les vues Blade

Dans les templates Blade, utilisez la fonction helper `__()`:

```blade
<h1>{{ __('messages.dashboard') }}</h1>
<button>{{ __('messages.save') }}</button>
```

#### 6. Selecteur de langue dans le dashboard admin

Le selecteur de langue est integre dans la barre laterale du dashboard avec deux boutons (FR/EN):

```blade
<a href="{{ route('lang.switch', 'fr') }}" 
   class="{{ app()->getLocale() === 'fr' ? 'active' : '' }}">
    FR
</a>
<a href="{{ route('lang.switch', 'en') }}" 
   class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">
    EN
</a>
```

### Ajouter une nouvelle langue

Pour ajouter une nouvelle langue (exemple: espagnol):

1. Creer le dossier de langue:

```bash
mkdir resources/lang/es
cp resources/lang/fr/messages.php resources/lang/es/messages.php
```

2. Traduire le contenu du fichier `resources/lang/es/messages.php`

3. Ajouter la langue dans la liste autorisee du controleur `LocaleController`:

```php
$allowed = ['fr', 'en', 'es'];
```

4. Ajouter le bouton dans le selecteur de langue du dashboard

### Ajouter une nouvelle traduction

Pour ajouter une nouvelle cle de traduction:

1. Ajouter la cle dans `resources/lang/fr/messages.php`:

```php
'nouvelle_cle' => 'Texte en francais',
```

2. Ajouter la meme cle dans `resources/lang/en/messages.php`:

```php
'nouvelle_cle' => 'Text in English',
```

3. Utiliser dans les vues:

```blade
{{ __('messages.nouvelle_cle') }}
```

### Depannage multilingue

#### Probleme: La langue ne change pas

**Solution:**
1. Verifier que le middleware `SetLocale` est bien enregistre dans `app/Http/Kernel.php`
2. Vider le cache de configuration:

```bash
php artisan config:clear
php artisan cache:clear
```

#### Probleme: Traductions manquantes

**Solution:**
1. Verifier que la cle existe dans les deux fichiers de langue
2. Verifier la syntaxe du tableau PHP (virgules, guillemets)
3. Utiliser une valeur par defaut:

```blade
{{ __('messages.cle', [], 'fr') }}
```

#### Probleme: Langue par defaut incorrecte

**Solution:**
Editer `config/app.php`:

```php
'locale' => 'fr',
'fallback_locale' => 'en',
```

Puis executer:

```bash
php artisan config:cache
```

## Structure du projet

```
repo_projet/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Controleurs de l'application
│   │   ├── Middleware/       # Middleware personnalises
│   │   └── Kernel.php        # Configuration des middleware
│   └── Models/               # Modeles Eloquent
├── config/
│   ├── app.php               # Configuration de l'application
│   ├── database.php          # Configuration de la base de donnees
│   └── ...
├── database/
│   ├── migrations/           # Migrations de base de donnees
│   └── seeders/              # Fichiers de peuplement
├── public/
│   ├── js/                   # Fichiers JavaScript publics
│   ├── images/               # Images publiques
│   └── index.php             # Point d'entree
├── resources/
│   ├── lang/                 # Fichiers de traduction
│   │   ├── en/
│   │   └── fr/
│   ├── views/                # Templates Blade
│   │   ├── admin/            # Vues du dashboard admin
│   │   └── ...
│   ├── css/                  # Fichiers CSS sources
│   └── js/                   # Fichiers JavaScript sources
├── routes/
│   ├── web.php               # Routes web
│   └── api.php               # Routes API
├── storage/
│   ├── app/                  # Fichiers uploads
│   └── logs/                 # Fichiers de logs
├── .env                      # Variables d'environnement
├── composer.json             # Dependances PHP
└── package.json              # Dependances JavaScript
```

## Gestion des utilisateurs

### Roles disponibles

- **admin**: Acces complet a toutes les fonctionnalites
- **user**: Acces limite (pas de gestion des utilisateurs)

### Creation d'un utilisateur via l'interface

Les administrateurs peuvent creer de nouveaux utilisateurs directement depuis le dashboard dans la section "Utilisateurs".

### Modification du role

Le role d'un utilisateur peut etre modifie via un menu deroulant dans le tableau des utilisateurs.

## Deploiement

### Checklist de deploiement

- [ ] Configurer les variables d'environnement `.env`
- [ ] Mettre `APP_DEBUG=false`
- [ ] Mettre `APP_ENV=production`
- [ ] Configurer la base de donnees
- [ ] Executer les migrations
- [ ] Lier le stockage: `php artisan storage:link`
- [ ] Optimiser l'autoloader: `composer install --optimize-autoloader --no-dev`
- [ ] Mettre en cache la configuration: `php artisan config:cache`
- [ ] Mettre en cache les routes: `php artisan route:cache`
- [ ] Compiler les assets: `npm run build`
- [ ] Configurer les permissions des dossiers `storage/` et `bootstrap/cache/`

### Permissions requises

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Support

Pour toute question ou probleme, veuillez contacter l'equipe de developpement.

## Licence

Application proprietaire - Tous droits reserves.
