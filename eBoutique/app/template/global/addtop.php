<?php
// Starting session
session_start();

// To create match between PHP.ini and those files
date_default_timezone_set('Europe/Paris');


// Loading configs (NOT USE)
//require('../app/template/config/config.php');

//Loading Class
// Database static class
require '../app/class/Database.php';
// Custom exceptions
require '../app/class/CustomException.php';
//Interfaces
require '../app/class/CrudInterface.php';
//Traits
require '../app/class/TraitVerification.php';
//Abstract class
require '../app/class/Personne.php';
//Other Class
require '../app/class/Client.php';
require '../app/class/Employee.php';
require '../app/class/User.php';
require '../app/class/Article.php';

//Loading Database
$bdd = Database::getBdd();