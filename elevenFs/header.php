<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&family=Kaisei+Tokumin&display=swap" rel="stylesheet">

    <title>ELEVEN FASHION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <style>
        header div.container1 a {
            font-family: 'Jura', sans-serif;
            font-weight: 300;
            font-size: 25px;
        }
        header div.container2 a {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-weight: 400;
            font-size: 20px;
        }
        main form label {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-weight: 400;
            font-size: 17px;
        }
        main h1 {
            font-family: "Kaisei Tokumin", serif;
            font-weight: 300;
            font-size: 25px;
        }
    </style>
    <header class="text-dark py-3 container">
        <div class="container1 container text-center py-1 row">
            <div class="col-7 text-end">
                <a href="new_in.php" class="text-decoration-none border-start border-secondary-subtle text-dark ps-5 ">ELEVEN FASHION</a>
            </div>
            <!-- <div class="col-3 text-end m-auto">
                <a href=""><i class="bi bi-box-arrow-right"></i></a>
                <a href=""><i class="bi bi-person"></i></a>
                <a href=""><i class="bi bi-cart"></i></a>
                <a href=""><i class="bi bi-box-arrow-in-right"></i></a>
            </div> -->
            <div class="col-3 text-end m-auto">
                <?php
                    if (isset($_SESSION['uid'])) {
                        echo '
                            <a href="dangxuat.php" id="logoutIcon"><i class="bi bi-box-arrow-right"></i></a>
                            <a href="cart.php" id="cartIcon"><i class="bi bi-cart"></i></a>
                        ';
                        //<a href="profile.php" id="profileIcon"><i class="bi bi-person"></i></a>
                    } else {
                        echo '<a href="dangnhap.php" id="loginIcon"><i class="bi bi-box-arrow-in-right"></i></a>';
                    }

                ?>
            </div>
        </div>
        <div class="container2 container py-2 border-bottom border-secondary-subtle text-center pt-5">
            <a href="new_in.php" class="text-decoration-none text-dark mx-2">New in</a>
            <a href="clothing.php" class="text-decoration-none text-dark mx-2">Clothing</a>
        </div>
    </header>
</body>
</html>