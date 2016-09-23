<?php
if(isset($_GET["amz"])){
$plus=$_GET["amz"];
		$plus=str_replace(" ","+",$plus);
		$url="http://www.amazon.in/s/ref=nb_sb_noss?url=search-alias%3Dcomputers&field-keywords=computer+".$plus;
		$output=file_get_contents($url);
		$reg=preg_match_all("/<span class\=\"currencyINR\">&nbsp;&nbsp;<.*?span>([0-9\.,]{5,256})<.*?span>/",$output,$matches);
		preg_match("/(?:<a class\=\"a\-link-normal s\-access\-detail\-page  a\-text\-normal\" .*? href)=(?:\'|\"|)(?:.*?)([a-zA-Z0-9-:\/.=_?&]{3,500})/",$output,$amatches);
				$price=$matches[1][0];
				 $link=$amatches[1];	 	
		
echo 'Rs '.$price.' 
		<a class="alink" href="'.$link.'">
		<div class="btn btn-primary">Buy</div></a>';
}
?>