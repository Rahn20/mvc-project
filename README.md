# MVC project

[![Build Status](https://scrutinizer-ci.com/g/Rahn20/mvc-project/badges/build.png?b=main)](https://scrutinizer-ci.com/g/Rahn20/mvc-project/build-status/main)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Rahn20/mvc-project/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/Rahn20/mvc-project/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/Rahn20/mvc-project/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/Rahn20/mvc-project/?branch=main)
[![CircleCI](https://circleci.com/gh/Rahn20/mvc-project/tree/main.svg?style=svg)](https://circleci.com/gh/Rahn20/mvc-project/tree/main)


![page](/doc/page.png)


This is a [laravel](https://laravel.com/) project that I chose to work with in the MVC course in Web Programming at [Blekinge institute of technology](https://bth.se/). This application project is about two dice games (Yatzy and Game 21).

The rules for **Game 21** are that you can choose either 1 or 2 dice to roll and try to reach 21 points, if the player gets 21 points the player wins, if the player gets more than 21 points he loses. The player can choose when he wants to stop and then it will be the computer's turn. The computer makes its throws, if both the player and computer get the same score for example 20 then the computer gets the win. If the computer gets more than 21 points then the player wins regardless of the player's points as long as the points are not higher than 20. The result will be saved in the database and displayed on the Highscore and histogram page. For **Yatzy** rules you can find them on [wikipedia](https://en.wikipedia.org/wiki/Yatzy), the result for yazty will be saved in the database and displayed in the Highscore and histogram page.


## Setup and installation

Work tools you will need are [XAMPP](https://www.apachefriends.org/index.html) to run locally and a terminal (I run on [Cygwin](https://www.cygwin.com/)). You need **PHP** installed on your machine and included in your path, **Composer**, **Xdebug**, **git** and **MySQL** also need to be installed. Then you can start cloning this repository and creating/changing your MySQL environment variables by running:

```
git clone https://github.com/Rahn20/mvc-project.git
touch .env
cp .env.testing .env
```

Create a new database or use an existing one, you can change DB_DATABASE, DB_USERNAME and DB_PASSWORD in your .env. Run these commands to start using the application:

```
make install

php artisan key:generate
php artisan migrate
php artisan serve
```

Go to http://127.0.0.1:8000 and the application should work without any problems, if you get any problem with the database that it could not do 'SELECT' or similar, you can always double check that you have created the database, you have the correct MySQL config in the .env file, you have run migrate and be sure to configure a database connection in your application's ```config/database.php``` configuration file. You can run the application locally by starting your XAMPP post 80 and going to localhost...../public.


## Working with tests

Laravel is built with testing in mind. In fact, support for testing with PHPUnit is included out of the box and a phpunit.xml. **Tests directory** contains two directories: Feature and Unit. You can specify whether you want to create test classes in Unit or in Feature.

```
php artisan make:test UserTest --unit
php artisan make:test HttpTest --feature
```

**Unit** tests are tests that focus on a very small, isolated portion of your code. It can not access your application's database or other framework services. The tests that are placed in unit are for the classes that are in the model catalog.
**Feature** tests test a larger portion of your code, including how several objects interact with each other or even a full HTTP request to a JSON endpoint. The tests that are placed in Feature are for the classes that I have in Controller catalog. You can run one of these commands, all 3 give the same result.

```
vendor/bin/phpunit
php artisan test
make phpunit
```

If you want to run a single test class or just the tests in Unit or Feature you can run:

```
# for Unit
php artisan test --testsuite=Unit

# for Feauture
php artisan test --testsuite=Feature

# for a single test class
php artisan test --filter GameControllerTest
```

If you want to include phpcs, phpcpd, phpmd, phpstan, composer validate together with PHPUNIT test then you can run ``` make test ```. If you get any problem with the key generator, you can always run:

```
php artisan config:cache
php artisan key:generate
```

### Review the code coverage

The code coverage report is generated when you run your Unittest. It is a report saved in the generated directory build/coverage that provides a HTML view of the classes, methods and lines of code tested. You can see your coverage report by opening your browser to build/coverage/index.html.


## Working with database

Laravel includes Eloquent, an object-relational mapper (ORM) that makes it enjoyable to interact with your database. If you want to create an Eloquent model and generate a database migration when you generate the model, you may use:

```
php artisan make:model Dice --migration
```

If you would like to connect to your database's CLI, you may use php artisan db and to specify a database connection name php artisan db mysql.


## Useful commands

The commands that are used quite a lot when working with Laravel.

### Generate a model/controller/migration/test

```
php artisan make:model model-name
php artisan make:controller controller-name
php artisan make:migration migration-name
php artisan make:test test-name
```

- Controllers path: app/Http/Controllers/
- Model path: app/Models/
- Migration path: database/migrations/
- test path: tests/

### Clear cache

```
php artisan view:clear
php artisan route:clear
php artisan cache:clear
php artisan config:cache
```

### Other useful commands

```
php artisan route:list
```

_________________________________________________________________________________________

```
    Copyright (c) 2022  Ranim Hanna  
```