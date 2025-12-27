<?php
include 'session_time.php';
include 'connect.php';

$errors = [];
$email = $name = '';
$avatarName = '';

if (isset($_POST['register'])) {

    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $name     = trim($_POST['name'] ?? '');

    if ($email == '') {
        $errors['email'] = 'Email không được để trống';
    }
    if ($password == '') {
        $errors['password'] = 'Password không được để trống';
    }
    if ($name == '') {
        $errors['name'] = 'Name không được để trống';
    }

    if (empty($_FILES['avatar']['name'])) {
        $errors['avatar'] = 'Bạn chưa chọn avatar';
    } else {

        if ($_FILES['avatar']['error'] !== 0) {
            $errors['avatar'] = 'File upload bị lỗi';
        } else {

            $maxSize = 1024 * 1024; 
            if ($_FILES['avatar']['size'] > $maxSize) {
                $errors['avatar'] = 'Avatar phải nhỏ hơn 1MB';
            } else {

                $fileName = $_FILES['avatar']['name'];
                $parts = explode('.', $fileName);
                $fileExt = strtolower(end($parts));

                $allowExt = ['jpg', 'jpeg', 'png'];

                if (!in_array($fileExt, $allowExt)) {
                    $errors['avatar'] = 'Avatar phải là hình ảnh (jpg, jpeg, png)';
                } else {

                    $avatarName = time() . '_' . $fileName;
                }
            }
        }
    }
    // insert
    if (empty($errors)) {

        $uploadDir = './uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $avatarName)) {

            $passwordMd5 = md5($password);

            $sql = "INSERT INTO users (email, password, name, avatar)
                    VALUES ('$email', '$passwordMd5', '$name', '$avatarName')";

            if ($con->query($sql)) {
                echo "<h2>Đăng ký thành công!</h2>";
                echo "<a href='login.php'>Đi tới trang login</a>";
                exit;
            } else {
                echo "Lỗi SQL: " . $con->error;
            }

        } else {
            $errors['avatar'] = 'Upload avatar thất bại';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>
<body>

<section id="form">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="signup-form">
                    <h2>New User Signup!</h2>

                    <form method="post" enctype="multipart/form-data">

                        <input type="text" name="email" placeholder="Email"
                               value="<?php echo $email; ?>">
                        <p style="color:red"><?php echo $errors['email'] ?? ''; ?></p>

                        <input type="password" name="password" placeholder="Password">
                        <p style="color:red"><?php echo $errors['password'] ?? ''; ?></p>

                        <input type="text" name="name" placeholder="Name"
                               value="<?php echo $name; ?>">
                        <p style="color:red"><?php echo $errors['name'] ?? ''; ?></p>

                        <input type="file" name="avatar">
                        <p style="color:red"><?php echo $errors['avatar'] ?? ''; ?></p>

                        <button type="submit" name="register" class="btn btn-default">
                            Signup
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
