# Medmk Portfolio — Arborescence et UX du MVP

Date de décision : 8 août 2026  
Statut : recommandation UX de référence pour la future tâche locale de développement  
Périmètre : structure, contenu, conversion, responsive et accessibilité — aucun code

## 0. Amendement — projets publics validés

Date de décision : 18 octobre 2026

DeskOps et LeadOps sont désormais fonctionnels, déployés et validés sur leurs domaines publics. Les règles antérieures qui imposaient leur absence sont donc remplacées par les décisions suivantes :

- ajouter une section `Projets publics` entre `Approche` et `À propos` ;
- ajouter `Projets` dans les navigations desktop, mobile et de pied de page ;
- présenter uniquement DeskOps et LeadOps, avec leurs fonctionnalités effectivement démontrées et leurs liens publics ;
- préciser que les deux applications utilisent des données fictives ;
- conserver Medmk Portfolio hors de ses propres réalisations ;
- conserver hors publication tout projet, client, témoignage ou résultat professionnel qui n’a pas reçu de validation individuelle.

Cet amendement remplace les interdictions visant spécifiquement DeskOps, LeadOps et toute section de projets dans les sections 2, 3, 5, 9, 14 et 15 ci-dessous. Le reste de la recommandation UX demeure applicable.

## 1. Décision UX centrale

Le MVP doit être une vitrine professionnelle courte, principalement en une page, conçue pour faire comprendre en quelques secondes trois résultats métier :

1. automatiser les processus ;
2. connecter les systèmes ;
3. fiabiliser les données.

La page ne doit pas chercher à prouver la crédibilité par un catalogue de projets encore non publiables. Elle doit la construire par un positionnement précis, une méthode claire, l'expérience réelle de Mohamed M’Kirchel et un parcours de contact crédible.

CTA principal unique : **« Étudier mon besoin »**.  
CTA secondaire autorisé : **« Découvrir mon approche »**.

## 2. Arborescence MVP

### Pages publiques

- `/` — Accueil, page principale de conversion.
- `/confidentialite` — Politique de confidentialité, notamment traitement des données du formulaire.
- `/mentions-legales` — Mentions légales.

Ne pas créer au MVP de pages séparées Services, Réalisations, Blog ou À propos. Ces contenus restent dans l'accueil tant qu'un volume réel ne justifie pas leur séparation.

### Éléments explicitement absents du MVP

- aucune section ou page « Réalisations » tant qu'une réalisation réelle n'a pas reçu sa validation individuelle de publication ;
- Medmk Portfolio n'est pas présenté comme sa propre réalisation ;
- LeadOps n'est ni affiché ni annoncé avant d'être fonctionnel ;
- aucun témoignage, client, logo, résultat chiffré ou certification non vérifié ;
- aucune promesse de disponibilité détaillée.

## 3. Navigation principale

Ordre desktop :

1. identité « Mohamed M’Kirchel » ;
2. lien `Expertises` → section des trois axes ;
3. lien `Approche` → méthode ;
4. lien `À propos` → crédibilité et profil ;
5. bouton principal `Étudier mon besoin` → formulaire.

Sur mobile : identité toujours visible, bouton de menu accessible, mêmes trois liens, puis CTA principal. Le header reste compact. Le CTA ne doit pas être dupliqué en permanence dans une barre flottante.

## 4. Parcours de conversion

Le parcours cible est volontairement linéaire :

**Comprendre → se reconnaître → comprendre l'intervention → vérifier la crédibilité → prendre contact.**

- Le Hero répond à « qu'est-ce que Mohamed peut améliorer pour mon entreprise ? ».
- Les trois axes permettent au visiteur d'identifier son problème.
- L'Approche réduit le risque perçu en montrant une démarche structurée.
- À propos apporte la preuve de compétence disponible aujourd'hui : plus de 10 ans d'expérience et compétences techniques réelles.
- Le formulaire transforme l'intérêt en demande qualifiée avec le minimum de friction.

Le CTA principal mène toujours au même formulaire. Le CTA secondaire ne crée aucune route : il descend vers `Approche`.

## 5. Ordre précis des sections de l'accueil

