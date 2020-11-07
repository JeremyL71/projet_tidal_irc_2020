<?php
//--------- BDD
$mysqli = new mysqli("localhost", "morandet", "gTWfEKkCVP+8", "TIDAL_bdd");
if ($mysqli->connect_error) die('Un probl�me est survenu lors de la tentative de connexion � la BDD : ' . $mysqli->connect_error);
// $mysqli->set_charset("utf8");
 
//--------- SESSION
session_start();

//--------- CHEMIN
define("RACINE_SITE","/");
 
//--------- VARIABLES
$contenu = '';
 
//--------- AUTRES INCLUSIONS
require_once("fonction.inc.php");