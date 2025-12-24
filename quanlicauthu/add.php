<?php
    $errors = [];
    $data = [
        'ten_cauthu' => '',
        'tuoi' => '',
        'quoc_tich' => '',
        'vi_tri' => '',
        'luong' => ''
    ]; 
    if (isset($_POST["submit"])) {

        $data['ten_cauthu'] = trim($_POST['ten_cauthu'] ?? '');
        $data['tuoi']       = trim($_POST['tuoi'] ?? '');
        $data['quoc_tich']  = trim($_POST['quoc_tich'] ?? '');
        $data['vi_tri']     = trim($_POST['vi_tri'] ?? '');
        $data['luong']      = trim($_POST['luong'] ?? '');

        if ($data['ten_cauthu'] == '') {
            $errors['ten_cauthu'] = 'Vui lòng nhập tên cầu thủ';
        }

        if ($data['tuoi'] == '') {
            $errors['tuoi'] = 'Vui lòng nhập tuổi';
        }

        if ($data['quoc_tich'] == '') {
            $errors['quoc_tich'] = 'Vui lòng nhập quốc tịch';
        }

        if ($data['vi_tri'] == '') {
            $errors['vi_tri'] = 'Vui lòng nhập vị trí';
        }

        if ($data['luong'] == '') {
            $errors['luong'] = 'Vui lòng nhập lương';
        }
        if (empty($errors)) {

            include 'connect.php';

            $sql = "INSERT INTO cauthu
                    (ten_cauthu, tuoi, quoc_tich, vi_tri, luong)
                    VALUES (
                    '".$data['ten_cauthu']."',
                    '".$data['tuoi']."',
                    '".$data['quoc_tich']."',
                    '".$data['vi_tri']."',
                    '".$data['luong']."'
                    )";

            if ($con->query($sql)) {
                echo "<h1>Thêm mới cầu thủ thành công!
                    Click vào <a href='index.php'>đây</a> để về trang danh sách</h1>";
                exit;
            } else {
                echo "<h1>Có lỗi xảy ra! Click vào <a href='index.php'>đây</a></h1>";
            }
        }   

    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <style>
            .error { color: red; font-size: 14px; }
            input { display: block; margin-bottom: 5px; }
        </style>
    </head>
    <body>
        <form action="" method="post">
            <label>Tên cầu thủ</label>
            <input type="text" name="ten_cauthu" value="<?php echo ($data['ten_cauthu']) ?>">
            <span class="error"><?= $errors['ten_cauthu'] ?? '' ?></span>

            <label>Tuổi</label>
            <input type="number" name="tuoi" value="<?php echo ($data['tuoi']) ?>">
            <span class="error"><?= $errors['tuoi'] ?? '' ?></span>

            <label>Quốc tịch</label>
            <input type="text" name="quoc_tich" value="<?php echo ($data['quoc_tich']) ?>">
            <span class="error"><?= $errors['quoc_tich'] ?? '' ?></span>

            <label>Vị trí</label>
            <input type="text" name="vi_tri" value="<?php echo ($data['vi_tri']) ?>">
            <span class="error"><?= $errors['vi_tri'] ?? '' ?></span>

            <label>Lương</label>
            <input type="number" name="luong" value="<?php echo ($data['luong']) ?>">
            <span class="error"><?= $errors['luong'] ?? '' ?></span>

            <br>
            <button type="submit" name="submit">Thêm cầu thủ</button>
        </form>
    </body>
</html>