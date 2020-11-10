<?php
require_once("inc/init.inc.php");
//---------------------------------  PHP ---------------------------------//
//--- PRINT CATEGORY ---//
$product_category = send_request("SELECT DISTINCT category FROM product");
$content .= '<div class="left-shop">';
$content .= "<ul>";
while($cat = $product_category->fetch_assoc())
{
	$content .= "<li><a href='?category="	. $cat['category'] . "'>" . $cat['category'] . "</a></li>";
}
$content .= "</ul>";
$content .= "</div>";
//--- PRINT PRODUCT ---//
$content .= '<div class="right-shop">';
if(isset($_GET['category']))
{
	$data = send_request("SELECT id_product, reference, title, photo_path, price FROM product WHERE category='$_GET[category]'");
	while($product = $data->fetch_assoc())
	{
		$content .= '<div class="product-shop">';
		$content .= "<h3>$product[title]</h3>";
		$content .= "<a href=\"product_detail.php?id_product=$product[id_product]\"><img src=photo/$product[photo_path] width=\"130\" height=\"100\" /></a>";
		$content .= "<p>$product[price] €</p>";
		$content .= '<a href="product_detail.php?id_product=' . $product['id_product'] . '">See more</a>';
		$content .= '</div>';
	}
}
$content .= '</div>';
//--------------------------------- HTML ---------------------------------//
require_once("inc/header.inc.php");
echo $content;
require_once("inc/footer.inc.php");