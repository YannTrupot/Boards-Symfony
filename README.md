# boards-symfony

Projet réalisé dans le cadre des cours du module Framework Web
Travail effectué: 
    - Ajout / suppression / modification de developers
    - Ajout / suppression / modification de tags
    - Ajout / suppression / modification de tasks
    - Ajout / suppression / modification de steps
    - Ajout / suppression / modification de stories

## Prerequisites

You will need the following things properly installed on your computer.

* [Git](https://git-scm.com/)
* [Composer](https://getcomposer.org/)
* Php 7.1 min

## Installation

* `git clone <repository-url>` this repository
* `cd boards-symfony`
* `composer update`
* edit `.env` file and modify `DATABASE_URL` variable
* Run the database creation script (`dataBase/projects.sql`) on your mariaDb / mysql server

## Running / Development

* `php bin/console server:run`
* Visit your app at [http://127.0.0.1:8000](http://127.0.0.1:8000).
