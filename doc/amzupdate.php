<?php

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
	
	
if(isset($_GET['url'])){
	$beg="<div class=\"productSpecs specSection\">";
	$link = $_GET['url'];
	$page=scrape($link);
	$spec=fetchdata($page,$beg,"</div>");
	echo $spec;
}

if(isset($_GET["amz"])){
	$name=$_GET["amz"];
	$name=str_replace(" ","+",$name);
	$price=0;
	$link="#";
	
	$amzlink="http://www.amazon.in/s/ref=nb_sb_noss_2?field-keywords=".$name;
	$adata=scrape($amzlink);
	$uldata=fetchdata($adata,'<ul id="s-results-list-atf"','</ul>');
	$product=fetchdata($uldata,'<li id="result_1"','</li>');
	if($product){
		
		$link=fetchdata($product,'<a class="a-link-normal a-text-normal" href="','">');
		$price=fetchdata($product,'<span class="a-size-base a-color-price s-price a-text-bold"><span class="currencyINR">&nbsp;&nbsp;</span>','</span>');
	}
	else{
		
		
		$link-fetchdata($product,'href="','"');
		$price=fetchdata($adata,'<span class="a-size-base a-color-price s-price a-text-bold"><span class="currencyINR">&nbsp;&nbsp;</span>','</span>');
	}
	
	$product_details=array(
		'price'=> $price,
		'url'=>$link);
	
	echo json_encode($product_details);
	
}

?>


	