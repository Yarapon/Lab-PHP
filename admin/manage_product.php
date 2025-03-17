<?php
session_start();
include("../include/config.php");

$edit_mode = false;
$edit_product = null;

// ตรวจสอบว่ามีการอัปโหลดไฟล์ใหม่หรือไม่
if (!empty($_FILES['pro_img']['name'])) {
    $upload_dir = "uploads/";

    // สร้างโฟลเดอร์อัตโนมัติถ้ายังไม่มี
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $allowed_types = ['jpg', 'jpeg', 'png', 'gif']; // รองรับเฉพาะไฟล์ภาพ
    $file_ext = strtolower(pathinfo($_FILES['pro_img']['name'], PATHINFO_EXTENSION));

    if (!in_array($file_ext, $allowed_types)) {
        echo '<script>alert("รองรับเฉพาะไฟล์ JPG, PNG และ GIF เท่านั้น!");</script>';
    } else {
        $pro_img = time() . "_" . basename($_FILES['pro_img']['name']);
        move_uploaded_file($_FILES['pro_img']['tmp_name'], $upload_dir . $pro_img);
    }
}

if (isset($_GET['edit_id'])) {
    $edit_mode = true;
    $pro_id = $_GET['edit_id'];

    $query = "SELECT * FROM product WHERE pro_id = :pro_id";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);
    $stmt->execute();
    $edit_product = $stmt->fetch(PDO::FETCH_OBJ);
}

