<?php
require_once("inc/init.inc.php");
if(!user_logged())
{
	header("location:log.php");
	exit();
}
if($_POST)
{
	if(!empty($_POST['mdp']))
	{
		send_request("update member SET pwd='$_POST[pwd]', name='$_POST[name]', firstname='$_POST[firstname]', email='$_POST[email]', sex='$_POST[sex]', city='$_POST[city]', postal_code='$_POST[postal_code]', address='$_POST[address]' where id_member='".$_SESSION['user']['id_member']."'");
		unset($_SESSION['user']);
		foreach($member as $index => $element)
		{
			if($index != 'pwd')
			{
				$_SESSION['user'][$index] = $element;
			}
			else
			{
				$_SESSION['user'][$index] = $_POST['pwd'];
			}
		}
		header("Location:members.php?action=change");
	}
	else
	{
		$msg .= "Give the new password";
	}
}
if(isset($_GET['action']) && $_GET['action'] == 'change')
{
	$msg .= "successful modification";
}

require_once("inc/function.inc.php");
echo $msg;
?>
		<h2> Modification of your information </h2>
		<?php
			print "you are connected under the pseudo: " . $_SESSION['user']['pseudo'];
		?><br /><br />
		<form method="post" enctype="multipart/form-data" action="members.php">
		<input
                type="hidden"
                id="id_member"
                name="id_member"
                value="<?php if(isset($_SESSION['user'])) print $_SESSION['user']['id_member']; ?>"
        />
			<label for="pseudo">Pseudo</label>
				<input
                        disabled type="text"
                        id="pseudo" name="pseudo"
                        value="<?php if(isset($_SESSION['user'])) print $_SESSION['user']['pseudo']; ?>"
                />
            <br />
				<input
                        type="hidden"
                        id="pseudo"
                        name="pseudo"
                        value="<?php if(isset($_SESSION['user'])) print $_SESSION['user']['pseudo']; ?>"
                />
			
			<label for="mdp">New password</label>
				<input
                        type="text"
                        id="pwd"
                        name="pwd"
                        value="<?php if(isset($pwd)) print $pwd; ?>"/><br /><br />
			
			<label for="nom">Name</label>
				<input
                        type="text"
                        id="name"
                        name="name"
                        value="<?php if(isset($_SESSION['user'])) print $_SESSION['user']['name']; ?>"
                />
            <br />
			
			<label for="firstname">Firstname</label>
				<input
                        type="text"
                        id="firstname"
                        name="firstname"
                        value="<?php if(isset($_SESSION['user'])) print $_SESSION['user']['firstname']; ?>"
                />
            <br />

			<label for="email">Email</label>
				<input
                        type="text"
                        id="email"
                        name="email"
                        value="<?php if(isset($_SESSION['user'])) print $_SESSION['user']['email']; ?>"
                />
            <br />
			
			<label for="sex">Sex</label>
					<select id="sex" name="sex">
						<option
                                value="m" <?php if(isset($_SESSION['user']['sex']) && $_SESSION['user']['sex'] == "m") print "selected"; ?>>Man</option>
						<option
                                value="f" <?php if(isset($_SESSION['user']['sex']) && $_SESSION['user']['sex'] == "f") print "selected"; ?>>Woman</option>
					</select><br />
					
			<label for="city">City</label>
				<input
                        type="text"
                        id="city"
                        name="city"
                        value="<?php if(isset($_SESSION['user'])) print $_SESSION['user']['city']; ?>"
                />
            <br />
			
		<label for="postal_code">Cp</label>
			<input
                    type="text"
                    id="postal_code"
                    name="postal_code"
                    value="<?php if(isset($_SESSION['user'])) print $_SESSION['user']['postal_code']; ?>"/><br />
			
		<label for="address">Address</label>
					<textarea
                            id="address"
                            name="address"><?php if(isset($_SESSION['user'])) print $_SESSION['user']['address']; ?>
                    </textarea>
					<input
                            type="hidden"
                            name="state"
                            value="<?php if(isset($_SESSION['user'])) print $_SESSION['user']['state']; ?>"
                    />
            <br />
            <br /><br />
			<input type="submit" class="submit" name="modification" value="modification"/>
	</form><br />
</div>