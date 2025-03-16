<?php
session_start();
include("../include/config.php");

if(isset($_POST['addProduct'])) {
    $pro_name = $_POST['pro_name'];
    $cat_id = $_POST['cat_id'];
    $pro_price = $_POST['pro_price'];
    $pro_cost = $_POST['pro_cost'];
    
    // File upload handling
    $pro_img = $_FILES["pro_img"]["name"];
    $temp = $_FILES["pro_img"]["tmp_name"];
    $folder = "uploads/product/".$pro_img;
    
    // Move uploaded file
    move_uploaded_file($temp, $folder);

    $sql = "INSERT INTO product (pro_name, cat_id, pro_price, pro_cost, pro_img) VALUES (:pro_name, :cat_id, :pro_price, :pro_cost, :pro_img)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pro_name', $pro_name, PDO::PARAM_STR);
    $query->bindParam(':cat_id', $cat_id, PDO::PARAM_STR);
    $query->bindParam(':pro_price', $pro_price, PDO::PARAM_STR);
    $query->bindParam(':pro_cost', $pro_cost, PDO::PARAM_STR);
    $query->bindParam(':pro_img', $pro_img, PDO::PARAM_STR);

    if($query->execute()) {
        echo "<script>alert('เพิ่มสินค้าสำเร็จ!'); window.location.href='manage_product.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด! กรุณาลองใหม่');</script>";
    }
}
?>