<!DOCTYPE html>
<html lang="en">
<head>
    <title>Review Database</title>
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
    <div class="container text-center">
        <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-server"></i> LaShopee</h1>
    </div>

    <div class="d-flex justify-content-center">
        <form action="insert.php" method="POST" class="w-50">
            <div class="py-2">
            <div class="pt-2">
            <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-portrait"></i>
                        </div>  
                    </div>
                    <input type="text" name='name' autocomplete="off" class="form-control" id="name" placeholder='Enter your name' required="">
            </div>
            <div class="form-group">
            <label>Shops:</label>
            <select class="form-control" name="Seller" method="POST" id="seller" required="">
                <option selected="" disabled="">-Select a shop-</option>
                <?php
                    require 'config.php';
                    $sql = "SELECT * FROM sellers ORDER BY name";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <option value=" <?= $row['seller_id']; ?>"><?= $row['name']; ?></option>
                        <?php   
                    }
                ?>
            </select>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#seller").change(function(){
                        var seller_id=$(this).val();
                        $.ajax({
                            url:"seller.php",
                            method:"POST",
                            data:{sellerID:seller_id},
                            success:function(data){
                                $("#product").html(data);
                            }
                        });
                    });
                });
            </script>
            <label>Choose a product to review:</label>
            <select class="form-control" name="Product" id="product" required="">
                <option selected="" disabled="">-Choose a product to review-</option>                
            </select>
            </div>
            <div>
                <label for="sel1">Star rating:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="Star" id="5star" value="5">
                    <label class="form-check-label" for="5star">5</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="Star" id="4star" value="4">
                    <label class="form-check-label" for="4star">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="Star" id="3star" value="3">
                    <label class="form-check-label" for="3star">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="Star" id="2star" value="2">
                    <label class="form-check-label" for="2star">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="Star" id="1star" value="1">
                    <label class="form-check-label" for="1star">1</label>
                </div>
            </div> 
            </div>
            <div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Write review</span>
                </div>
            <textarea class="form-control" name="review" id="review" placeholder="Tell us what you think about the product..." required=""></textarea>
            </div>
        </div>
        </div>
        <div>
        <input class="btn btn-primary" type="submit" name="submit" value="Submit" >
        </div>
        </form>
    </div>
</body>
</html>