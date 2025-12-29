<?php
include 'session_time.php';
// include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'not_login']);
    exit;
}

$userId = $_SESSION['user_id'];

$productId = (int)($_POST['product_id'] ?? 0);
$action    = $_POST['action'] ?? '';

if ($productId == 0 || $action == '') {
    echo json_encode(['error' => 'invalid']);
    exit;
}

if (!isset($_SESSION['CART'][$userId])) {
    echo json_encode(['error' => 'cart_empty']);
    exit;
}

foreach ($_SESSION['CART'][$userId] as $key => $item) {

    if ($item['id'] == $productId) {

        if ($action === 'plus') {
            $_SESSION['CART'][$userId][$key]['qty']++;
        }

        if ($action === 'minus') {
            $_SESSION['CART'][$userId][$key]['qty']--;

            if ($_SESSION['CART'][$userId][$key]['qty'] <= 0) {
                unset($_SESSION['CART'][$userId][$key]);
            }
        }

        break;
    }
}

$totalQty = 0;
foreach ($_SESSION['CART'][$userId] as $item) {
    $totalQty += $item['qty'];
}

echo json_encode([
    'success' => true,
    'cart' => array_values($_SESSION['CART'][$userId]),

    'totalQty' => $totalQty
]);
