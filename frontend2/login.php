<?php
// session_set_cookie_params(3600);
// session_start();
include 'session_time.php';
include 'connect.php';

$errors = [];
$email = '';

if (isset($_POST['login'])) {

    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email == '') {
        $errors['email'] = 'Email không được để trống';
    }

    if ($password == '') {
        $errors['password'] = 'Password không được để trống';
    }

    if (empty($errors)) {

        $passwordMd5 = md5($password);

        $sql = "SELECT * FROM users 
                WHERE email = '$email' 
                AND password = '$passwordMd5'";

        $result = $con->query($sql);

        if ($result->num_rows == 1) {

            $user = $result->fetch_assoc();

            // 🔥 QUAN TRỌNG: RESET SESSION TẠI ĐÂY
            session_regenerate_id(true);

            // 🔥 XÓA CART CŨ (NẾU CÓ)
            // unset($_SESSION['CART']);

            // SET SESSION USER
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_avatar'] = $user['avatar'];

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
