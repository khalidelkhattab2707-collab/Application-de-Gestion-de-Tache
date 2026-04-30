# Gestion de Tâches

Une application web de gestion de tâches développée avec Laravel, permettant aux utilisateurs de créer, organiser et suivre leurs tâches personnelles.

## Fonctionnalités

- **Authentification des utilisateurs** : Inscription, connexion et gestion des comptes
- **Gestion des tâches** :
  - Création, modification et suppression de tâches
  - Statuts : À faire, En cours, Terminée
  - Dates d'échéance
  - Descriptions détaillées
- **Organisation par catégories** : Classement des tâches par catégories personnalisables
- **Tableau de bord** : Vue d'ensemble des tâches avec statistiques
- **Interface responsive** : Design moderne avec Tailwind CSS

## Technologies utilisées

- **Backend** : Laravel 11
- **Base de données** : MySQL (via migrations Eloquent)
- **Frontend** : Blade templates, Tailwind CSS
- **Build tool** : Vite
- **Authentification** : Laravel Breeze
- **Debugging** : Laravel Debugbar, Telescope

## Installation

### Prérequis

- PHP 8.1 ou supérieur
- Composer
- Node.js et npm
- MySQL ou autre base de données supportée par Laravel

### Étapes d'installation

1. **Cloner le repository**
   ```bash
   git clone <url-du-repo>
   cd Gestion_tache
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Installer les dépendances JavaScript**
   ```bash
   npm install
   ```

4. **Configuration de l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Modifier le fichier `.env` avec vos paramètres de base de données.

5. **Migrations et seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Construire les assets**
   ```bash
   npm run build
   # ou pour le développement
   npm run dev
   ```

7. **Démarrer le serveur**
   ```bash
   php artisan serve
   ```

L'application sera accessible sur `http://localhost:8000`

## Utilisation

### Comptes utilisateur

- **Administrateur** : Peut gérer tous les utilisateurs et catégories
- **Utilisateur standard** : Peut gérer ses propres tâches

### Fonctionnalités principales

1. **Inscription/Connexion** : Créer un compte ou se connecter
2. **Tableau de bord** : Vue d'ensemble des tâches et statistiques
3. **Gestion des tâches** :
   - Lister toutes les tâches
   - Filtrer par statut
   - Créer une nouvelle tâche
   - Modifier une tâche existante
   - Supprimer une tâche
4. **Gestion des catégories** : Créer et gérer les catégories de tâches

## Structure du projet

```
app/
├── Http/Controllers/          # Contrôleurs
├── Models/                    # Modèles Eloquent
├── Policies/                  # Politiques d'autorisation
└── Providers/                 # Fournisseurs de services

database/
├── migrations/                # Migrations de base de données
└── seeders/                   # Seeders pour données de test

resources/
├── views/                     # Templates Blade
└── css/                       # Styles CSS

routes/
└── web.php                    # Routes de l'application
```

## Tests

```bash
php artisan test
```

## Déploiement

1. Configurer le serveur web (Apache/Nginx) pour pointer vers `public/`
2. Configurer les variables d'environnement en production
3. Optimiser l'application :
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   npm run build
   ```

## Contribution

1. Fork le projet
2. Créer une branche pour votre fonctionnalité (`git checkout -b feature/nouvelle-fonctionnalite`)
3. Commit vos changements (`git commit -am 'Ajout de nouvelle fonctionnalité'`)
4. Push vers la branche (`git push origin feature/nouvelle-fonctionnalite`)
5. Créer une Pull Request

## Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## Support

Pour toute question ou problème, veuillez créer une issue sur GitHub.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
