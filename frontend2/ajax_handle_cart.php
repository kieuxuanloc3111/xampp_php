<?php
// session_set_cookie_params(3600);
// session_start();
include 'session_time.php';
include 'connect.php';

// ======================
// 0. CHECK LOGIN
// ======================
if (!isset($_SESSION['user_id'])) {
    echo 0;
    exit;
}

$userId = $_SESSION['user_id'];

// ======================
// 1. NHẬN PRODUCT ID
// ======================
if (!isset($_POST['product_id'])) {
    echo 0;
    exit;
}

$productId = (int)$_POST['product_id'];

// ======================
// 2. QUERY DB LẤY PRODUCT
// ======================
$sql = "SELECT id, title, price, image FROM products WHERE id = $productId";
$result = $con->query($sql);

if ($result->num_rows == 0) {
    echo 0;
    exit;
}

$product = $result->fetch_assoc();

// ======================
// 3. KHỞI TẠO CART THEO USER
// ======================
if (!isset($_SESSION['CART'][$userId])) {
    $_SESSION['CART'][$userId] = [];
}

// ======================
// 4. KIỂM TRA SẢN PHẨM ĐÃ CÓ CHƯA
// ======================
$found = false;

foreach ($_SESSION['CART'][$userId] as $key => $item) {
    if ($item['id'] == $productId) {
        $_SESSION['CART'][$userId][$key]['qty'] += 1;
        $found = true;
        break;
    }
}

// ======================
// 5. CHƯA CÓ → THÊM MỚI
// ======================
if (!$found) {
    $_SESSION['CART'][$userId][] = [
        'id'    => $product['id'],
        'title' => $product['title'],
        'price' => $product['price'],
        'image' => $product['image'],
        'qty'   => 1
    ];
}

// ======================
// 6. TRẢ TỔNG SỐ LƯỢNG CHO JS
// ======================
$totalQty = 0;
foreach ($_SESSION['CART'][$userId] as $item) {
    $totalQty += $item['qty'];
}

echo $totalQty;
