<?php
include("conx.php");
if(isset($_POST["key"]))
{
	$key=$_POST["key"];
	$view=$_POST["view"];
	
	if($view=="all"){
		$query="select * from product where product_id>".$key." and flip_price >0 limit 12";}
	else
	$query="select * from product where flip_price>0  and title LIKE'%".$view."%' and product_id>".$key."limit 12 ";
	
		$result=mysqli_query($con,$query);
	if($result){
	echo'
		<div class="row">
';	
$i=0;
	
	while($row=mysqli_fetch_array($result))
	{
		
		$title=substr($row["title"],0,25);
	 		if($row["imgurl"]==null){
				$img="images/frameback.jpg";
			}
	 	
	 		else
				{
					$imgs=explode(";",$row["imgurl"]); 
				$img='"'.$imgs[1].'"';
			}
	 		
			if($i==4){
				echo '</div><div class="row">';
				$i=0;
			
			}
			echo '
				<div class="col-md-3 pd">
						<div class="item" data-val='.$row["product_id"].'>

							<img src='.$img.' height="100" width="100">
							<h4>'.$title.'</h4>
								<div class="price"> Rs '.$row["flip_price"].'
								</div>
							<a href=product.php?pid='.$row["product_id"].'><div class="button btn-primary btn">Buy now</div></a>
						</div>
				</div>
				';
			$i++;	
		}
	
}
}
?>