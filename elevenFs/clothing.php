<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothing</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php
        include 'header.php';
    ?>
    <main class="mx-auto">
        <div class="container container_text text-center mx-auto mt-3 mb-3 row">
            <h1>Clothing</h1>
        </div>
        <div class="container row">
            <div class="container col-2 border-end">
                <p>Lọc</p>
                <input type="text" id="search">
            </div>
            <div class="container rowcontainer row col-8" id="product-container">
            <?php
                include 'connect.php';

                $sql = "SELECT distinct pname, pImage FROM product";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $pname = $row['pname'];
                        $pImage = $row['pImage'];

                        echo '<div class="container container_text col product">';
                        echo '<a href="chitietsanpham.php?pname=' . urlencode($pname) . '" class="text-decoration-none">';
                        echo '<img class="shadow mb-5 bg-body-tertiary rounded" src="images/' . $pImage . '" alt="" style="max-width: 200px; max-height: 200px;">';
                        echo '<p style="max-width: 200px; max-height: 100px;">' . $pname . '</p>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }

                // Close connection
                $conn->close();
            ?>
            </div>
        </div>
    </main>
    <?php
        include 'footer.php';
    ?>

    <script>
        $(document).ready(function(){
            $('#search').keyup(function(){
                var query = $(this).val();
                $.ajax({
                    url:'search.php',
                    method:'POST',
                    data:{query:query},
                    success:function(response){
                        $('#product-container').html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>
