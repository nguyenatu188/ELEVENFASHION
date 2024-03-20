<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New In</title>
</head>
<body>
    <?php
        session_start();
        include 'header.php';
    ?>

    <main class="mx-auto text-center">
        <div class="container container_1 row text-center mx-auto justify-content-evenly text-center mt-3">
        </div>

        <div class="container container_2 row text-center mx-auto mt-3 ">
            <h1>A Style That Fits Everyone</h1>
            <p>Be inspired by sleek shapes, fresh colors and expressive prints</p>
        </div>

        <?php
            include 'connect.php'; 

            $sql = "SELECT distinct p.pName, p.pImage, p.price, p.fabric, p.importDate, p.did, d.dName 
                    FROM product p 
                    INNER JOIN designer d ON p.did = d.did 
                    ORDER BY p.importDate DESC 
                    LIMIT 9";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo '<div class="container container_3 p-2 row text-center mx-auto justify-content-evenly text-center text-black"">';
                echo '<table class="table table-hover">';
                echo '<tr>';
                echo '<th>Product Name</th>';
                echo '<th>Image</th>';
                echo '<th>Price</th>';
                echo '<th>Fabric</th>';
                echo '<th>Import Date</th>';
                echo '<th>Designer</th>';
                echo '</tr>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr onclick="window.location.href=\'chitietsanpham.php?pname=' . $row['pName'] . '\'">';
                    echo '<td>' . $row['pName'] . '</td>';
                    echo '<td><img src="images/' . $row['pImage'] . '" alt="" class="img-fluid" style="max-width: 200px; max-height: 100px;"></td>';
                    echo '<td>' . $row['price'] . '</td>';
                    echo '<td>' . $row['fabric'] . '</td>';
                    echo '<td>' . $row['importDate'] . '</td>';
                    echo '<td>' . $row['dName'] . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
                echo '</div>';
            } else {
                echo '<p>No products found.</p>';
            }

            mysqli_close($conn);
        ?>

    </main>

    <?php
        include 'footer.php';
    ?>
</body>
</html>
