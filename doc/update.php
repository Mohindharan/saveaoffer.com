<?php
$price=$_GET["price"];
$url=$_GET["url"];
$title=$_GET["pname"];
$sql="update products set 'amz_url'=".$url.",'amz_price'=".$price."where title =".$title ;

?>