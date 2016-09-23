<?php
header("Content-Type:application/json");
include("conx.php");
if(isset($_GET["searchkey"]))
{
	$key=$_GET["searchkey"];
	$query="select title from product where title LIKE'".$key."%' or productBrand LIKE'".$key."%' limit 5";	
	$result=mysqli_query($con,$query);
	$row=mysqli_fetch_all($result,MYSQLI_ASSOC);
	echo json_encode($row);	
}
?>