<?php
require_once("inc/init.inc.php");
//--------------------------------- PHP ---------------------------------//

if(isset($_GET['id_product'])) 	{ $result = send_request("SELECT * FROM product WHERE id_product = '$_GET[id_product]'"); }
if($result->num_rows <= 0) { header("location:shop.php"); exit(); }

$product = $result->fetch_assoc();
$content .= "<h3>Title : $product[title]</h3><hr /><br />";
$content .= "<p>Category: $product[category]</p>";
$content .= "<p>Color: $product[color]</p>";
$content .= "<p>Size: $product[size]</p>";
$content .= "<img src='photo/$product[photo_path]' width='150' height='150' />";
$content .= "<p><i>Description: $product[description]</i></p><br />";
$content .= "<p>Price : $product[price] �</p><br />";

if($product['stock'] > 0)
{
	$content .= "<i>Number of products available : $product[stock] </i><br /><br />";
	$content .= '<form method="post" action="cart.php">';
		$content .= "<input type='hidden' name='id_product' value='$product[id_product]' />";
		$content .= '<label for="quantity">Quantity: </label>';
		$content .= '<select id="quantity" name="quantity">';
			for($i = 1; $i <= $product['stock'] && $i <= 5; $i++)
			{
				$content .= "<option>$i</option>";
			}
		$content .= '</select>';
		$content .= '<input type="submit" name="add_cart" value="add to cart" />';
	$content .= '</form>';
}
else
{
	$content .= 'Sold out !';
}
$content .= "<br /><a href='shop.php?category=" . $product['category'] . "'>Back to the selection of " . $product['category'] . "</a>";

//--------------------------------- HTML ---------------------------------//
require_once("inc/header.inc.php");
echo $content;
require_once("inc/footer.inc.php");