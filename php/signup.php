<?php
session_start();
// If user is logged in, header them away
if(isset($_SESSION["username"])){
	header("location: message.php?msg=NO to that weenis");
    exit();
}
?><?php
// Ajax calls this NAME CHECK code to execute
if(isset($_POST["usernamecheck"])){
	include_once("db_conx.php");
	$username = preg_replace('#[^a-z0-9]#i', '', $_POST['usernamecheck']);
	$sql = "SELECT id FROM users WHERE username='$username' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
    $uname_check = mysqli_num_rows($query);
    if (strlen($username) < 3 || strlen($username) > 16) {
	    echo '<strong style="color:#F00;">3 - 16 characters please</strong>';
	    exit();
    }
	if (is_numeric($username[0])) {
	    echo '<strong style="color:#F00;">Usernames must begin with a letter</strong>';
	    exit();
    }
    if ($uname_check < 1) {
	    echo '<strong style="color:#009900;">' . $username . ' is OK</strong>';
	    exit();
    } else {
	    echo '<strong style="color:#F00;">' . $username . ' is taken</strong>';
	    exit();
    }
}
?><?php
// Ajax calls this REGISTRATION code to execute
if(isset($_POST["name"])){
	// CONNECT TO THE DATABASE
	include_once("db_conx.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES
	$u =  $_POST['name'];
	$e = $_POST['user_email'];
	$p = $_POST['user_password1'];
	$g =  $_POST['gender'];
	$a = $_POST['age'];
	$ph = $_POST['phone'];
	$sql = "SELECT id FROM users WHERE username='$u' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
	$u_check = mysqli_num_rows($query);
		echo $u.$e.$p.$g.$a.$ph;
		$p_hash = sha1($p);


		// Add user info into the database table for the main site table
$sql = "INSERT INTO users (`username`, `emailid`, `password`, `gender`, `age`, `phone`)VALUES('".$u."','".$e."','".$p_hash."','".$g."',".$a.",".$ph.")";
		$query = mysqli_query($db_conx, $sql); 
		$uid = mysqli_insert_id($db_conx);
		header("location: login.php");
	// Establish their row in the useroptions table
		
	
	
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<link rel="stylesheet" href="../css/signin.css">
<link rel="stylesheet" href="../css/normalize.css">

<script src="../js/ajax.js"></script>
<script>
function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	} else if(elem == "username"){
		rx = /[^a-z0-9]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
function emptyElement(x){
	_(x).innerHTML = "";
}
function checkusername(){
	var u = _("username").value;
	if(u != ""){
		_("unamestatus").innerHTML = 'checking ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("unamestatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("usernamecheck="+u);
	}
}
function signup(){
	var u = _("username").value;
	var e = _("email").value;
	var p1 = _("pass1").value;
	var p2 = _("pass2").value;
	var a= _("age").value;
	var ph= _("phone").value;
	var g = _("gender").value;

	var aj;
	if(u == "" || e == "" || p1 == "" || p2 == "" || g == ""||ph==""){
		status.innerHTML = "Fill out all of the form data";
	} else if(p1 != p2){
		status.innerHTML = "Your password fields do not match";
	} else {
		_("signupbtn").style.display = "none";
		status.innerHTML = 'please wait ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax)==true) {
	            if(ajax.responseText =="signup_success"){aj=1;}
				else{aj=0;}
			    if(aj){
					status.innerHTML = ajax.responseText;
					_("signupbtn").style.display = "block";
							
			
				} else {
					window.scrollTo(0,0);
					_("signupform").innerHTML = "OK "+u+",  you successfully activated your account.";
				}
	        }
        }
        ajax.send("u="+u+"&e="+e+"&p="+p1+"&g="+g+"&a="+a+"&ph="+ph);
	}
}

/* function addEvents(){
	_("elemID").addEventListener("click", func, false);
}
window.onload = addEvents; */
</script>
</head>
<body>
<style>
*{
	margin:0;
	padding:0;
	}
.nav{
	width:100%;
	height:50px;
	background-color:#D13AFF;
	position:fixed;
	top:0;
	box-shadow:0 0 10px #888;
	z-index:1000;
	
	}
.nav>.log{
	margin-top:15px;
	width:300px;
	height:30px;
	position:absolute;
	right:10px;
	}	
	
.nav>.log>a{
	text-decoration:none;
	color:#FFF;
	font-size:1.2em;
	font-family:Arial, Helvetica, sans-serif;
	margin:20px;
	padding:10px;
	border-radius:5px;
	transition:all .5s ease;
	
	}		
	.nav>.log>a:hover{
		background-color:darkorange;
		box-shadow:2px 4px 8px #000;
border-radius:8px;		
	}

</style>

 <nav class="nav">
        <div class="log">
               
                <a  style="font-size:1.2em"href="login.php">Login</a>
                 <a  style="font-size:1.2em"href="#">Sign Up</a>
        </div>
 </nav>

  <h3>Sign Up Here</h3>
 
  <form name="signupform" id="signupform" method="post" action="signup.php">
  <legend>Your Profile info</legend>
   <label for="name">Userame:</label>
   <input id="username" type="text" name="name" onblur="checkusername()" onkeyup="restrict('username')" maxlength="16" />
    <span id="unamestatus"></span>
    
      <label for="mail">Email:</label>
      <input type="email" id="email" name="user_email"  required="required" onfocus="emptyElement('status')"  id="email" type="text" onfocus="emptyElement('status')" onkeyup="restrict('email')" maxlength="88"/>


<label for="password">Password:</label>
          <input type="password" id="pass1" name="user_password1" required="required" onfocus="emptyElement('status')" maxlength="16" />
  
    
     <label for="cpassword">Comfirm Password:</label>
          <input type="password" id="pass2" name="user_password2" required="required" onfocus="emptyElement('status')" maxlength="16">
          	<label for="age">Age:</label>
    		<input type="number" id="age" name="age" required="required" min="12" />
            	<label for="phone">Phone:</label>
    		<input type="tel" id="phone" name="phone" required="required" />
            
            
     <label>Gender:</label>
    <select id="gender" name="gender" onfocus="emptyElement('status')">
      <option value=""></option>
      <option value="male">Male</option>
      <option value="<female></female>">Female</option>
    </select>

  
    <div>
   
    </div>
   
    
    <br /><br />
    <button id="signupbtn" >Create Account</button>
    <span id="status"></span>
    
  </form>
</div>

</body>
</html>