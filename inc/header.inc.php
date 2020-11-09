<!Doctype html>
<html>
    <head>
        <title>Black market CPE</title>
        <link rel="stylesheet" href="<?php echo RACINE_SITE; ?>inc/css/style.css" />
        <meta charset="utf-8" />
    </head>
    <body>    
        <header>
			<div class="container">
				<span>
					<a href="" title="Black market CPE">Black market CPE</a>
                </span>
				<nav>
					<?php
					if(user_logged_admin()) // admin
					{ // BackOffice
						echo '<a href="' . RACINE_SITE . 'admin/manage_member.php">Manage members</a>';
						echo '<a href="' . RACINE_SITE . 'admin/manage_order.php">Manage orders</a>';
						echo '<a href="' . RACINE_SITE . 'admin/manage_shop.php">Manage shop</a>';
					}
					if(user_logged()) // member & admin
					{
						echo '<a href="' . RACINE_SITE . 'profile.php">Your profile</a>';
						echo '<a href="' . RACINE_SITE . 'shop.php">Shop</a>';
						echo '<a href="' . RACINE_SITE . 'cart.php">cart</a>';
						echo '<a href="' . RACINE_SITE . 'log.php?action=logout">Log out</a>';
					}
					else // visitor
					{
						echo '<a href="' . RACINE_SITE . 'sign_up.php">Sign up</a>';
						echo '<a href="' . RACINE_SITE . 'log.php">Sign in</a>';
						echo '<a href="' . RACINE_SITE . 'shop.php">Shop</a>';
						echo '<a href="' . RACINE_SITE . 'cart.php">Cart</a>';
					}
					?>
				</nav>
			</div>
        </header>
        <section>
			<div class="container">