# Finalisation avec le futur domaine et l’hébergement

Ce document recense les derniers contrôles à effectuer autour de la configuration DigitalOcean versionnée dans `.do/app.yaml`.

## Domaine et indexation

- Vérifier que `APP_URL`, injectée dynamiquement par App Platform, vaut bien `https://mkirchel.com` une fois le domaine principal actif.
- Conserver `APP_ENV=production` uniquement sur l’environnement réellement public. Hors production, `robots.txt` interdit toute indexation.
- Déclarer le sitemap public auprès des moteurs de recherche seulement après validation du domaine.
- Ajouter une image de partage uniquement lorsqu’un visuel officiel aura été validé. Le site ne publie actuellement aucune fausse image sociale.

## Sécurité de transport

- Terminer la redirection HTTP vers HTTPS au niveau de l’hébergement ou du proxy.
- N’activer HSTS qu’après avoir vérifié que le domaine et les éventuels sous-domaines fonctionnent durablement en HTTPS. Son activation prématurée peut rendre un domaine inaccessible.
- Vérifier que DigitalOcean transmet correctement le schéma HTTPS et l’adresse cliente aux proxys de confiance Laravel.

## Politique de sécurité du contenu

Le dépôt n’impose pas encore de CSP afin de ne pas casser Vite ni le développement local. Avant publication, établir une politique à partir des ressources réellement servies, tester d’abord `Content-Security-Policy-Report-Only`, puis appliquer une CSP sans autoriser inutilement les scripts en ligne ou des domaines externes.

## Informations légales et exploitation

- Vérifier les mentions relatives à DigitalOcean avant la mise en ligne.
- Configurer le transport SMTP, l’adresse d’expédition et le destinataire du formulaire avec des valeurs validées et chiffrées dans DigitalOcean, sans versionner de secret.
- Vérifier les sauvegardes, les journaux, la rotation des fichiers et la supervision propres à l’infrastructure retenue.

La procédure détaillée, les tests de recette et le repli sont décrits dans `docs/DIGITALOCEAN_RUNBOOK.md`.
