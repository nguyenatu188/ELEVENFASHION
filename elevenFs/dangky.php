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
  <main class="container py-4 pb-5">
    <form action="dangKyAction.php" method="post" class="col-md-6 mx-auto border-bottom border-dark pb-4">
      <h1 class="text-left mb-4">CREATE AN ACCOUNT</h1>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
      </div>
      <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nhập họ của bạn">
      </div>
      <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nhập tên của bạn">
      </div>
      <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại">
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ của bạn">
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-dark btn-block w-100">CREATE ACCOUNT</button>
      </div>
    </form>
    <div class="container text-center">
      <p class="text-center mt-4">Already have an account?</p>
      <div class="btn btn-light border-dark border w-50"><a class="text-decoration-none text-dark" href="dangnhap.php">SIGN IN</a></div>
    </div>
  </main>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.querySelector('form');

      form.addEventListener('submit', function(event) {
        // Kiểm tra điều kiện tên không có ký tự đặc biệt
        const firstName = document.getElementById('first_name').value;
        if (!/^[a-zA-Z ]+$/.test(firstName)) {
          alert('Tên không được chứa ký tự đặc biệt.');
          event.preventDefault(); // Ngăn chặn việc gửi form
          return;
        }

        // Kiểm tra điều kiện email phải là đuôi@gmail.com
        const email = document.getElementById('email').value;
        if (!/^[a-zA-Z0-9._-]+@gmail\.com$/.test(email)) {
          alert('Email phải là đuôi@gmail.com.');
          event.preventDefault();
          return;
        }

        // Kiểm tra điều kiện phone number phải là 10 số
        const phoneNumber = document.getElementById('phone_number').value;
        if (!/^\d{10}$/.test(phoneNumber)) {
          alert('Số điện thoại phải là 10 số.');
          event.preventDefault();
          return;
        }
      });
    });
  </script>

  <?php
    include 'footer.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>