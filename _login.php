<?php
include("include/config.php");
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>SignUp Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Login Page</h2>
  <form action="checklogin.php" method="post" >

    <div class="form-group">
      <label for="username">UserName:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter UserName" name="username" required>
    </div>
    <div class="form-group">
      <label for="loginpassword">Password:</label>
      <input type="password" class="form-control" id="loginpassword" placeholder="Enter password" name="loginpassword" required>
    </div>
    <div class="row">
      <div class="col">ถ้าท่านยังไม่ได้สมัครสมาชิก <a href="signup.php">ลงทะเบียนที่นี่</a></div>
      <div class="col"></div>
      <div class="col"></div>
  </div>
   
    <button type="submit" class="btn btn-success" name="login" id="login">Login</button>
  </form>
</div>
</body>
</html>
