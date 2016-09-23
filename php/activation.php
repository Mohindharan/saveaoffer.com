<?php

if(isset($_POST["email"])){
	
	
	
	$e = $_POST['email'];
	$p = sha1($_POST['pass']);
	
		include_once("db_conx.php");
		
		$sql = "SELECT * FROM `users` WHERE `emailid`='".$e."' LIMIT 1";
	
        $query = mysqli_query($db_conx,$sql);
        $row = mysqli_fetch_assoc($query);
			
		$db_username = $row["username"];
        $db_pass_str = $row["password"];
		
		if($p != $db_pass_str){
		echo 0;	
          
		} else {
		session_start();
			$_SESSION['username'] = $db_username;
			$_SESSION['password'] = $db_pass_str;
			
	
			echo $db_username;
		    
		}
	}

if(isset($_GET["name"])){
	include_once("db_conx.php");
	$id=$_GET["name"];
	$user=$_GET["user"];
	$com=$_GET["comment"];
	$sql="INSERT INTO `comment`(`pid`,`comment`,`user`) VALUES ('".$id."','".$com."','".$user."')";
	$query = mysqli_query($db_conx,$sql);
	echo'
		<div class="comment-section">
		<img src="images/profile.png" width="50" height="50">
		<div class="user"><h2>'.$user.'</h2></div>
		<div class="comment-Sec">
		'.$com.'
		</div>
	</div>';
}

if(isset($_GET["cooo"])){
	$p=$_GET["cooo"];
	include_once("db_conx.php");
	$sql="SELECT * FROM `comment` where pid=".$p; 
	$query = mysqli_query($db_conx,$sql);
	while($row=mysqli_fetch_array($query))
	{
		echo'
		<div class="comment-section">
		<img src="images/profile.png" width="50" height="50">
		<div class="user"><h2>'.$row["user"].'</h2></div>
		<div class="comment-Sec">
		'.$row["comment"].'
		</div>
	</div>';
	}
}
?>