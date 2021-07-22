# Checkpoint 4 WCS | Twitt'Moji

## Index
1. [Description](#Description)
2. [Prerequisites](#Prerequisites)
3. [Users](#Users)
4. [Installation](#Installation)
5. [Built-With](#Built-With)
6. [Authors](#Authors)

## Description

For the final Checkpoint of my PHP/Symfony training at Wild Code School, we had 48h to develop a Web App based on global Symfony features we learnt.
I did a social network based on the principle of communicating only with emoticons.
If you wanna try out my application, follow instructions bellow.

## Prerequisites

* [PHP 7.4.*](https://www.php.net/releases/7_4_0.php) (check by running php -v in your console)
* [Composer 2.*](https://getcomposer.org/) (check by running composer --version in your console)
* [node 14.*](https://nodejs.org/en/) (check by running node -v in your console)
* [Yarn 1.*](https://yarnpkg.com/) (check by running yarn -v in your console)
* [MySQL 8.0.*](https://www.mysql.com/fr/) (check by running mysql --version in your console)
* [Git 2.*](https://git-scm.com/) (check by running git --version in your console)

## Installation
If you meet the prerequisites, you can proceed to the installation of the project 

1. Clone the project from [Github](https://github.com/WildCodeSchool/orleans-202103-php-project-jobpermut/)
2. Go in the project folder
3. Open with your code editor
4. Run `composer install` to install PHP dependencies
5. Run `yarn install` to install JS dependencies
6. Copy the `.env` file and fill all informations (Database, Symfony/Mailer, Open Route Service, Pole Emploi Variable)
7. Run `symfony console doctrine:database:create` to create database
8. Run `symfony console doctrine:migration:migrate` to create structure of database
9. Run `symfony console doctrine:fixtures:load` to load the fixtures in database
10. Run `yarn encore dev` to build assets
11. Run `symfony server:start` to launch symfony server
12. Go to localhost:8000 on your browser

## Users
**User**
login: user
password: 12345

**Moderator**
login: Modo
password: modo

**Admin**
login: Admin
password: admin

## Built-With

* [Symfony](https://github.com/symfony/symfony)
