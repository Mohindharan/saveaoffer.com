
<style>
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
               
                <a  style="font-size:1.2em"href="php/login.php">Login</a>
                 <a  style="font-size:1.2em"href="php/signup.php">Sign Up</a>
        </div>
 </nav>
	
