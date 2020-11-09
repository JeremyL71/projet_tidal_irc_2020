<?php
function send_request($req)
{
	global $mysqli; 
	$result = $mysqli->query($req);
	if (!$result)
	{
		die("Bad SQL request.<br />Message : " . $mysqli->error . "<br />Code: " . $req);
	}
	return $result;
}
//------------------------------------
function debug($var, $mode = 1) 
{
		echo '<div style="background: orange; padding: 5px; float: right; clear: both; ">';
		$trace = debug_backtrace(); 
		$trace = array_shift($trace);
		echo "Debug mode: $trace[file] line: $trace[line].<hr />";
		if($mode === 1)
		{
			echo "<pre>"; print_r($var); echo "</pre>";
		}
		else
		{
			echo "<pre>"; var_dump($var); echo "</pre>";
		}
	echo '</div>';
}
//------------------------------------
function user_logged()
{  
	if(!isset($_SESSION['member']))
	{
		return false;
	}
	else
	{
		return true;
	}
}
//------------------------------------
function user_logged_admin()
{ 
	if(user_logged() && $_SESSION['member']['state'] == 1)
	{
			return true;
	}
	return false;
}

function create_cart()
{
   if (!isset($_SESSION['cart']))
   {
      $_SESSION['cart']=array();
      $_SESSION['cart']['title'] = array();
      $_SESSION['cart']['id_product'] = array();
      $_SESSION['cart']['quantity'] = array();
      $_SESSION['cart']['price'] = array();
   }
}

function add_product_to_cart($title, $id_product, $quantity, $price)
{
	create_cart();
    $product_position = array_search($id_product,  $_SESSION['cart']['id_product']);
    if ($product_position !== false)
    {
         $_SESSION['cart']['quantity'][$product_position] += $quantity ;
    }
    else 
    {
        $_SESSION['cart']['title'][] = $title;
        $_SESSION['cart']['id_product'][] = $id_product;
        $_SESSION['cart']['quantity'][] = $quantity;
		$_SESSION['cart']['price'][] = $price;
    }
}
//------------------------------------
function total_amount()
{
   $total=0;
   for($i = 0; $i < count($_SESSION['cart']['id_product']); $i++)
   {
      $total += $_SESSION['cart']['quantity'][$i] * $_SESSION['cart']['price'][$i];
   }
   return round($total,2);
}

//------------------------------------
function clear_cart($id_product_to_remove)
{
	$product_position = array_search($id_product_to_remove,  $_SESSION['cart']['id_product']);
	if ($product_position !== false)
    {
		array_splice($_SESSION['cart']['title'], $product_position, 1);
		array_splice($_SESSION['cart']['id_product'], $product_position, 1);
		array_splice($_SESSION['cart']['quantity'], $product_position, 1);
		array_splice($_SESSION['cart']['price'], $product_position, 1);
	}
}