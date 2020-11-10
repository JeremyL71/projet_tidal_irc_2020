<?php
require_once("../inc/init.inc.php");
//--------------------------------- PHP ---------------------------------//
//--- VERIFICATION ADMIN ---//
if(!user_logged_admin())
{
	header("location:../log.php");
	exit();
}

//--- REMOVE PRODUCT ---//
if(isset($_GET['action']) && $_GET['action'] == "remove")
{
	$result = send_request("SELECT * FROM product WHERE id_product=$_GET[id_product]");
	$product_to_remove = $result->fetch_assoc();
	$photo_path_to_delete = $_SERVER['DOCUMENT_ROOT'] . $product_to_remove['photo_path'];
	if(!empty($product_to_remove['photo_path']) && file_exists($photo_path_to_delete))	unlink($photo_path_to_delete);
	$content .= '<div class="validation">Remove product : ' . $_GET['id_product'] . '</div>';
	send_request("DELETE FROM product WHERE id_product=$_GET[id_product]");
	$_GET['action'] = 'Print';
}
//--- SAVE PRODUCT ---//
if(!empty($_POST))
{	// debug($_POST);
	$photo_bdd = ""; 
	if(isset($_GET['action']) && $_GET['action'] == 'change')
	{
		$photo_bdd = $_POST['current_photo'];
	}
	if(!empty($_FILES['photo_path']['name']))
	{	// debug($_FILES);
		$photo_name = $_POST['reference'] . '_' .$_FILES['photo_path']['name'];
		$photo_bdd = RACINE_SITE . "photo/$photo_name";
		$photo_path = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . "/photo/$photo_name";
		copy($_FILES['photo_path']['tmp_name'],$photo_path);
	}
	foreach($_POST as $index => $value)
	{
		$_POST[$index] = htmlEntities(addSlashes($value));
	}
	send_request("REPLACE INTO product (id_product, reference, category, title, description, color, size, public, photo_path, price, stock) values ('$_POST[id_product]', '$_POST[reference]', '$_POST[category]', '$_POST[title]', '$_POST[description]', '$_POST[color]', '$_POST[size]', '$_POST[public]',  '$photo_bdd',  '$_POST[price]',  '$_POST[stock]')");
	$content .= '<div class="validation">The product has been saved</div>';
	$_GET['action'] = 'print';
}

//--- PRODUCT LINK ---//
$content .= '<a href="?action=print">Print product:</a><br />';
$content .= '<a href="?action=add">Add product</a><br /><br /><hr /><br />';

//--- PRINT PRODUCT ---//
if(isset($_GET['action']) && $_GET['action'] == "print")
{
	$result = send_request("SELECT * FROM product");
	
	$content .= '<h2> Products: </h2>';
	$content .= 'Number of product(s) in the store: ' . $result->num_rows;
	$content .= '<table border="1" cellpadding="5"><tr>';
	
	while($column = $result->fetch_field())
	{    
		$content .= '<th>' . $column->name . '</th>';
	}
	$content .= '<th>Modification</th>';
	$content .= '<th>Remove</th>';
	$content .= '</tr>';

	while ($line = $result->fetch_assoc())
	{
		$content .= '<tr>';
		foreach ($line as $index => $information)
		{
			if($index == "photo_path")
			{
				$content .= '<td><img src="' . $information . '" width="70" height="70" /></td>';
			}
			else
			{
				$content .= '<td>' . $information . '</td>';
			}
		}
		$content .= '<td><a href="?action=change&id_product=' . $line['id_product'] .'"><img src="../inc/img/edit.png" /></a></td>';
		$content .= '<td><a href="?action=remove&id_product=' . $line['id_product'] .'" OnClick="return(confirm(\'Are you sure?\'));"><img src="../inc/img/delete.png" /></a></td>';
		$content .= '</tr>';
	}
	$content .= '</table><br /><hr /><br />';
}

//--------------------------------- HTML ---------------------------------//
require_once("../inc/header.inc.php");
echo $content;
if(isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'change'))
{
	if(isset($_GET['id_product']))
	{
		$result = send_request("SELECT * FROM product WHERE id_product=$_GET[id_product]");
		$current_product = $result->fetch_assoc();
	}
	echo '
	<h1> Products Form </h1>
	<form method="post" enctype="multipart/form-data" action="">
	
		<input type="hidden" id="id_product" name="id_product" value="';
	        if(isset($current_product['id_product'])) echo $current_product['id_product']; echo '" />
			
		<label for="reference">Reference</label><br />
		<input type="text" id="reference" name="reference" placeholder="product reference" value="';
	        if(isset($current_product['reference'])) echo $current_product['reference']; echo '" /><br /><br />

		<label for="category">Category</label><br />
		<input type="text" id="category" name="category" placeholder="product category" value="';
	        if(isset($current_product['category'])) echo $current_product['category']; echo '"  /><br /><br />

		<label for="title">Title</label><br />
		<input type="text" id="title" name="title" placeholder="product title" value="';
	        if(isset($current_product['title'])) echo $current_product['title']; echo '"  /> <br /><br />

		<label for="description">Description</label><br />
		<textarea name="description" id="description" placeholder="product description">';
	        if(isset($current_product['description'])) echo $current_product['description']; echo '</textarea><br /><br />
		
		<label for="color">Color</label><br />
		<input type="text" id="color" name="color" placeholder="product color"  value="';
	        if(isset($current_product['color'])) echo $current_product['color']; echo '" /> <br /><br />

		<label for="size">Size</label><br />
		<select name="size">
			<option value="S"';
	            if(isset($current_product) && $current_product['size'] == 'S') echo ' selected '; echo '>S</option>
			<option value="M"';
	            if(isset($current_product) && $current_product['size'] == 'M') echo ' selected '; echo '>M</option>
			<option value="L"';
	            if(isset($current_product) && $current_product['size'] == 'L') echo ' selected '; echo '>L</option>
			<option value="XL"';
	            if(isset($current_product) && $current_product['size'] == 'XL') echo ' selected '; echo '>XL</option>
		</select><br /><br />

		<label for="public">Public</label><br />
		<input type="radio" name="public" value="m"';
	            if(isset($current_product) && $current_product['public'] == 'm') echo ' checked ';
	            elseif(!isset($current_product) && !isset($_POST['public'])) echo 'checked'; echo '/>Man
	            
		<input type="radio" name="public" value="f"';
	            if(isset($current_product) && $current_product['public'] == 'f') echo ' checked '; echo '/>Woman<br /><br />
		
		<label for="photo_path">Photo</label><br />
		<input type="file" id="photo_path" name="photo_path" /><br /><br />';
		if(isset($current_product))
		{
			echo '<i>Upload new photo</i><br />';
			echo '<img src="' . $current_product['photo_path'] . '"  width="90" height="90" /><br />';
			echo '<input type="hidden" name="current_photo" value="' . $current_product['photo_path'] . '" /><br />';
		}
		
		echo '

		<label for="prix">Prix</label><br />
		<input type="text" id="prix" name="prix" placeholder="le prix du produit"  value="';
		    if(isset($current_product['prix'])) echo $current_product['prix']; echo '" /><br /><br />
		
		<label for="stock">Stock</label><br />
		<input type="text" id="stock" name="stock" placeholder="le stock du produit"  value="';
		    if(isset($current_product['stock'])) echo $current_product['stock']; echo '" /><br /><br />
		
		<input type="submit" value="'; echo ucfirst($_GET['action']) . ' of product"/>
	</form>';
}
require_once("../inc/footer.inc.php"); ?>