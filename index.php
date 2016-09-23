
<?php
	
if(empty($_GET["view"]))
{
	
	$view="all"	;

}
else{
	if(empty($_GET["p"])){
		$p=1;
	}
	else
	$p=$_GET["p"];
	
	$view=$_GET["view"];
}

require_once("doc/conx.php");
	

include("doc/top-navigation.php"); 
?>
<div style="padding-top:30px;">
<?php include_once("doc/conx.php");

if($view=="all"){
$query="select * from product where  flip_price>0 limit 24";}
else
$query="select * from product where flip_price>0  and title LIKE'%".$view."%'limit 24";	

$result = mysqli_query($con,$query);

echo'
<div class="row">
';
echo'
</div>
<div class="col-md-12 container">
<div class="row">
';	
$i=0;
	while($row=mysqli_fetch_array($result))
	{		$title=substr($row["title"],0,25);
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
	
?>	
</div>	
</div>
</div>     
      <div class="pager">
     
                </div>
 <script>

$(document).ready(function(){
	
$(window).scroll(function(){
$height=$(document).height() - $(window).height()-10;
	console.log($(window).scrollTop(),$height);
if ($(window).scrollTop() >=$height ){	
		console.log("functioncalled");
	getdata();
	}	
	});
});	
var view= '<?php
if(empty($_GET["view"]))
{
	
	echo "all"	;

}
else	
echo $_GET["view"];
?>';
function getdata()
{	
$page=$(".container");	
var key= $(".item:last").attr("data-val");	
	$.ajax({
		url:"doc/load.php",
		method:"post",
		data:{key:key,
			  view:view
			 },
        error: function (xhr, status) {
            alert(status);
        },
		success:function(data)
		{
					$(".loading").hide();
					$(".container").append(data).delay( 800 );
			
		}
	});
}
</script>
<?php include_once("doc/buttom.php");?>