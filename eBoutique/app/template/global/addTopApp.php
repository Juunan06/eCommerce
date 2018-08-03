<?php
// Starting session
session_start();

// To create match between PHP.ini and those files
date_default_timezone_set('Europe/Paris');


// Loading configs (NOT USE)
//require('../app/template/config/config.php');

//Loading Class
// Database static class
require '../../class/Database.php';
// Custom exceptions
require '../../class/CustomException.php';
//Interfaces
require '../../class/CrudInterface.php';
//Traits
require '../../class/TraitVerification.php';
//Abstract class
require '../../class/Personne.php';
//Other Class
require '../../class/Client.php';
require '../../class/Employee.php';
require '../../class/User.php';
require '../../class/Article.php';

//Loading Database
$bdd = Database::getBdd();