<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>hello</title>
</head>
<body>
	<?php
	$percent=0;
	$failed=0;
	$done=0;
	$succes=0;
	echo $percent."% done <br>";
	echo "failed=".$failed."<br>";
	echo "sucess=".$succes."<br>";
	$not_ava=0;
	include_once "../doc/conx.php";
	$query="select * from products";
	set_time_limit(0);
	$result = mysqli_query($con,$query);
	$num_rows = mysqli_num_rows($result);
	while($row =mysqli_fetch_array($result))
	{	
		
		preg_match_all("/[a-zA-z0-9\>].*>([a-zA-z0-9 ]{3,256})/",$row["categories"],$cat);		
		$plus=$row["title"]." ".$row["productBrand"]." ".$cat[1][0];
		$plus=str_replace(" ","+",$plus);
		$url="http://www.amazon.in/s/ref=nb_sb_ss_i_3_4?url=search-alias%3Daps&field-keywords=".$plus;
		$output=file_get_contents($url);
		
		preg_match("/(?:<a class\=\"a\-link-normal s\-access\-detail\-page  a\-text\-normal\" .*? href)=(?:\'|\"|)(?:.*?)([a-zA-Z0-9-:\/.=_?&]	{3,500})/",$output,$amatches);
		$reg=preg_match_all("/<span class\=\"currencyINR\">&nbsp;&nbsp;<.*?span>([0-9\.,]{5,256})<.*?span>/",$output,$matches);
		$mat=$matches[0];
		print_r($amatches[1]);
		$urll=$amatches[1];
		echo $urll."<br>";
		$mat=$matches[0][0 ];
		if(empty($mat[0])){
			$not_ava++;

			$stock=0;
			$price=0;
		}
		else{

			echo $mat[0]; 
			$stock=1;
			$price=$mat[0];
		}
		//update
			$update="update products set 'amz_url'=".$urll.",'amz_price'=".$price.",'amz_stock'=".$stock."where 'title'=".$row["title"];
			if (mysqli_query($con, $update)) {
				$succes++;
			}
			else{
				$failed++;
				
			}
			$done++;
			$percent=($done/$num_rows)*100;
			 	
	}
	?>
</body>
</html>