1. **Header** — identité, navigation, CTA.
2. **Hero** — proposition de valeur et deux CTA maximum.
3. **Trois axes / Expertises** — Automatiser, Connecter, Fiabiliser.
4. **Approche** — démarche simple de compréhension, conception, mise en œuvre et vérification.
5. **À propos / Repères de confiance** — profil senior, plus de 10 ans d'expérience, domaines et technologies utiles.
6. **Contact / Qualification** — formulaire sous le titre d'action « Étudier mon besoin ».
7. **Footer** — identité, navigation utile, Confidentialité, Mentions légales.

Il n'y a pas de section « Réalisations » dans cette première publication. Elle sera insérée ultérieurement entre `Approche` et `À propos` dès qu'au moins une étude de cas réelle sera validée individuellement.

## 6. Wireframe textuel — mobile

### Écran 1

`Header compact`  
Mohamed M’Kirchel + bouton Menu

`Hero`  
Repère métier court  
Titre : **« J'automatise vos processus, connecte vos systèmes et fiabilise vos données. »**  
Sous-texte : rôle public validé, reformulé en une à deux phrases maximum  
Bouton principal : **Étudier mon besoin**  
Lien secondaire : **Découvrir mon approche**

### Suite verticale

`Expertises`  
Carte 1 — Automatiser les processus  
Carte 2 — Connecter les systèmes  
Carte 3 — Fiabiliser les données

`Approche`  
4 étapes courtes, empilées, avec une phrase maximum par étape.

`À propos`  
Mohamed M’Kirchel  
Développeur senior  
Plus de 10 ans d'expérience  
Résumé court + technologies sélectionnées  
« Chaque collaboration est étudiée au cas par cas »

`Contact`  
Titre : Étudier mon besoin  
Phrase de réassurance  
Champs du formulaire  
Consentement + lien Confidentialité  
Bouton Étudier mon besoin

`Footer`  
Identité + Confidentialité + Mentions légales

## 7. Wireframe textuel — ordinateur

`Header sur une ligne`  
Identité à gauche | Expertises · Approche · À propos | Étudier mon besoin à droite

`Hero en deux zones visuelles, sans illustration décorative obligatoire`  
Zone principale large : repère métier, titre, sous-texte, CTA principal et secondaire  
Zone complémentaire : trois mots/repères métier — Automatiser · Connecter · Fiabiliser — sans chiffres ni faux logos

`Expertises en 3 colonnes`  
Automatiser | Connecter | Fiabiliser

`Approche`  
Introduction courte + 4 étapes lisibles horizontalement si l'espace le permet

`À propos / Repères de confiance en 2 colonnes`  
Profil et expérience | domaines techniques réellement maîtrisés

`Contact en 2 colonnes`  
Promesse et réassurance à gauche | formulaire à droite

`Footer`  
Identité à gauche | liens légaux à droite

## 8. Composants nécessaires

- Header / navigation responsive.
- Hero.
- Bloc `ExpertiseCard`, réutilisé trois fois.
- Section Approche et item d'étape réutilisable.
- Section À propos / Repères de confiance.
- Formulaire de qualification.
- Messages de validation, succès et erreur du formulaire.
- Footer.
- Conteneur/section standard pour conserver une grille, des espacements et une largeur cohérents.

Aucun carrousel, slider, animation complexe, compteur, pop-up ou composant de portfolio n'est nécessaire au MVP.

## 9. Répartition des contenus déjà validés

| Contenu disponible | Destination MVP | Traitement |
|---|---|---|
| Nom public « Mohamed M’Kirchel » | Header, À propos, Footer | Conserver tel quel |
| « Développeur senior spécialisé en automatisation, intégration API, bases de données et applications web métier » | Hero / À propos | Version courte dans le Hero, version complète dans À propos |
| « plus de 10 ans d'expérience » | À propos / repère de confiance | Afficher une seule fois |
| Automatisation, API/webhooks, bases de données, reporting, applications web métier | Expertises + À propos | Regrouper sous les trois résultats métier, éviter une longue liste |
| PHP, Laravel, Vue.js, SQL Server et technologies validées | À propos | Liste courte ; pas de mur de badges |
| Langues publiques déjà validées | À propos | Une ligne secondaire, sans surcharger le Hero |
| Textes longs de présentation, offres et preuves préparés | Réserve éditoriale | Ne pas tout afficher ; réutiliser plus tard pour SEO, études de cas ou pages dédiées |
| Réalisations professionnelles en cours de sélection/validation | Non publiées | Masquer jusqu'à validation individuelle |
| LeadOps | Non publié | Attendre une version fonctionnelle et montrable |

