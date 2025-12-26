<?php
session_start();
include 'connect.php';

// ======================
// 1. NHẬN PRODUCT ID
// ======================
if (!isset($_POST['product_id'])) {
    echo "Thiếu product_id";
    exit;
}

$productId = (int)$_POST['product_id'];

// ======================
// 2. QUERY DB LẤY PRODUCT
// ======================
$sql = "SELECT id, title, price, image FROM products WHERE id = $productId";
$result = $con->query($sql);

if ($result->num_rows == 0) {
    echo "Sản phẩm không tồn tại";
    exit;
}

$product = $result->fetch_assoc();

// ======================
// 3. KHỞI TẠO CART NẾU CHƯA CÓ
// ======================
if (!isset($_SESSION['CART'])) {
    $_SESSION['CART'] = [];
}

// ======================
// 4. KIỂM TRA SẢN PHẨM ĐÃ CÓ TRONG CART CHƯA
// ======================
$found = false;

foreach ($_SESSION['CART'] as $key => $item) {
    if ($item['id'] == $productId) {
        // đã có → tăng số lượng
        $_SESSION['CART'][$key]['qty'] += 1;
        $found = true;
        break;
    }
}

// ======================
// 5. NẾU CHƯA CÓ → THÊM MỚI
// ======================
if (!$found) {
    $item = [
        'id'    => $product['id'],
        'title' => $product['title'],
        'price' => $product['price'],
        'image' => $product['image'],
        'qty'   => 1
    ];

    $_SESSION['CART'][] = $item;
}

// ======================
// 6. TRẢ KẾT QUẢ CHO JS
// ======================
$totalQty = 0;
foreach ($_SESSION['CART'] as $item) {
    $totalQty += $item['qty'];
}

echo $totalQty;
