<link rel="stylesheet" href="css/load.css">
<?php

if(empty($_GET["pid"]))
{
	header("location:index.php?p=1");

}
else{
	$p=$_GET["pid"];	
}

include_once("doc/conx.php");
$query ="select * from product where product_id=".$p;
$result=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($result);
$title=$row["title"];
$img=explode(";",$row["imgurl"]);
$brand=$row["productBrand"];
$category=$row["categories"];
$price=$row["flip_price"];
$flipkart=$row["flip_url"];
include("doc/top-navigation.php");
?>
<link rel="stylesheet" href="css/product.css">

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="plugin/elevateZoom.js"></script>
<script>
var key =<?php echo $p; ?>; 	
</script>
<script src="js/product.js"></script>
<div class="container">

<div class=" pid">

	<img id="img" src="<?php echo $img[0] ?>" data-zoom-image="<?php echo $img[0] ?>" width="400" height="300">
		<h4><?php echo $title;?></h4>
</div>

<div class="pro">
	<ul>
		<h1 id="product_title"><?php echo $title; ?> </h1>
		
		
	</ul>
	<ul class="row" style="margin-bottom:40px;">
		<li class="col-md-4">
			<img src="images/flipkart.png" width="200"height="70" alt=""><br>
			<?php echo "Rs ".$price;?>
			<a class="alink" href="<?php echo $flipkart;?>">
			
			<div class="btn btn-primary">Buy</div></a>
		</li>
		<li class="col-md-4">
			<img src="images/amazon.png" width="120"height="70" alt="">
			<div class="amzp">
				
			</div>
		</li>
		<li class="col-md-4">
		
		</li>
	</ul> 
		
	</div>
<div class="productspecs">	
 <div class="loading">
 	
  <div class="finger finger-1">
    <div class="finger-item">
      <span></span><i></i>
    </div>
  </div>
  			<div class="finger finger-2">
    <div class="finger-item">
      <span></span><i></i>
    </div>
  </div>
  			<div class="finger finger-3">
    <div class="finger-item">
      <span></span><i></i>
    </div>
  </div>
  			<div class="finger finger-4">
    <div class="finger-item">
      <span></span><i></i>
    </div>
  </div>
  			<div class="last-finger">
    <div class="last-finger-item"><i></i></div>
  </div>
  <h4>Loading.......</h4>
		</div>
</div>

<div class="comment">
<form  onsubmit="return false;">
		<input type="text" id="idname" value="<?php echo $_GET["pid"]; ?>">
		<div class="form-group">	
		<label for="user_name">enter a name:</label>
		<input name="user_name" class="form-control" type="text" id="user_name">
		</div>
		<div class="form-group">	
		<label for="comment">Comment:</label>
		<textarea name="comment" class="form-control" rows="5" id="comment"></textarea>
		</div>
	<button class="btn btn-primary" onclick="com();" >Submit</button>	
	</form>
</div>
<div class="comment-container">
	<h3>previous comments</h3>
</div>
<?php	
include("doc/buttom.php");
?>
</div>

</div>

