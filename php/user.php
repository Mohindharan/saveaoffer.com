<?php
// Initialize any variables that the page might echo
$u = "";

// Make sure the _GET username is set, and sanitize it
if(isset($_GET["u"])){
	$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
} else {
    header("location: http://localhost/project/signup");
    exit();	
}
include_once("db_conx.php");
// Select the member from the users table
$sql = "SELECT * FROM users WHERE username='$u' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
// Now make sure that user exists in the table
$numrows = mysqli_num_rows($user_query);

// Fetch the user row from the query above
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
	$profile_id = $row["id"];
	$gender = $row["gender"];
	$country = $row["country"];
	$userlevel = $row["userlevel"];
	$signup = $row["signup"];
	$phone=$row["phone"];

	if($gender == "f"){
		$sex = "Female";
	}
}
?>
<title><?php echo $u; ?></title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<script src="../js/ajax.js" type="application/javascript"></script>
<link href="../css/user.css"  type="text/css" rel="stylesheet"/>

</head>
<body>
<?php include "nav.php"; ?>

 
 <div class="wrapper">
 </div> 

</body>
</html>