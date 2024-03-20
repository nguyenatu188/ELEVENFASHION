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
  <?php 
    include 'header.php';
  ?>

  <main class="container py-4 pb-5 ">
    <form action="dangnhapAction.php" method="post" class="col-md-6 mx-auto border-bottom border-dark pb-4">
      <h1 class="text-left mb-4">SIGN IN</h1>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-dark btn-block w-100">SIGN IN</button>
      </div>
    </form>
    <div class="container text-center">
      <p class="text-center mt-4">Don't have an account?</p>
      <button type="button" class="btn btn-light border-dark border w-50" >
        <a class="text-decoration-none text-dark" href="dangky.php">CREATE AN ACCOUNT</a>
      </button>
    </div>
  </main>
  <?php
    include 'footer.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>