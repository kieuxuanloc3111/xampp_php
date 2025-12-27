<?php
session_set_cookie_params(3600);
session_start();

unset($_SESSION['login']);
unset($_SESSION['user_id']);
// session_destroy();

header('Location: login.php');
exit;
