<?php
session_start();
include("../include/config.php");
error_reporting(0);

header('Content-Type: application/json');

if ($_SESSION['user_type'] == 1) {
    echo json_encode(["status" => "error", "message" => "Unauthorized access"]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    try {
        $eid = filter_input(INPUT_POST, 'eid', FILTER_SANITIZE_NUMBER_INT);
        $fullname = trim($_POST['fullname']);
        $username = trim($_POST['username']);
        $useremail = filter_var($_POST['useremail'], FILTER_VALIDATE_EMAIL);
        $usermobile = trim($_POST['usermobile']);
        $loginpassword = $_POST['loginpassword'];

        if (!$eid || !$fullname || !$username || !$useremail || !$usermobile) {
            echo json_encode(["status" => "error", "message" => "Invalid input data"]);
            exit();
        }

        // ตรวจสอบว่าต้องเปลี่ยนรหัสผ่านหรือไม่
        if (!empty($loginpassword)) {
            $hashedpassword = hash('sha256', $loginpassword);
            $sql = "UPDATE userdata SET fullname=:fullname, username=:username, useremail=:useremail, usermobile=:usermobile, loginpassword=:hashedpassword WHERE id=:eid";
        } else {
            $sql = "UPDATE userdata SET fullname=:fullname, username=:username, useremail=:useremail, usermobile=:usermobile WHERE id=:eid";
        }

        $query = $dbh->prepare($sql);
        $query->bindParam(':eid', $eid, PDO::PARAM_INT);
        $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
        $query->bindParam(':usermobile', $usermobile, PDO::PARAM_STR);

        if (!empty($loginpassword)) {
            $query->bindParam(':hashedpassword', $hashedpassword, PDO::PARAM_STR);
        }

        $query->execute();

        echo json_encode(["status" => "success", "message" => "User has been updated"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
