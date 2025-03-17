<?php
include("../include/config.php");

header('Content-Type: application/json');

try {
    $query = "SELECT p.pro_id, p.pro_name, p.pro_price, p.pro_description, c.cat_name 
              FROM product p 
              LEFT JOIN category c ON p.cat_id = c.cat_id 
              ORDER BY p.pro_id ASC";

    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);

    if ($stmt->rowCount() > 0) {
        $products = [];

        foreach ($results as $row) {
            $products[] = [
                "pro_id" => $row->pro_id,
                "pro_name" => htmlspecialchars($row->pro_name),
                "pro_price" => $row->pro_price,
                "pro_description" => htmlspecialchars($row->pro_description),
                "cat_name" => htmlspecialchars($row->cat_name),
            ];
        }

        echo json_encode(["status" => "success", "data" => $products]);
    } else {
        echo json_encode(["status" => "success", "data" => []]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>
