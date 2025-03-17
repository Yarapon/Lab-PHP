<?php
require 'db_connection.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $pro_name = trim($_POST['pro_name']);
    $cat_id = (int) $_POST['cat_id'];
    $pro_price = (float) $_POST['pro_price'];
    $pro_cost = (float) $_POST['pro_cost'];
    $pro_img = null;

    // ตรวจสอบและอัปโหลดไฟล์
    if (!empty($_FILES['pro_img']['name'])) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = mime_content_type($_FILES['pro_img']['tmp_name']);

        if (in_array($file_type, $allowed_types)) {
            $upload_dir = 'uploads/';
            $pro_img = time() . "_" . basename($_FILES['pro_img']['name']); 
            move_uploaded_file($_FILES['pro_img']['tmp_name'], $upload_dir . $pro_img);
        } else {
            die("ประเภทไฟล์ไม่ถูกต้อง (เฉพาะ JPG, PNG, GIF เท่านั้น)");
        }
    }

    // เพิ่มสินค้าเข้าสู่ฐานข้อมูล
    try {
        $sql_insert = "INSERT INTO product (pro_name, cat_id, pro_price, pro_cost, pro_img) 
                       VALUES (:pro_name, :cat_id, :pro_price, :pro_cost, :pro_img)";
        $query_insert = $dbh->prepare($sql_insert);
        $query_insert->bindParam(':pro_name', $pro_name);
        $query_insert->bindParam(':cat_id', $cat_id);
        $query_insert->bindParam(':pro_price', $pro_price);
        $query_insert->bindParam(':pro_cost', $pro_cost);
        $query_insert->bindParam(':pro_img', $pro_img);

        if ($query_insert->execute()) {
            header("Location: manage_product.php?success=1");
            exit();
        } else {
            echo "เกิดข้อผิดพลาดในการเพิ่มสินค้า!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- ฟอร์มเพิ่มสินค้า -->
<form action="add_product.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="pro_name">ชื่อสินค้า</label>
        <input type="text" class="form-control" id="pro_name" name="pro_name" required>
    </div>

    <div class="form-group">
        <label for="cat_id">หมวดหมู่สินค้า</label>
        <select class="form-control" id="cat_id" name="cat_id" required>
            <?php
            $cat_query = "SELECT * FROM category ORDER BY cat_name ASC";
            $stmt = $dbh->prepare($cat_query);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($categories as $category) {
                echo "<option value='" . $category->cat_id . "'>" . htmlspecialchars($category->cat_name) . "</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="pro_price">ราคาสินค้า</label>
        <input type="number" class="form-control" id="pro_price" name="pro_price" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="pro_cost">ต้นทุนสินค้า</label>
        <input type="number" class="form-control" id="pro_cost" name="pro_cost" step="0.01" required>
    </div>
    
    <div class="form-group">
        <label for="pro_img">รูปภาพสินค้า</label>
        <input type="file" class="form-control-file" id="pro_img" name="pro_img">
    </div>

    <button type="submit" class="btn btn-success">เพิ่มสินค้า</button>
</form>
