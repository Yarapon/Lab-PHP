<?php session_start();
include("../include/config.php");
error_reporting(0);
 
if($_SESSION['user_type']==1){
    header('location:logout.php');
}else{
    if(isset($_POST['save'])){
        $cat_name = $_POST['cat_name'];
       
 
        $sql ="INSERT INTO category (cat_name) VALUES (:cat_name)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':cat_name',$cat_name,PDO::PARAM_STR);
        
        $query->execute();
        echo "<script>alert('Category has been save')</script>";
        echo "<script>window.location.href='manage_category.php'</script>";
       
 
    }
}
 
 
?>