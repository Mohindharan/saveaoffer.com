<?php
session_start();

if(isset($_SESSION['username'])){
	$log=1;	
}
else{
	$log=0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SaveAOffer-save with a click|Your money need not be spent </title>
		<link rel="stylesheet" href="css/loader.css">
	<link rel="stylesheet" href="css/filter.css">
	<link rel="stylesheet" href="css/navigation.css">
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
		<script src="bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>


	
</head>
<body>

<nav id="navv" >
	<div  class="row">
		<div class="logo">
			<a href="index.php"><img src="images/logo.jpg"></a>
		</div>
		
		<div class="search-box">
		<form action="index.php" id="search-box" method="get" >
 <input list="keyword" id="skeyword"  name="view" placeholder="Search here to save..." autocomplete="off" >
 <datalist id="keyword">
 
 </datalist>
		<input type="image" src="images/search.png" class="search-ico" >
		</form>
		</div>
		<ui class="proit">
		<ul class="in">
		<?php
		if($log)
			echo'<li class="li"><a href="php/logout.php">Logout</a></li>';
		else
echo'<li class="li"><a href="php/login.php">Login</a></li>';
	
		?>
		</ul>
		</ui>
		<style>
.in{
display:none ;
margin-top: 50px;
width:100px;
position: absolute;
list-style: none;
margin-left: 0;
padding-left: 0;
background-color: white;
}
.li{
postion:absolute;
width:100px;
background-color:#CCC;
color:#000;
line-height: normal;
text-align: center;
list-style:none;
}
.proit:hover .in{		
	display:block;
}
.li {
  width: 100px;
  height: 30px;
  margin-left: 0;
  padding-top: 10px; }

.li>a {
  text-decoration: none;
  font-family: sans-serif;
  font-size: 1.0em;
	line-height:1.0em;
  color: black;
  margin-left: 0;
  padding-left: 0; 
}
		</style>
	</div>
</nav>


<div class="cssload-container">
	<div class="cssload-item cssload-moon"></div>
</div>

