<?php
	require 'config.php';
	$output='';
	$sql="SELECT * FROM products WHERE seller_id='".$_POST['sellerID']."' ORDER BY name";
	$result=mysqli_query($conn, $sql);
	$output.='<option value="" disabled selected>-Choose a product to review-</option>';
	while ($row= mysqli_fetch_array($result)) {
		$output.='<option value="'.$row["product_id"].'">'.$row['name'].'</option>';
	}
	echo $output;
?>