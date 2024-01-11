# Annuaire d'entreprise

Ce projet est un petit annuaire d'entreprise.  
Il permet de lister plusieurs entreprise, et d'en voir leur bureau et employées.

## Technologies utilisées
- PHP 8.2
- MariaDB 10
- Slim 4
- Eloquent 10

## Préréquis pour une installation local
- Docker
- Docker compose
- Git

## Installation local
1) Cloner le projet

1) Copier le fichier .env.example en .env, et l'alimenter 
`cp .env.example .env`

1) Installer les dépendances  
`docker compose run --rm php composer install`

1) Lancer le container  
`docker compose up`

## (re)Créer et alimenter la base de données
Il faut que le container database soit lancé pour effectuer ces commandes.
 
**Supprimer et re-créer la base de données**  
`dexec php php bin/console.php db:create`   

**Alimenter la base de données**  
`dexec php php bin/console.php db:populate`   

