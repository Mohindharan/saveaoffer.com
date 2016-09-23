<?php
set_time_limit(0);
ini_set('memory_limit', '-1');
include("doc/conx.php");

$sql="select title from product where product_id=1";

		$result=mysqli_query($con,$sql);
	if($result){
		while($row=mysqli_fetch_array($result))
	{
	$name=$row["title"];
	$name=str_replace(" ","+",$name);
	$aprice=0;
	$alink="#";
	
	$amzlink="http://www.amazon.in/s/ref=nb_sb_noss_2?field-keywords=".$name;
	$adata=scrape($amzlink);
	$uldata=fetchdata($adata,'<ul id="s-results-list-atf"','</ul>');
	$product=fetchdata($uldata,'<li id="result_1"','</li>');
	if($product){
		
		$alink=fetchdata($product,'<a class="a-link-normal a-text-normal" href="','">');
		$aprice=fetchdata($product,'<span class="a-size-base a-color-price s-price a-text-bold"><span class="currencyINR">&nbsp;&nbsp;</span>','</span>');
	}
	else{
		
		
		$alink-fetchdata($product,'href="','"');
		$aprice=fetchdata($adata,'<span class="a-size-base a-color-price s-price a-text-bold"><span class="currencyINR">&nbsp;&nbsp;</span>','</span>');
	}
	$aprice=str_replace(",","",$aprice);
	preg_match_all('/(?:([0-9]{1,}))/',$aprice,$matches);
	
	$aprice=$matches[0][0];
	if(!$alink&&!$aprice){
	$amz_avi=0;
	}
	else{
	$amz_avi=1;	
	}


	
	
	$elink="#";
	$eprice=0;
	$ebaylink="http://www.ebay.in/sch/i.html?_nkw=".$name;
	$edata=scrape($ebaylink);
	$uldata=fetchdata($edata,'<ul id="ListViewInner">','</ul>');
	$elink=fetchdata($uldata,'href="','"');
	$eli=fetchdata($uldata,'<li class="lvprice prc">','</li>');
	$eprice=fetchdata($eli,'<span class="bold">','</span>');
	preg_match_all('/(?:([0-9,]{1,}))/',$eli,$matches);
	$eprice=$matches[0][0];
	$eprice=str_replace(",","",$eprice);
if(!$elink&&!$eprice){
	$ebay_avi=0;
	}
	else{
	$ebay_avi=1;	
	}
}
$query="update product set amz_price=".$aprice.",amz_url='".$alink."',ebay_price=".$eprice." ,ebay_url='".$elink."'";
}
function scrape($url){
$opts = array('http'=>array('header' => "User-Agent:Chrome/1.0\r\n"));
	
$context = stream_context_create($opts);
	
$output = file_get_contents($url,false,$context); 
return $output;
	
	
}

 function fetchdata($data, $start, $end){
        $data = stristr($data, $start); // Stripping all data from before $start
        $data = substr($data, strlen($start));  // Stripping $start
        $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
        $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
        return $data;   // Returning the scraped data from the function
    }
?>