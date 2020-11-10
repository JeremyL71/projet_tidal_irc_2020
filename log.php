<?php
require_once("inc/init.inc.php");
//--------------------------------- PHP ---------------------------------//
if(isset($_GET['action']) && $_GET['action'] == "logout")
{
	session_destroy(); 
}
if(user_logged())
{
	header("location:profile.php");
}
if($_POST)
{
    $result = send_request("SELECT * FROM member WHERE pseudo='$_POST[pseudo]'");
    if($result->num_rows != 0)
    {
        $member = $result->fetch_assoc();
        if($member['pwd'] == $_POST['pwd'])
        {
            foreach($member as $index => $element)
            {
                if($index != 'pwd')
                {
                    $_SESSION['member'][$index] = $element;
                }
            }
            header("location:profile.php");
        }
        else
        {
            $content .= '<div class="error">Error password</div>';
        }       
    }
    else
    {
        $content .= '<div class="error">Error de pseudo</div>';
    }
}
//--------------------------------- HTML ---------------------------------//
?>
<?php require_once("inc/header.inc.php"); ?>
<?php echo $content; ?>
 
<form method="post" action="">
    <label for="pseudo">Pseudo</label><br />
    <input type="text" id="pseudo" name="pseudo" /><br /> <br />
         
    <label for="pwd">Password</label><br />
    <input type="password" id="pwd" name="pwd" /><br /><br />
 
     <input type="submit" value="Log in"/>
</form>
 
<?php require_once("inc/footer.inc.php"); ?>