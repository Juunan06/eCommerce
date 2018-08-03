<?php
session_start();
// Session file delete
unlink('../app/template/config/sessions/'.$_SESSION['log']['file']);
// Insert a new line in log file
$file = '../app/logs/connection.txt';
$newLine = "\nDeconnexion : ".$_SESSION['user']['CONNECT']." - ".$_SESSION['user']['ID']." ".$_SESSION['user']['MAIL']." Statut : Leaving";
file_put_contents($file, $newLine, FILE_APPEND | LOCK_EX);
// Destroy section
session_destroy();
//Redirect to index.php
header('Location: index.php');