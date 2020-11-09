<?php
require_once("inc/init.inc.php");
//--------------------------------- PHP ---------------------------------//

//--- ADD CART ---//
if(isset($_POST['add_cart']))
{	// debug($_POST);
	$result = send_request("SELECT * FROM product WHERE id_product='$_POST[id_product]'");
	$product = $result->fetch_assoc();
	add_product_to_cart($product['title'],$_POST['id_product'],$_POST['quantity'],$product['price']);
}

//--- CLEAR CART ---//
if(isset($_GET['action']) && $_GET['action'] == "empty")
{
	unset($_SESSION['cart']);
}

//--- PAYMENT ---//
if(isset($_POST['pay']))
{
	for($i=0 ;$i < count($_SESSION['cart']['id_product']) ; $i++)
	{
		$result = send_request("SELECT * FROM product WHERE id_product=" . $_SESSION['cart']['id_product'][$i]);
		$product = $result->fetch_assoc();
		if($product['stock'] < $_SESSION['cart']['quantity'][$i])
		{
			$content .= '<hr /><div class="error">Remaining stock: ' . $product['stock'] . '</div>';
			$content .= '<div class="error">Quantity requested: ' . $_SESSION['cart']['quantity'][$i] . '</div>';
			if($product['stock'] > 0)
			{
				$content .= '<div class="error">The quantity of the product ' . $_SESSION['cart']['id_product'][$i] . ' was reduced because our stock was insufficient, please check your purchases.</div>';
				$_SESSION['cart']['quantity'][$i] = $product['stock'];
			}
			else
			{
				$content .= '<div class="error">l\'product ' . $_SESSION['cart']['id_product'][$i] . ' has been removed from your cart because we are out of stock, please check your purchases.</div>';
				clear_cart($_SESSION['cart']['id_product'][$i]);
				$i--;
			}
			$error = true;
		}
	}
	if(!isset($error))
	{
		send_request("INSERT INTO orders (id_member, amount, registration_date) VALUES (" . $_SESSION['member']['id_member'] . "," . total_amount() . ", NOW())");
		$id_order = $mysqli->insert_id;
		for($i = 0; $i < count($_SESSION['cart']['id_product']); $i++)
		{
			send_request("INSERT INTO order_detail (id_order, id_product, quantity, price) VALUES ($id_order, " . $_SESSION['cart']['id_product'][$i] . "," . $_SESSION['cart']['quantity'][$i] . "," . $_SESSION['cart']['price'][$i] . ")");
		}
		unset($_SESSION['cart']);
		try {
            mail($_SESSION['member']['email'], "order confirmation", "Thank you for your order. your tracking number is $id_order", "From:Morandet_Laurent_tidal@cpe.fr");
        } catch (Exception $e) {
            echo 'Exception : ', $e->getMessage(), "\n";
        }
        $content .= "<div class='validation'>Thank you for your order. your tracking number is $id_order</div>";
	}
}

//--------------------------------- HTML ---------------------------------//
include("inc/header.inc.php");
echo $content;
echo "<table border='1' style='border-collapse: collapse' cellpadding='7'>";
echo "<tr><td colspan='5'>Cart</td></tr>";
echo "<tr><th>Title</th><th>Product</th><th>Quantity</th><th>Unit price</th><th>Action</th></tr>";

if(empty($_SESSION['cart']['id_product'])) // empty cart
{
	echo "<tr><td colspan='5'>Your cart is empty</td></tr>";
}

else
{
	for($i = 0; $i < count($_SESSION['cart']['id_product']); $i++)
	{
		echo "<tr>";
		echo "<td>" . $_SESSION['cart']['title'][$i] . "</td>";
		echo "<td>" . $_SESSION['cart']['id_product'][$i] . "</td>";
		echo "<td>" . $_SESSION['cart']['quantity'][$i] . "</td>";
		echo "<td>" . $_SESSION['cart']['price'][$i] . "</td>";
		echo "</tr>";
	}
	echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . total_amount() . " euros</td></tr>";
	if(user_logged())
	{
		echo '<form method="post" action="">';
		echo '<tr><td colspan="5"><input type="submit" name="pay" value="Validate and declare the payment" /></td></tr>';
		echo '</form>';
	}
	else
	{
		echo '<tr><td colspan="3">Please  <a href="sign_up.php">sign yp</a> or <a href="log.php"> sign in</a> for pay</td></tr>';
	}
	echo "<tr><td colspan='5'><a href='?action=empty'>Clear my cart</a></td></tr>";
}
echo "</table><br />";
echo "<i>Settlement by bitcoin on the following wallet: da5d4a4s8xa4984xa984xsa984xa4xsa </i><br />";
include("inc/footer.inc.php");