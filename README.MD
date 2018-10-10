Le projet à été réalisé sur Symfony 4 et PHP 7.\
le fichier .env.dist comporte toutes les variables nécessaires pour se connecter à la base de données.\
Pour tester le projet il faut :
1. Importer tout le projet en local.

2. Copier le fichier .env.dist en le renommant .env .

3. Créer une database du nom de testTechniqueLukas sur MySQL.

4. Dans le dossier test-technique, lancer les commandes:
  - composer install ,
  - php bin/console make:migration ,
  - php bin/console doctrine:migration:migrate ,
  - php bin/console server:start

5. Atteindre la page 127.0.0.1:8000, qui vous dirigera directement vers la page d'accueil.\


Tous les consignes principales ainsi que les consignes bonus ont été réalisées.\