## 10. Informations à raccourcir, déplacer ou masquer

### Raccourcir

- Le résumé professionnel du Hero : une promesse principale + une courte phrase explicative.
- Les descriptions d'expertise : problème/résultat en 2 à 3 lignes par axe.
- La méthode : quatre étapes, sans détail technique exhaustif.

### Déplacer

- Les technologies vers À propos, après la valeur métier.
- Les détails techniques, méthodes longues et exemples futurs vers la réserve éditoriale ou de futures études de cas.
- Les textes réglementaires vers les deux pages légales.

### Masquer au MVP

- détails sur l'employeur et ses clients ;
- noms, identifiants, URLs, captures ou données professionnelles confidentielles ;
- toute réalisation non autorisée individuellement ;
- LeadOps ;
- Medmk Portfolio comme projet ;
- disponibilité détaillée. La seule formulation publique est : **« Chaque collaboration est étudiée au cas par cas »**.

## 11. Formulaire et états UX

### Champs recommandés

1. Nom — requis.
2. E-mail — requis.
3. Organisation — facultatif.
4. Besoin — requis : Automatiser un processus / Connecter des systèmes / Fiabiliser des données / Autre besoin.
5. Message — requis.
6. Consentement à l'utilisation des données pour répondre à la demande — requis, avec lien vers Confidentialité.

Bouton : **Étudier mon besoin**.

### États à prévoir

- **Initial** : champs vides, aide courte, aucun message d'erreur.
- **Saisie / focus** : focus très visible au clavier, libellé toujours présent.
- **Erreur de validation** : message précis associé au champ ; données valides conservées ; résumé d'erreur si plusieurs erreurs.
- **Envoi en cours** : bouton désactivé et état explicite « Envoi… » ; éviter le double envoi.
- **Succès** : confirmation claire dans la page, focus déplacé vers le message ; ne pas promettre un délai de réponse non validé.
- **Erreur serveur/réseau** : message général compréhensible, saisie conservée, nouvelle tentative possible.
- **Abus / limitation de débit / antispam** : message neutre sans exposer la logique de protection.

## 12. Accessibilité et responsive design

- HTML sémantique : un seul `h1`, niveaux de titres cohérents, `header`, `nav`, `main`, `section`, `footer`.
- Navigation entièrement utilisable au clavier ; ordre de tabulation identique à l'ordre visuel.
- Focus visible sur chaque contrôle interactif.
- Menu mobile avec nom accessible, état ouvert/fermé communiqué et fermeture prévisible.
- Chaque champ possède un vrai libellé ; le placeholder ne remplace jamais le libellé.
- Erreurs annoncées aux technologies d'assistance et reliées aux champs concernés.
- Contrastes visant WCAG 2.2 AA ; l'information ne dépend jamais de la couleur seule.
- Zones tactiles confortables, sans liens trop rapprochés.
- Aucun contenu essentiel uniquement au survol.
- Respect de `prefers-reduced-motion` si une transition légère est utilisée.
- Mobile-first : une colonne par défaut ; trois colonnes d'expertises seulement lorsque la largeur le permet réellement.
- Longueurs de ligne limitées sur desktop et largeur du formulaire plafonnée pour préserver la lisibilité.
- Aucun débordement horizontal à 320 px et aux largeurs usuelles.

## 13. Direction visuelle

Direction recommandée : **sobre, technique, fiable, humaine**.

- Fond principal très clair, surfaces blanches ou légèrement teintées.
- Texte anthracite/bleu nuit à fort contraste.
- Une seule couleur d'accent froide et maîtrisée pour CTA, focus et petits repères.
- Typographie sans-serif moderne, excellente lisibilité, hiérarchie nette.
- Grands espaces, bordures fines, rayons modérés, ombres rares.
- Icônes simples uniquement lorsqu'elles accélèrent la compréhension ; ne pas décorer chaque ligne.
- Pas de codes visuels « IA futuriste », néons, gradients agressifs, illustrations génériques de robots ou faux dashboards.
- Animations limitées à des transitions discrètes et non nécessaires à la compréhension.

