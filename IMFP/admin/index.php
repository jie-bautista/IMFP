<!DOCTYPE html>
<html lang="en">
<head>
	<title>Products</title>
	<!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e4716abcf0.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php  require_once 'process.php'; ?>

    <?php
    if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif ?>
    <div class="container text-center">
        <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-users-cog"></i> Products Dashboard</h1>
    </div>
    <div class="container">
    <?php 
        $result = $conn->query("SELECT product_id, sellers.name as seller, products.name FROM products LEFT JOIN sellers ON products.seller_id = sellers.seller_id") or die($conn->error);
        ?>

        <div class="d-flex justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Shop</th>
                        <th>Product name</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
        <?php 
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['seller']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['product_id']; ?>" class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['product_id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>

        <?php
        function pre_r( $array ){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>

    <div class="d-flex justify-content-center">
	<form style="margin: 5px" action="process.php" method="POST" class="w-50">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="form-group">
        <script type="text/javascript">
            $(document).ready(function(){
                $("#seller").change(function(){
                    var seller_id=$(this).val();
                    document.getElementById("sellerID").value = seller_id;                   
                });
            });
        </script>
        <input type="test" name="sellerID" id="sellerID" value="<?php echo $seller_id; ?>" style="display:none;">
        <label for="sel1">Shops:</label>
        <select style="margin: 5px" class="form-control" name="Seller" method="POST" id="seller" required="">
            <option selected="" disabled="">-Select a shop-</option>
            <?php
                require 'config.php';
                $sql = "SELECT * FROM sellers ORDER BY name";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    if ($row['seller_id'] == $seller_id) {
                        ?>
                        <option selected="" value=" <?= $row['seller_id']; ?>"><?= $row['name']; ?></option>
                        <?php
                    }else{
                        ?>
                        <option value=" <?= $row['seller_id']; ?>"><?= $row['name']; ?></option>
                        <?php
                    }  
                }
            ?>
        </select>
        <label>Product name:</label>
        <input style="margin: 5px" class="form-control" type="text" name="product" value="<?php echo $name; ?>" placeholder="Enter product name" required="">
        <?php
        if ($update == true):
        ?>
            <button style="margin: 5px" class="btn btn-success" type="submit" name="update" value="Update product">Update product</button>
        <?php else: ?>    
            <button style="margin: 5px" class="btn btn-primary" type="submit" name="submit" value="Add product">Add product</button>
        <?php endif; ?>
        </div>
	</form>
</body>
</html>