# Medmk Portfolio

Portfolio professionnel de Mohamed M’Kirchel, développeur senior spécialisé en automatisation, intégration API, bases de données et applications web métier.

Le site présente une approche orientée problèmes opérationnels, un formulaire de prise de contact et deux démonstrateurs publics utilisant exclusivement des données fictives :

- [DeskOps](https://deskops.mkirchel.com), mini-centre de support client avec rôles, workflow, historique et tableau de bord ;
- [LeadOps](https://leadops.mkirchel.com), pipeline déterministe de traitement de leads B2B fictifs, publié en lecture seule.

## Stack

- PHP 8.3 et Laravel 13 ;
- Blade pour le rendu serveur ;
- Vue 3 limité à la navigation mobile ;
- Tailwind CSS 4 et Vite 8 ;
- PHPUnit, Laravel Pint et contrôles frontend.

## Installation locale

```sh
composer run setup
```

Le script installe les dépendances, prépare l’environnement local, applique les migrations et construit les assets.

Pour lancer le serveur Laravel, la file d’attente et Vite :

```sh
composer run dev
```

## Contrôles

```sh
vendor/bin/pint --test
php artisan test
npm run build
composer audit --locked --no-interaction
npm audit --audit-level=low
```

La CI exécute les validations du dépôt sur chaque pull request vers `main`. Les pages publiques, le formulaire, l’accessibilité structurelle, les métadonnées SEO et les en-têtes de sécurité sont couverts par des tests.

## Confidentialité

Les démonstrations n’utilisent aucune donnée client ou personnelle réelle. Ne jamais versionner `.env`, clé, jeton, identifiant, contenu de formulaire ou information professionnelle confidentielle.
