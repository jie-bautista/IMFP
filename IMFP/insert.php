
<?php  
$author = $_POST['name'];
$productid = $_POST['Product'];
$review = $_POST['review'];
$star_rating = $_POST['Star'];

if (!empty($author) || !empty($productid) || !empty($review) || !empty($star_rating)) {
	require 'config.php';
	$insert = "INSERT into reviews (product_id, review, author, star_rating) VALUES(?,?,?,?)";
	$stmt = $conn->prepare($insert);
	$stmt->bind_param("issi", $productid, $review, $author, $star_rating);
	$stmt->execute();
	?>
	<script type="text/javascript">
	if (window.confirm('Review submitted successfully')) {
		window.location = 'index.php';
	} else {
		window.location = 'index.php';
	}
	</script>
	<?php

}else{
	echo "All fields are required";
	die();
}
?>

