<?php
//--------- BDD PROD --------- //
//$mysqli = new mysqli("localhost", "morandet", "gTWfEKkCVP+8", "TIDAL_bdd");

//--------- BDD DEV --------- //
$mysqli = new mysqli("localhost", "root", "", "TIDAL_BDD");
if ($mysqli->connect_error) die('Error during BDD connection : ' . $mysqli->connect_error);
// $mysqli->set_charset("utf8");
 
//--------- SESSION
session_start();

//--------- PATH
define("RACINE_SITE","/");
 
//--------- VARIABLES
$content = '';
 
//--------- OTHERS INCLUSIONS
require_once("function.inc.php");