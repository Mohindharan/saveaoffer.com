<!DOCTYPE html>
<html lang="en">
<head>
  <title>csv database upload</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Basic Progress Bar</h2>
  <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent;?>%">
      <span class="sr-only">70% Complete</span>
    </div>
  </div>
</div>

</body>
</html>
<?php
set_time_limit(0);
ini_set('memory_limit', '-1');
$i=1;
	$percent=30;

$file_handle = fopen("csv/laptops.csv","r");
	while (!feof($file_handle) ) {
		$line_of_text[] = fgetcsv($file_handle, 10024);
	}

foreach($line_of_text[0] as $lines){
	echo $i.".".$lines."<br>";
	$i++;
}

$count=count($line_of_text);
echo "<br>"."count:".$count."<br>";
$ccount=0;
include("../doc/conx.php");


foreach($line_of_text as $line){
	$title='"'.$line[1].'"';
	$imgurl='"'.$line[3].'"';	
	$pdname='"'.$line[8].'"';
	$category='"'.$line[7].'"';
	$flip_price=$line[5];
	$flip_stock=$line[10];
	$flip_url='"'.$line[6].'"';
	$sql='INSERT INTO `product` (`title`, `imgurl`, `product_brand`, `categories`, `flip_price`, `flip_url`, `flip_stock`) values('.$title.','.$imgurl.','.$pdname.','.$category.','.$flip_price.','.$flip_url.','.$flip_stock.')';
	if ($con->query($sql) === TRUE) {
   
		$ccount++;
		$percent=($ccount/$count)*100;
} else {
    echo "Error: " . $sql . "<br>" . $con->error."<br>";
}
   }

?>
