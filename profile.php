<?php
require_once("inc/init.inc.php");
//--------------------------------- PHP ---------------------------------//
if(!user_logged())
{
	header("location:log.php");
}
$content .= '<p class="center">Hello <strong>' . $_SESSION['member']['pseudo'] . '</strong></p>';
$content .= '<div class="cadre"><h2> Here is your profile information: </h2>';
$content .= '<p> Email: ' . $_SESSION['member']['email'] . '<br>';
$content .= 'City: ' . $_SESSION['member']['city'] . '<br>';
$content .= 'CP: ' . $_SESSION['member']['postal_code'] . '<br>';
$content .= 'Address: ' . $_SESSION['member']['address'] . '</p></div><br /><br />';
	
//--------------------------------- HTML ---------------------------------//
require_once("inc/header.inc.php");
echo $content;
require_once("inc/footer.inc.php");