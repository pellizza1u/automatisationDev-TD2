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
1) Créer la base de données
`docker compose run --rm db mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS annuaire;"`
