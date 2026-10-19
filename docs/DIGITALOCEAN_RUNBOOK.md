# Déploiement DigitalOcean du portfolio

Ce runbook publie `Medyour/medmk-portfolio` sur DigitalOcean App Platform et raccorde le domaine principal `mkirchel.com`. La configuration versionnée utilise un seul service PHP de 512 Mio à Londres, sans base de données et sans auto-déploiement.

## Coût et limites retenus

- Service `apps-s-1vcpu-0.5gb` : 5 USD par mois, facturé à la seconde par DigitalOcean.
- Aucune base de données, aucun worker et aucun job planifié.
- Le fournisseur SMTP peut avoir sa propre tarification.
- Le stockage fichier des sessions et du limiteur est éphémère. Sa perte lors d’un redéploiement ne supprime aucune donnée métier : elle invalide seulement les formulaires en cours et remet les compteurs temporaires à zéro.

## Avant de créer l’application

1. Fusionner uniquement une branche dont la CI est verte.
2. Valider la spécification avec `doctl apps spec validate .do/app.yaml --schema-only` dans un contexte sans jeton.
3. Préparer un fournisseur SMTP qui autorise une adresse d’expédition du domaine `mkirchel.com`.
4. Ne placer aucun secret dans Git, dans une capture ou dans un journal partagé.

## Variables à ajouter manuellement

Dans le composant `web`, ajouter les valeurs suivantes avant la première mise en ligne. Utiliser la portée `RUN_TIME` et activer le chiffrement pour les lignes indiquées.

| Variable | Protection | Valeur attendue |
| --- | --- | --- |
| `APP_KEY` | chiffrée | clé Laravel générée localement avec `php artisan key:generate --show` |
| `MAIL_HOST` | générale | hôte SMTP fourni par le prestataire |
| `MAIL_PORT` | générale | port SMTP fourni par le prestataire |
| `MAIL_SCHEME` | générale | schéma recommandé par le prestataire, ou valeur vide si détection automatique |
| `MAIL_USERNAME` | chiffrée | identifiant SMTP |
| `MAIL_PASSWORD` | chiffrée | mot de passe ou jeton SMTP |
| `MAIL_FROM_ADDRESS` | générale | adresse d’expédition validée sur `mkirchel.com` |
| `MAIL_FROM_NAME` | générale | `Mohamed M’Kirchel` |
| `CONTACT_TO_ADDRESS` | chiffrée | adresse qui reçoit les demandes |
| `CONTACT_TO_NAME` | générale | `Mohamed M’Kirchel` |

Ne jamais utiliser l’adresse du visiteur comme expéditeur. L’application l’emploie uniquement comme `Reply-To`.

## Création de l’application

1. Dans App Platform, créer une application depuis le dépôt GitHub `Medyour/medmk-portfolio`, branche `main`.
2. Importer ou reproduire `.do/app.yaml`.
3. Vérifier la région `LON`, le service `web`, une seule instance de 512 Mio et l’auto-déploiement désactivé.
4. Ajouter les variables manuelles ci-dessus, puis lancer le déploiement.
5. Confirmer dans les journaux que les assets Vite sont présents, que les caches Laravel sont construits et que `/health` répond en succès.

## Domaine Cloudflare

La zone reste gérée par Cloudflare. DigitalOcean ne doit donc pas recevoir de champ `zone` dans l’App Spec.

1. Dans les domaines de l’application, relever l’alias `*.ondigitalocean.app` fourni pour `mkirchel.com`.
2. Dans Cloudflare DNS, créer un CNAME à la racine : nom `@`, cible égale à cet alias, mode **DNS only** et TTL automatique.
3. Cloudflare aplatit automatiquement les CNAME placés à la racine de la zone.
4. Attendre que DigitalOcean indique le domaine `Active` et que son certificat soit émis. La propagation peut prendre jusqu’à 72 heures.
5. Ne configurer `www.mkirchel.com` que dans une modification séparée, avec une redirection permanente explicite vers le domaine racine.

## Recette après activation

- `https://mkirchel.com` s’affiche sans avertissement TLS.
- `https://mkirchel.com/health` répond en HTTP 200.
- Les pages `/confidentialite` et `/mentions-legales` répondent en HTTP 200.
- `robots.txt` autorise l’indexation et référence le sitemap HTTPS.
- `sitemap.xml` contient uniquement des URL `https://mkirchel.com`.
- Un envoi réel du formulaire arrive au destinataire, avec l’adresse du visiteur en `Reply-To`.
- Six envois rapides depuis la même adresse déclenchent la limitation sans exposer de détail technique.
- L’URL de départ DigitalOcean renvoie un 301 vers `https://mkirchel.com` en conservant le chemin et la requête.

Après plusieurs jours de fonctionnement HTTPS stable, HSTS peut être étudié séparément. Ne pas l’activer pendant la première mise en ligne.

## Repli

1. Dans App Platform, sélectionner le dernier déploiement sain et utiliser le rollback.
2. Si le domaine est en cause, retirer temporairement le CNAME Cloudflare ou restaurer son ancienne valeur connue ; ne pas détruire l’application pendant le diagnostic.
3. Si le courrier est en cause, corriger uniquement les variables SMTP chiffrées puis redéployer. Les erreurs restent génériques côté visiteur et détaillées uniquement dans les journaux.
4. La destruction définitive de l’application et la suppression DNS sont deux opérations séparées. Vérifier leur cible exacte et conserver une copie de l’App Spec avant toute suppression.
