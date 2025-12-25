<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    header('Location: my-product.php');
    exit;
}

$productId = (int)$_GET['id'];


$sql = "SELECT * FROM products 
        WHERE id = $productId AND user_id = $userId";
$result = $con->query($sql);

if ($result->num_rows == 0) {
    header('Location: my-product.php');
    exit;
}

$product = $result->fetch_assoc();
$image = $product['image'];

$sql = "DELETE FROM products 
        WHERE id = $productId AND user_id = $userId";

if ($con->query($sql)) {


    $imagePath = './uploads/' . $image;
    if (!empty($image) && file_exists($imagePath)) {
        unlink($imagePath);
    }
}

header('Location: my-product.php');
exit;
?>