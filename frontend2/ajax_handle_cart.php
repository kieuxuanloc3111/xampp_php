<?php
// session_set_cookie_params(3600);
// session_start();
include 'session_time.php';
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    echo 0;
    exit;
}

$userId = $_SESSION['user_id'];

if (!isset($_POST['product_id'])) {
    echo 0;
    exit;
}

$productId = (int)$_POST['product_id'];


$sql = "SELECT id, title, price, image FROM products WHERE id = $productId";
$result = $con->query($sql);

if ($result->num_rows == 0) {
    echo 0;
    exit;
}

$product = $result->fetch_assoc();


if (!isset($_SESSION['CART'][$userId])) {
    $_SESSION['CART'][$userId] = [];
}

$found = false;

foreach ($_SESSION['CART'][$userId] as $key => $item) {
    if ($item['id'] == $productId) {
        $_SESSION['CART'][$userId][$key]['qty'] += 1;
        $found = true;
        break;
    }
}
if (!$found) {
    $_SESSION['CART'][$userId][] = [
        'id'    => $product['id'],
        'title' => $product['title'],
        'price' => $product['price'],
        'image' => $product['image'],
        'qty'   => 1
    ];
}
$totalQty = 0;
foreach ($_SESSION['CART'][$userId] as $item) {
    $totalQty += $item['qty'];
}

echo $totalQty;