// เพิ่มหรือแก้ไขสินค้า
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pro_name = $_POST['pro_name'];
    $pro_price = $_POST['pro_price'];
    $pro_cost = $_POST['pro_cost'];
    $cat_id = $_POST['cat_id'];

    // จัดการรูปภาพ
    $pro_img = isset($_POST['existing_img']) ? $_POST['existing_img'] : '';
    if (!empty($_FILES['pro_img']['name'])) {
        $upload_dir = "uploads/";
        $pro_img = time() . "_" . basename($_FILES['pro_img']['name']);
        move_uploaded_file($_FILES['pro_img']['tmp_name'], $upload_dir . $pro_img);
    }

    try {
        if (isset($_POST['pro_id']) && !empty($_POST['pro_id'])) {
            // อัปเดตสินค้า
            $update_query = "UPDATE product SET pro_name = :pro_name, pro_price = :pro_price, 
                            pro_cost = :pro_cost, pro_img = :pro_img, cat_id = :cat_id WHERE pro_id = :pro_id";
            $update_stmt = $dbh->prepare($update_query);
            $update_stmt->bindParam(':pro_id', $_POST['pro_id'], PDO::PARAM_INT);
        } else {
            // เพิ่มสินค้า
            $update_query = "INSERT INTO product (pro_name, pro_price, pro_cost, pro_img, cat_id) 
                             VALUES (:pro_name, :pro_price, :pro_cost, :pro_img, :cat_id)";
            $update_stmt = $dbh->prepare($update_query);
        }
        $update_stmt->bindParam(':pro_name', $pro_name, PDO::PARAM_STR);
        $update_stmt->bindParam(':pro_price', $pro_price, PDO::PARAM_STR);
        $update_stmt->bindParam(':pro_cost', $pro_cost, PDO::PARAM_STR);
        $update_stmt->bindParam(':pro_img', $pro_img, PDO::PARAM_STR);
        $update_stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);

        if ($update_stmt->execute()) {
            echo '<script>alert("ดำเนินการสำเร็จ!"); window.location.href="manage_product.php";</script>';
        } else {
            echo '<script>alert("เกิดข้อผิดพลาด!");</script>';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// ลบสินค้า
if (isset($_POST['delete_product'])) {
    $pro_id = $_POST['pro_id'];

    $delete_query = "DELETE FROM product WHERE pro_id = :pro_id";
    $delete_stmt = $dbh->prepare($delete_query);
    $delete_stmt->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);

    if ($delete_stmt->execute()) {
        echo '<script>alert("ลบสินค้าสำเร็จ!"); window.location.href="manage_product.php";</script>';
    } else {
        echo '<script>alert("เกิดข้อผิดพลาดในการลบ!");</script>';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>จัดการผู้ใช้งาน | MOMO Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="จัดการผู้ใช้งาน | Admin Panel" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard" />
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    
    <!-- Third Party CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="css/adminlte.css" />
    
    <!-- Additional CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
    
    <!-- Custom styles -->
    <style>
        .table-responsive {
            overflow-x: auto;
        }
        .action-buttons .btn {
            margin: 2px;
        }
        .user-table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .card-title {
            font-weight: 600;
        }
        .badge-user-count {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
            margin-left: 8px;
        }
        .add-button {
            margin-bottom: 15px;
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <!-- Header -->
        <?php include("include/navbar.php"); ?>
        
        <!-- Sidebar -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="dashboard.php" class="brand-link">
                    <img src="./assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
                    <span class="brand-text fw-light">MOMO shop</span>
                </a>
            </div>
            <?php include("include/sidebar.php"); ?>
        </aside>
        <main class="app-main">

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จัดการสินค้า</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4"><?= $edit_mode ? "แก้ไขสินค้า" : "เพิ่มสินค้า" ?></h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <?php if ($edit_mode): ?>
            <input type="hidden" name="pro_id" value="<?= $edit_product->pro_id ?>">
        <?php endif; ?>
        
        <div class="form-group">
            <label>ชื่อสินค้า</label>
            <input type="text" class="form-control" name="pro_name" value="<?= $edit_mode ? $edit_product->pro_name : '' ?>" required>
        </div>
        
        <div class="form-group">
            <label>ราคาขาย</label>
            <input type="text" class="form-control" name="pro_price" value="<?= $edit_mode ? $edit_product->pro_price : '' ?>" required>
        </div>
        
        <div class="form-group">
            <label>ราคาทุน</label>
            <input type="text" class="form-control" name="pro_cost" value="<?= $edit_mode ? $edit_product->pro_cost : '' ?>" required>
        </div>
        
        <div class="form-group">
            <label>รูปภาพ</label>
            <input type="file" class="form-control-file" name="pro_img">
            <?php if ($edit_mode && $edit_product->pro_img): ?>
                <p>รูปปัจจุบัน: <img src="uploads/<?= $edit_product->pro_img ?>" width="100"></p>
                <input type="hidden" name="existing_img" value="<?= $edit_product->pro_img ?>">
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label>ประเภทสินค้า</label>
            <select class="form-control" name="cat_id" required>
                <?php
                $cat_query = "SELECT * FROM category ORDER BY cat_id ASC";
                $cat_stmt = $dbh->prepare($cat_query);
                $cat_stmt->execute();
                $categories = $cat_stmt->fetchAll(PDO::FETCH_OBJ);
                foreach ($categories as $category) {
                    $selected = ($edit_mode && $edit_product->cat_id == $category->cat_id) ? 'selected' : '';
                    echo "<option value='$category->cat_id' $selected>$category->cat_name</option>";
                }
                ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary"><?= $edit_mode ? "อัปเดตสินค้า" : "เพิ่มสินค้า" ?></button>
    </form>

    <h3 class="mt-5">รายการสินค้า</h3>
    <table class="table">
    <thead>
    <tr>
        <th>รูป</th>
        <th>ชื่อ</th>
        <th>ราคา</th>
        <th>ประเภทสินค้า</th>
        <th></th>
        
    </tr>
</thead>
<tbody>
    <?php
    $query = "SELECT p.*, c.cat_name FROM product p JOIN category c ON p.cat_id = c.cat_id ORDER BY p.pro_id ASC";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        echo "<tr>
            <td><img src='uploads/{$row->pro_img}' width='50' height='50'></td>
            <td>{$row->pro_name}</td>
            <td>฿{$row->pro_price}</td>
            <td>{$row->cat_name}</td>
            <td>
                <a href='manage_product.php?edit_id={$row->pro_id}' class='btn btn-warning'>แก้ไข</a>
                <form method='POST' style='display:inline;' onsubmit='return confirm(\"ยืนยันการลบ?\");'>
                    <input type='hidden' name='pro_id' value='{$row->pro_id}'>
                    <button type='submit' name='delete_product' class='btn btn-danger'>ลบ</button>
                </form>
            </td>
        </tr>";
    }
    ?>
</tbody>

    </table>
</div>
</body>
</html>
