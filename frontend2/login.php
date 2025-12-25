<?php
session_start();
include 'connect.php';

$errors = [];
$email = '';

if (isset($_POST['login'])) {

    // ======================
    // LẤY DỮ LIỆU
    // ======================
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // ======================
    // VALIDATE
    // ======================
    if ($email == '') {
        $errors['email'] = 'Email không được để trống';
    }

    if ($password == '') {
        $errors['password'] = 'Password không được để trống';
    }

    // ======================
    // CHECK LOGIN
    // ======================
    if (empty($errors)) {

        $passwordMd5 = md5($password);

        // SQL kiểm tra user
        $sql = "SELECT * FROM users 
                WHERE email = '$email' 
                AND password = '$passwordMd5'";

        $result = $con->query($sql);

        if ($result->num_rows == 1) {

            $user = $result->fetch_assoc();

            // ======================
            // LƯU SESSION
            // ======================
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_avatar'] = $user['avatar'];

            // ======================
            // CHUYỂN TRANG
            // ======================
            header('Location: index.php');
            exit;

        } else {
            $errors['login'] = 'Email hoặc password không đúng';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>
<body>

<section id="form">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="login-form">
                    <h2>Login to your account</h2>

                    <!-- LỖI CHUNG -->
                    <p style="color:red">
                        <?php echo $errors['login'] ?? ''; ?>
                    </p>

                    <form method="post">

                        <input type="email" name="email" placeholder="Email"
                               value="<?php echo $email; ?>">
                        <p style="color:red"><?php echo $errors['email'] ?? ''; ?></p>

                        <input type="password" name="password" placeholder="Password">
                        <p style="color:red"><?php echo $errors['password'] ?? ''; ?></p>

                        <button type="submit" name="login" class="btn btn-default">
                            Login
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
