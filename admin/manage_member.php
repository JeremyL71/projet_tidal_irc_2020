<?php
require_once("../inc/init.inc.php");
if(!user_logged_admin())
{
	header("location:../log.php");
	exit();
}
if(isset($_GET['msg']) && $_GET['msg'] == "supok")
{
	send_request("delete from member where id_member=$_GET[id_member]");
	header("Location:manage_member.php");
}
//-------------------------------------------------- PRINT ---------------------------------------------------------//
require_once("../inc/header.inc.php");

echo '<h1> list of members: </h1>';
	$result = send_request("SELECT * FROM member");
	echo "Number of mebmers : " . $result->num_rows;
	echo "<table style='border-color:red' border=10> <tr>";
	while($column = $result->fetch_field())
	{    
		echo '<th>' . $column->name . '</th>';
	}
	echo '<th> Remove </th>';
	echo "</tr>";
	while ($member = $result->fetch_assoc())
	{
		echo '<tr>';
		foreach ($member as $information)
		{
			echo '<td>' . $information . '</td>';
		}
		echo "<td><a href='manager_member.php?msg=supok&&id_member=" . $member['id_member'] . "' onclick='return(confirm(\"Are you sure to remove this member?\"));'> X </a></td>";
		echo '</tr>';
	}
	echo '</table>';