La crédibilité doit venir de la clarté du discours et de la précision de l'interface, pas d'effets visuels.

## 14. Critères d'acceptation UX

Le MVP UX est accepté si tous les points suivants sont vrais :

1. En arrivant sur la page, un visiteur comprend sans scroller que Mohamed intervient sur automatisation, intégration de systèmes et fiabilité des données.
2. Le seul CTA principal visible et répété est exactement « Étudier mon besoin » et toutes ses occurrences conduisent au formulaire.
3. « Découvrir mon approche », lorsqu'il est présent, conduit uniquement à la section Approche et reste visuellement secondaire.
4. L'ordre des sections correspond exactement à la décision du présent document.
5. Aucun projet, client, témoignage, logo, résultat chiffré ou certification non validé n'est affiché.
6. Medmk Portfolio n'est pas présenté comme réalisation et LeadOps est absent.
7. Aucune réalisation professionnelle n'apparaît sans validation individuelle explicite.
8. La disponibilité est formulée uniquement : « Chaque collaboration est étudiée au cas par cas ».
9. Les technologies restent secondaires par rapport aux résultats métier.
10. Le formulaire couvre les trois besoins principaux, conserve la saisie en cas d'erreur récupérable et possède les états initial, validation, envoi, succès, erreur et protection anti-abus.
11. Les pages Confidentialité et Mentions légales sont accessibles depuis le footer ; le consentement du formulaire renvoie vers Confidentialité.
12. La navigation et le formulaire sont utilisables au clavier, les focus sont visibles, les libellés/erreurs sont accessibles et les contrastes visent WCAG 2.2 AA.
13. Le rendu reste lisible sans débordement horizontal de 320 px au desktop large, avec adaptation de la grille plutôt qu'une réduction excessive du texte.
14. Aucun carrousel, pop-up, animation lourde ou dépendance UX non nécessaire n'est introduit.

## 15. Transmission à la future tâche locale de développement

### Objectif

Implémenter le MVP public de Medmk Portfolio conformément à cette structure, sans élargir le périmètre fonctionnel.

### Référence fonctionnelle à respecter

- Architecture : accueil one-page + Confidentialité + Mentions légales.
- Message principal : automatiser les processus, connecter les systèmes, fiabiliser les données.
- CTA principal unique : « Étudier mon besoin ».
- CTA secondaire autorisé : « Découvrir mon approche ».
- Sections : Header → Hero → Expertises → Approche → À propos/Repères de confiance → Contact → Footer.
- Aucun bloc Réalisations au lancement tant qu'aucun cas n'est individuellement validé.

### Avant toute modification locale

1. Inspecter la structure Laravel existante, les conventions Blade/Vue/Tailwind, les tests et `AGENTS.md`.
2. Vérifier le contenu déjà présent et conserver ce qui respecte cette spécification.
3. Identifier les éventuels écarts de stack ou de structure avant d'ajouter une dépendance ; aucune dépendance n'est attendue pour cette UX.
4. Ne jamais lire, afficher ou versionner de secret ou donnée professionnelle confidentielle.

### Implémentation attendue

- Blade assure la structure rendue serveur et le contenu SEO essentiel.
- Vue 3 est réservé aux interactions qui en ont réellement besoin ; ne pas transformer le site en SPA.
- Tailwind suit une approche mobile-first et un petit système visuel cohérent.
- Le formulaire est validé côté serveur, protégé contre les abus, accessible et testé sur tous les états définis.
- Les contenus longs restent hors interface visible tant qu'ils n'améliorent pas directement compréhension ou conversion.

### Définition de terminé pour cette future tâche

- critères UX ci-dessus respectés ;
- tests Laravel et tests frontend concernés au vert ;
- build Vite de production réussi ;
- vérification visuelle réelle au minimum en mobile 390 px et desktop 1440 px, complétée par un contrôle de non-débordement à 320 px ;
- navigation clavier, focus, messages d'erreur et contrastes vérifiés ;
- aucune donnée sensible suivie par Git ;
- aucun déploiement ou publication sans autorisation explicite.

Ce document est la référence UX du MVP jusqu'à décision ultérieure explicite.
