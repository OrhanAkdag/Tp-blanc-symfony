# Tp-blanc-symfony
- git clone https://github.com/OrhanAkdag/Tp-blanc-symfony/
- cd Tp-blanc-symfony
- composer update
- configuer le ficher .env pour la base de donnée
- php bin/console make:migration
- php bin/console doctrine:migrations:migrate
- php bin/console doctrine:fixtures:load
- symfony server:start
