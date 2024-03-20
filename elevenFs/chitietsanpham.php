<?php
session_start();
$pname = isset($_GET['pname']) ? $_GET['pname'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
</head>
<body>
    <?php include 'header.php'; 
    
    ?>
    <main class="text-center text-black pb-5">
        
        <?php
        include 'connect.php'; 
        // Query to get product details
        $productQuery = "SELECT DISTINCT pid, pName, pImage, price, fabric FROM product WHERE pName = '$pname'";
        $productResult = $conn->query($productQuery);
        
        // Check if product details are found
        if ($productResult->num_rows > 0) {
            $productRow = $productResult->fetch_assoc();
        ?>
        <div class="product_detail container row ">
            <div class="product_detail_img col border-end border-black">
                <img src="images/<?php echo $productRow["pImage"]; ?>" alt="<?php echo $productRow["pName"]; ?>" style="max-width: 400px; max-height: 400px;">
            </div>

            <div class="product_detail_info container col">
                <ul class="list-group list-group-flush border-0 text-left">
                    <h2><?php echo $productRow["pName"]; ?></h2>
                    <li class="list-group-item border-0">Price : <?php echo $productRow["price"]; ?> $</li>
                    <li class="list-group-item border-0">Fabric : <?php echo $productRow["fabric"]; ?></li>
                    <li class="list-group-item border-0">
                        <form action="addtocartaction.php" method="GET">
                            <select name="size" class="m-auto w-50 form-select">
                                <?php
                                $sizeQuery = "SELECT DISTINCT size FROM product WHERE pName = '$pname'";
                                $sizeResult = $conn->query($sizeQuery);
                                
                                if ($sizeResult->num_rows > 0) {
                                    while ($sizeRow = $sizeResult->fetch_assoc()) {
                                        $size = $sizeRow['size'];
                                        echo "<option value='$size'>$size</option>";
                                    }
                                } else {
                                    echo "<option value=''>No sizes available</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" name="pname" value="<?php echo $pname; ?>">
                            <br>
                            <button class="btn btn-secondary mt-3" type="submit">Thêm vào giỏ hàng</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <?php
        } else {
            echo "No product found";
        }
        
        $conn->close();
        ?>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
