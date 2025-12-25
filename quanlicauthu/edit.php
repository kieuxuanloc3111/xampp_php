<?php
// ======================
// KẾT NỐI DATABASE
// ======================
include 'connect.php';

$errors = [];

// ======================
// LẤY ID + DATA CŨ
// ======================
if (!isset($_GET['id'])) {
    die("Thiếu ID cầu thủ");
}

$id = (int)$_GET['id'];

$sql = "SELECT * FROM cauthu WHERE id = $id";
$result = $con->query($sql);

if ($result->num_rows == 0) {
    die("Không tìm thấy cầu thủ");
}

$data = $result->fetch_assoc();

// ======================
// XỬ LÝ SUBMIT
// ======================
if (isset($_POST['submit'])) {

    $ten_cauthu = $_POST['ten_cauthu'] ?? '';
    $tuoi       = $_POST['tuoi'] ?? '';
    $quoc_tich  = $_POST['quoc_tich'] ?? '';
    $vi_tri     = $_POST['vi_tri'] ?? '';
    $luong      = $_POST['luong'] ?? '';

    // ===== VALIDATE =====
    if ($ten_cauthu == '') $errors['ten_cauthu'] = "Tên cầu thủ không được để trống";
    if ($tuoi == '')       $errors['tuoi'] = "Tuổi không được để trống";
    if ($quoc_tich == '')  $errors['quoc_tich'] = "Quốc tịch không được để trống";
    if ($vi_tri == '')     $errors['vi_tri'] = "Vị trí không được để trống";
    if ($luong == '')      $errors['luong'] = "Lương không được để trống";

    // ===== UPDATE =====
    if (empty($errors)) {

        $sql = "UPDATE cauthu SET
                    ten_cauthu = '$ten_cauthu',
                    tuoi       = '$tuoi',
                    quoc_tich  = '$quoc_tich',
                    vi_tri     = '$vi_tri',
                    luong      = '$luong'
                WHERE id = $id";

        if ($con->query($sql)) {
            echo "<h2>
                    Chỉnh sửa thành công!
                    <a href='index.php'>Quay về danh sách</a>
                  </h2>";
            exit;
        } else {
            echo "Lỗi SQL: " . $con->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Edit Cầu Thủ</title>
</head>
<body>

<h2>Chỉnh sửa cầu thủ</h2>

<form method="post">

    Tên cầu thủ <br>
    <input type="text" name="ten_cauthu" value="<?php echo $data['ten_cauthu']; ?>">
    <p style="color:red"><?php echo $errors['ten_cauthu'] ?? ''; ?></p>

    Tuổi <br>
    <input type="number" name="tuoi" value="<?php echo $data['tuoi']; ?>">
    <p style="color:red"><?php echo $errors['tuoi'] ?? ''; ?></p>

    Quốc tịch <br>
    <input type="text" name="quoc_tich" value="<?php echo $data['quoc_tich']; ?>">
    <p style="color:red"><?php echo $errors['quoc_tich'] ?? ''; ?></p>

    Vị trí <br>
    <input type="text" name="vi_tri" value="<?php echo $data['vi_tri']; ?>">
    <p style="color:red"><?php echo $errors['vi_tri'] ?? ''; ?></p>

    Lương <br>
    <input type="number" name="luong" value="<?php echo $data['luong']; ?>">
    <p style="color:red"><?php echo $errors['luong'] ?? ''; ?></p>

    <br><br>
    <button type="submit" name="submit">Cập nhật</button>

</form>

</body>
</html>
