<?php
session_start();

// Test nhận dữ liệu từ AJAX
if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    echo "PHP đã nhận product_id = " . $productId;
} else {
    echo "Không nhận được product_id";
}
