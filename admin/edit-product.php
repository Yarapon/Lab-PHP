<?php 
session_start();
include("../include/config.php");
error_reporting(0);

// Fetch product details
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE pro_id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $product = $query->fetch(PDO::FETCH_OBJ);
    
    if(!$product) {
        echo "<script>alert('ไม่พบข้อมูลสินค้า'); window.location.href='manage_product.php';</script>";
        exit;
    }
} else {
    echo "<script>window.location.href='manage_product.php';</script>";
    exit;
}

// Update product
if(isset($_POST['updateProduct'])) {
    $pro_id = $_POST['pro_id'];
    $pro_name = $_POST['pro_name'];
    $cat_id = $_POST['cat_id'];
    $pro_price = $_POST['pro_price'];
    $pro_cost = $_POST['pro_cost'];
    
    // Check if new image is uploaded
    if(!empty($_FILES["pro_img"]["name"])) {
        $pro_img = $_FILES["pro_img"]["name"];
        $temp = $_FILES["pro_img"]["tmp_name"];
        $folder = "uploads/product/".$pro_img;
        
        // Move uploaded file
        move_uploaded_file($temp, $folder);
        
        // Update with new image
        $sql = "UPDATE product SET pro_name = :pro_name, cat_id = :cat_id, pro_price = :pro_price, 
                pro_cost = :pro_cost, pro_img = :pro_img WHERE pro_id = :pro_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pro_img', $pro_img, PDO::PARAM_STR);
    } else {
        // Update without changing the image
        $sql = "UPDATE product SET pro_name = :pro_name, cat_id = :cat_id, pro_price = :pro_price, 
                pro_cost = :pro_cost WHERE pro_id = :pro_id";
        $query = $dbh->prepare($sql);
    }
    
    $query->bindParam(':pro_name', $pro_name, PDO::PARAM_STR);
    $query->bindParam(':cat_id', $cat_id, PDO::PARAM_STR);
    $query->bindParam(':pro_price', $pro_price, PDO::PARAM_STR);
    $query->bindParam(':pro_cost', $pro_cost, PDO::PARAM_STR);
    $query->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);
    
    if($query->execute()) {
        echo "<script>alert('อัพเดตสินค้าสำเร็จ!'); window.location.href='manage_product.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด! กรุณาลองใหม่');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>แก้ไขสินค้า | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="แก้ไขสินค้า | Admin Panel" />
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
        .product-image-preview {
            max-width: 150px;
            max-height: 150px;
            object-fit: contain;
            border: 1px solid #ddd;
            padding: 5px;
            margin-top: 10px;
        }
        .required-field::after {
            content: " *";
            color: red;
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
                    <span class="brand-text fw-light">Admin Panel</span>
                </a>
            </div>
            <?php include("include/sidebar.php"); ?>
        </aside>
        
        <!-- Main Content -->
        <main class="app-main">
            <!-- Content Header -->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">แก้ไขสินค้า</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="dashboard.php">หน้าหลัก</a></li>
                                <li class="breadcrumb-item"><a href="manage_product.php">จัดการสินค้า</a></li>
                                <li class="breadcrumb-item active" aria-current="page">แก้ไขสินค้า</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-white">
                                    <h3 class="card-title">แก้ไขข้อมูลสินค้า</h3>
                                </div>
                                
                                <div class="card-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="pro_id" value="<?php echo htmlentities($product->pro_id); ?>">
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="pro_name" class="form-label required-field">ชื่อสินค้า</label>
                                                <input type="text" id="pro_name" name="pro_name" class="form-control" 
                                                       value="<?php echo htmlentities($product->pro_name); ?>" required>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="cat_id" class="form-label required-field">หมวดหมู่</label>
                                                <select id="cat_id" name="cat_id" class="form-select" required>
                                                    <option value="">เลือกหมวดหมู่</option>
                                                    <?php
                                                    $cat_sql = "SELECT * FROM categories ORDER BY cat_name";
                                                    $cat_query = $dbh->prepare($cat_sql);
                                                    $cat_query->execute();
                                                    $categories = $cat_query->fetchAll(PDO::FETCH_OBJ);
                                                    
                                                    if($cat_query->rowCount() > 0) {
                                                        foreach($categories as $category) {
                                                            $selected = ($category->cat_id == $product->cat_id) ? 'selected' : '';
                                                            echo '<option value="'.$category->cat_id.'" '.$selected.'>'.$category->cat_name.'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="pro_price" class="form-label required-field">ราคาขาย</label>
                                                <div class="input-group">
                                                    <input type="number" id="pro_price" name="pro_price" class="form-control" 
                                                           value="<?php echo htmlentities($product->pro_price); ?>" 
                                                           step="0.01" min="0" required>
                                                    <span class="input-group-text">บาท</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="pro_cost" class="form-label required-field">ต้นทุน</label>
                                                <div class="input-group">
                                                    <input type="number" id="pro_cost" name="pro_cost" class="form-control" 
                                                           value="<?php echo htmlentities($product->pro_cost); ?>" 
                                                           step="0.01" min="0" required>
                                                    <span class="input-group-text">บาท</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <label for="pro_img" class="form-label">รูปภาพสินค้า</label>
                                                <input type="file" id="pro_img" name="pro_img" class="form-control" accept="image/*">
                                                <small class="text-muted">เว้นว่างไว้หากไม่ต้องการเปลี่ยนรูปภาพ</small>
                                                
                                                <?php if(!empty($product->pro_img)): ?>
                                                <div class="mt-2">
                                                    <p>รูปภาพปัจจุบัน:</p>
                                                    <img src="uploads/product/<?php echo htmlentities($product->pro_img); ?>" 
                                                         class="product-image-preview" 
                                                         alt="<?php echo htmlentities($product->pro_name); ?>">
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label class="form-label">กำไร (คำนวณอัตโนมัติ)</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" 
                                                           value="<?php echo number_format($product->pro_price - $product->pro_cost, 2); ?>" 
                                                           disabled>
                                                    <span class="input-group-text">บาท</span>
                                                </div>
                                                <small class="text-muted">
                                                    คิดเป็น 
                                                    <?php 
                                                    $profit = $product->pro_price - $product->pro_cost;
                                                    $profitPercent = ($profit / $product->pro_cost) * 100;
                                                    echo number_format($profitPercent, 2); 
                                                    ?>%
                                                </small>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="manage_product.php" class="btn btn-secondary">
                                                <i class="bi bi-x-circle"></i> ยกเลิก
                                            </a>
                                            <button type="submit" name="updateProduct" class="btn btn-primary">
                                                <i class="bi bi-save"></i> บันทึกการเปลี่ยนแปลง
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Footer -->
        <?php include("include/footer.php"); ?>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="../../dist/js/adminlte.js"></script>
    
    <!-- Calculate profit on price/cost change -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceInput = document.getElementById('pro_price');
            const costInput = document.getElementById('pro_cost');
            const profitDisplay = priceInput.closest('.row').nextElementSibling.querySelector('.col-md-6:last-child input');
            const percentDisplay = priceInput.closest('.row').nextElementSibling.querySelector('.col-md-6:last-child small');
            
            function updateProfit() {
                const price = parseFloat(priceInput.value) || 0;
                const cost = parseFloat(costInput.value) || 0;
                const profit = price - cost;
                const profitPercent = cost > 0 ? (profit / cost) * 100 : 0;
                
                profitDisplay.value = profit.toFixed(2);
                percentDisplay.textContent = `คิดเป็น ${profitPercent.toFixed(2)}%`;
            }
            
            priceInput.addEventListener('input', updateProfit);
            costInput.addEventListener('input', updateProfit);
        });
    </script>
</body>
</html>