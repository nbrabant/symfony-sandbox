# symfony-sandbox
Sandbox for Symfony 4 project

## Commands
Run server : php bin/console server:run

Debug routes : php bin/console debug:router

Make something : php bin/console make

Make controller : php bin/console make:controller BlogController

Make some CRUD : php bin/console make:crud Blog

Database entity creation process :
* Make entity and repository : php bin/console make:entity Blog
* Make a new migration : php bin/console make:migration
* Run migrations : php bin/console doctrine:migrations:migrate
* php bin/console make:entity --regenerate for manual properties add

## Doctrine ORM
