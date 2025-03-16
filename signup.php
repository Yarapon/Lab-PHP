<?php
include("include/config.php");
error_reporting(0);

if(isset($_POST['signup'])){
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['useremail'];
    $mobile = $_POST['usermobile'];
    $password = $_POST['loginpassword'];
    //echo "<br>";
    $hasedpassword = hash('sha256',$password);
   // print_r($_POST);

   $ret = "SELECT * FROM userdata WHERE (username=:uname || useremail=:uemail)";
   $queryt = $dbh -> prepare($ret);
   $queryt->bindParam(':uname',$username,PDO::PARAM_STR);
   $queryt->bindParam(':uemail',$email,PDO::PARAM_STR);
   $queryt-> execute();
   $results = $queryt -> fetchAll(PDO::FETCH_OBJ);

   if($queryt-> rowCount() == 0){
    //echo "xx";
        $sql = "INSERT INTO userdata(fullname,username,useremail,usermobile,loginpassword) VALUES (:fname,:uname,:uemail,:umobile,:upass)";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':fname',$fullname,PDO::PARAM_STR);
        $query->bindParam(':uname',$username,PDO::PARAM_STR);
        $query->bindParam(':uemail',$email,PDO::PARAM_STR);
        $query->bindParam(':umobile',$mobile,PDO::PARAM_STR);
        $query->bindParam(':upass',$hasedpassword,PDO::PARAM_STR);
        $query-> execute();
        // $lastInsertId = $dbh->$lastInsertId();
        // if($lastInsertId){
        //         echo "You have signup successfully";
        // }else{
        //         echo "Have something wrong. Please try again";
        // }
        echo "<script type='text/javascript'>";
        echo "alert('You have signup successfully');";
        echo "document.location='login.php';";
        echo "</script>";

   }else{
        echo "Username or Email already exist, Please try again";
   }
}

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
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    body {
      background: linear-gradient(135deg,rgb(255, 255, 255) 0%,rgb(0, 0, 0) 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      font-family: 'Poppins', sans-serif;
      padding: 20px;
    }

    .container {
      max-width: 500px;
      background: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    h2 {
      color: #444b8e;
      font-weight: 600;
      margin-bottom: 30px;
      text-align: center;
      font-size: 2.2rem;
    }

    .form-group {
      margin-bottom: 25px;
    }

    label {
      color: #555;
      font-weight: 500;
      margin-bottom: 8px;
    }

    .form-control {
      background-color: #f8f9fa;
      border: 2px solid #e9ecef;
      border-radius: 10px;
      padding: 12px 15px;
      height: auto;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color:rgb(255, 255, 255);
      box-shadow: 0 0 0 0.2rem rgba(42, 155, 143, 0.25);
    }

    .btn-success {
      background-color:rgb(0, 0, 0);
      border: none;
      padding: 12px 30px;
      border-radius: 10px;
      font-weight: 500;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      transition: all 0.3s ease;
      width: 100%;
      margin-top: 10px;
    }

    .btn-success:hover {
      background-color:rgb(237, 123, 199);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
    }

    .form-check {
      padding-left: 30px;
    }

    .form-check-input {
      margin-top: 0.4rem;
    }

    .alert {
      border-radius: 10px;
      margin-bottom: 20px;
      padding: 15px 20px;
    }

    /* Custom animation for form appearance */
    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .container {
      animation: slideUp 0.5s ease-out;
    }

    /* Custom styling for autofill */
    input:-webkit-autofill {
      -webkit-box-shadow: 0 0 0 30px #f8f9fa inset;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
      .container {
        padding: 20px;
      }

      h2 {
        font-size: 1.8rem;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <h2>สมัครสมาชิก</h2>
  <form action="#" method="post">
    <div class="form-group">
      <label for="fullname">ชื่อ</label>
      <input type="text" class="form-control" id="fullname" placeholder="กรอกชื่อของคุณ" name="fullname" required>
    </div>
    <div class="form-group">
      <label for="username">ชื่อผู่ใช้</label>
      <input type="text" class="form-control" id="username" placeholder="กรอกชื่อผู้ใช้" name="username" required>
    </div>
    <div class="form-group">
      <label for="useremail">E-mail</label>
      <input type="email" class="form-control" id="useremail" placeholder="ใส่อีเมลของคุณ" name="useremail" required>
    </div>
    <div class="form-group">
      <label for="usermobile">เบอร์โทรศัพท์</label>
      <input type="text" maxlength="10" pattern="[0-9]{10}" title="Please enter a valid 10-digit mobile number" class="form-control" id="usermobile" placeholder="ป้อนหมายเลขโทรศัพท์ของคุณ" name="usermobile" required>
    </div>
    <div class="form-group">
      <label for="loginpassword">รหัสผ่าน</label>
      <input type="password" class="form-control" id="loginpassword" placeholder="สร้างรหัสผ่าน" name="loginpassword" required>
    </div>
    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> จดจำไว้
      </label>
    </div>

    <button type="submit" class="btn btn-success" name="signup" id="signup">สร้างบัญชี</button>
  </form>
</div>

</body>
</html>