<?php
session_start();
unset($_SESSION['logedin1']);
unset($_SESSION['user_id']);
//session_destroy();

header("Location:../login/loginform.php");
exit;
?>