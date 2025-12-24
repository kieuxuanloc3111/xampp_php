<?php
include 'connect.php';

// Kiểm tra id có tồn tại không
if (!isset($_GET['id'])) {
    die("Thiếu ID");
}

$id = $_GET['id'];

// Kiểm tra id là số
if (!is_numeric($id)) {
    die("ID không hợp lệ");
}

// Ép kiểu cho chắc
$id = (int)$id;

// Câu lệnh xóa
$sql = "DELETE FROM cauthu WHERE id = $id";

// Thực thi
if ($con->query($sql)) {
    echo "<h1>Xóa cầu thủ thành công!
          Click vào <a href='index.php'>đây</a> để về trang danh sách</h1>";
} else {
    echo "<h1>Có lỗi xảy ra!
          Click vào <a href='index.php'>đây</a></h1>";
}
?>
