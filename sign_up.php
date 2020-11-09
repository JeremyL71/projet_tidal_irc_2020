<?php
require_once("inc/init.inc.php");
if($_POST)
{
	debug($_POST);
	$check_char = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']);
	if(!$check_char || strlen($_POST['pseudo']) < 1 || strlen($_POST['pseudo']) > 20 )
	{
		$content .= "<div class='error'>The nickname must contain between 1 and 20 characters. <br> Accepted character: Letter from A to Z and number from 0 to 9</div>";
	}
	if(empty($content))
	{
		$member = send_request("SELECT * FROM member WHERE pseudo='$_POST[pseudo]'");
		if($member->num_rows > 0)
		{
			$content .= "<div class='error'>Nickname unavailable. Please choose another one.</div>";
		}
		else
		{
			foreach($_POST as $index => $value)
			{
				$_POST[$index] = htmlEntities(addSlashes($value));
			}
			send_request("INSERT INTO member (pseudo, pwd, name, firstname, email, civility, city, postal_code, address) VALUES ('$_POST[pseudo]', '$_POST[pwd]', '$_POST[name]', '$_POST[firstname]', '$_POST[email]', '$_POST[civility]', '$_POST[city]', '$_POST[postal_code]', '$_POST[address]')");
			$content .= "><u>Log in</u></a></div>";
		}
	}
}
?>
<?php require_once("inc/header.inc.php"); ?>
<?php echo $content; ?>

<form method="post" action="">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="your pseudo" pattern="[a-zA-Z0-9-_.]{1,20}" title="accepted characters: a-zA-Z0-9-_." required="required"><br><br>
         
    <label for="pwd">Password</label><br>
    <input type="password" id="mdp" name="pwd" required="required"><br><br>
         
    <label for="name">Name</label><br>
    <input type="text" id="name" name="name" placeholder="your name"><br><br>
         
    <label for="firstname">Firstname</label><br>
    <input type="text" id="firstname" name="firstname" placeholder="your firstname"><br><br>
 
    <label for="email">Email</label><br>
    <input type="email" id="email" name="email" placeholder="example@gmail.com"><br><br>
         
    <label for="civility">Civility</label><br>
    <input name="civility" value="m" checked="" type="radio">Man
    <input name="civility" value="f" type="radio">Woman<br><br>
                 
    <label for="city">City</label><br>
    <input type="text" id="city" name="city" placeholder="your city" pattern="[a-zA-Z0-9-_.]{5,15}" title="accepted characters: a-zA-Z0-9-_."><br><br>
         
    <label for="postal_code">Postal code</label><br>
    <input type="text" id="postal_code" name="postal_code" placeholder="code postal_code" pattern="[0-9]{5}" title="5 digits required: 0-9"><br><br>
         
    <label for="address">Address</label><br>
    <textarea id="address" name="address" placeholder="your address" pattern="[a-zA-Z0-9-_.]{5,15}" title="accepted characters: a-zA-Z0-9-_."></textarea><br><br>
 
    <input name="Sing up" value="sign up" type="submit">
</form>
 
<?php require_once("inc/footer.inc.php"); ?>