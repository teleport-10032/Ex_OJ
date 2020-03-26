<?php
error_reporting(0);//禁用错误报告
header("Content-Type: text/html;charset=utf-8");
session_start();
$flag = 1;
if (isset($_SESSION['admin_mail'])) {
    $user_mail = $_SESSION['admin_mail'];
    $user_name = $_SESSION['admin_name'];
    $flag = 0;
}
if ($flag == 1) {
    //echo "<script>alert('$flag')</script>";
    echo "<script>alert('请先登录!');history.back();</script>";
    //echo "<script>url=\"/\";window.location.href=url;</script>";
    exit;
}
?>