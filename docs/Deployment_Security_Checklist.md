# Finalisation avec le futur domaine et l’hébergement

Ce document recense uniquement les décisions qui ne peuvent pas être finalisées dans le dépôt local. Il ne sélectionne aucun hébergeur.

## Domaine et indexation

- Configurer `APP_URL` avec l’URL HTTPS publique définitive afin que les URL canoniques, Open Graph et le sitemap utilisent le bon domaine.
- Conserver `APP_ENV=production` uniquement sur l’environnement réellement public. Hors production, `robots.txt` interdit toute indexation.
- Déclarer le sitemap public auprès des moteurs de recherche seulement après validation du domaine.
- Ajouter une image de partage uniquement lorsqu’un visuel officiel aura été validé. Le site ne publie actuellement aucune fausse image sociale.

## Sécurité de transport

- Terminer la redirection HTTP vers HTTPS au niveau de l’hébergement ou du proxy.
- N’activer HSTS qu’après avoir vérifié que le domaine et les éventuels sous-domaines fonctionnent durablement en HTTPS. Son activation prématurée peut rendre un domaine inaccessible.
- Configurer correctement les proxys de confiance Laravel si l’hébergement termine TLS en amont de l’application.

## Politique de sécurité du contenu

Le dépôt n’impose pas encore de CSP afin de ne pas casser Vite ni le développement local. Avant publication, établir une politique à partir des ressources réellement servies, tester d’abord `Content-Security-Policy-Report-Only`, puis appliquer une CSP sans autoriser inutilement les scripts en ligne ou des domaines externes.

## Informations légales et exploitation

- Compléter les mentions relatives à l’hébergeur avant la mise en ligne.
- Configurer l’adresse d’expédition et le destinataire du formulaire avec des valeurs validées, sans versionner de secret.
- Vérifier les sauvegardes, les journaux, la rotation des fichiers et la supervision propres à l’infrastructure retenue.
