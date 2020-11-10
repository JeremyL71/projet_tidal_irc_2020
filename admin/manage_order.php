<?php
require_once("../inc/init.inc.php");
if(!user_logged_admin())
{
	header("location:../log.php");
	exit();
}
//-------------------------------------------------- Printed ---------------------------------------------------------//
require_once("../inc/header.inc.php");
	echo '<h1> Here are the orders placed on the site </h1>';
	echo '<table border="1"><tr>';
	
	$order_details = send_request("select o.*, m.pseudo, m.address, m.city, m.postal_code from orders o left join member m on  m.id_member = o.id_member");
	echo "Number of order : " . $order_details->num_rows;
	echo "<table style='border-color:#ff0000' border=10> <tr>";
	while($column = $order_details->fetch_field())
	{
		echo '<th>' . $column->name . '</th>';
	}
	echo "</tr>";
	$turnover = 0;
	while ($orders = $order_details->fetch_assoc())
	{
		$turnover += $orders['amount'];
		echo '<div>';
		echo '<tr>';
		echo '<td><a href="manage_order.php?follow=' . $orders['id_order'] . '">look order ' . $orders['id_order'] . '</a></td>';
		echo '<td>' . $orders['id_member'] . '</td>';
		echo '<td>' . $orders['amount'] . '</td>';
		echo '<td>' . $orders['registration_date'] . '</td>';
		echo '<td>' . $orders['state'] . '</td>';
		echo '<td>' . $orders['pseudo'] . '</td>';
		echo '<td>' . $orders['address'] . '</td>';
		echo '<td>' . $orders['city'] . '</td>';
		echo '<td>' . $orders['postal_code'] . '</td>';
		echo '</tr>	';
		echo '</div>';
	}
	echo '</table><br />';
	echo 'Calculation of the total amount of income:  <br />';
		print "the turnover of the company is: $turnover €";
	
	echo '<br />';
	if(isset($_GET['follow']))
	{	
		echo '<h1> Product details: </h1>';
		echo '<table border="1">';
		echo '<tr>';
		$data_about_one_order = send_request("select * from order_detail where id_order=$_GET[follow]");
		
		$nb_column = $data_about_one_order->field_count;
		echo "<table style='border-color:red' border=10> <tr>";
		for ($i=0; $i < $nb_column; $i++)
		{    
			$column = $data_about_one_order->fetch_field();
			echo '<th>' . $column->name . '</th>';
		}
		echo "</tr>";

		while ($order_detail = $data_about_one_order->fetch_assoc())
		{
			echo '<tr>';
				echo '<td>' . $order_detail['id_order_detail'] . '</td>';
				echo '<td>' . $order_detail['id_order'] . '</td>';
				echo '<td>' . $order_detail['quantity'] . '</td>';
				echo '<td>' . $order_detail['price'] . '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}