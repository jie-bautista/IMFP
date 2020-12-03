<?php  

session_start();

$conn=mysqli_connect('localhost', 'root', '', 'lashopee');

$id = 0;
$name = '';
$seller_id = '';
$update = false;


if (isset($_POST['submit'])) {
	$seller_id = $_POST['sellerID'];
	$name = $_POST['product'];

	$_SESSION['message'] = "Product has been added!";
	$_SESSION['msg_type'] = "success";

	$conn->query("INSERT into products (name, seller_id) VALUES('$name', '$seller_id')") or die($conn->error);

	header("location: index.php");
}

if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$conn->query("DELETE FROM products WHERE product_id = $id") or die($conn->error);

	$_SESSION['message'] = "Product has been deleted!";
	$_SESSION['msg_type'] = "danger";

	header("location: index.php");
}

if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$result = $conn->query("SELECT * FROM products WHERE product_id = $id") or die($conn->error);	
	$row = $result->fetch_array();
	$seller_id = $row['seller_id'];
	$name = $row['name'];

}

if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$seller_id = $_POST['sellerID'];
	$name = $_POST['product'];

	$conn->query("UPDATE products SET name = '$name', seller_id = '$seller_id' WHERE product_id = $id") or die($conn->error);

	$_SESSION['message'] = "Product has been updated!";
	$_SESSION['msg_type'] = "warning";

	header("location: index.php");
}


?>

