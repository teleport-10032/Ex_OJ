<?php
//该文件判定用户是否已经登录，并以$user_mail,$user_name标志当前登录的用户邮箱和用户名
session_start();
header("Content-Type: text/html;charset=utf-8");
$flag = 1; //判断用户身份是否过期
if (isset($_SESSION['admin_name'])) {
    $user_mail = $_SESSION['admin_mail'];
    $user_name = $_SESSION['admin_name'];
    $flag = 0;
} else if (isset($_SESSION['teacher_mail'])) {
    $user_mail = $_SESSION['teacher_mail'];
    $user_name = $_SESSION['teacher_name'];
    $flag = 0;
} else if (isset($_SESSION['LV0_mail'])) {
    $user_mail = $_SESSION['LV0_mail'];
    $user_name = $_SESSION['LV0_name'];
    $flag = 0;
} else if (isset($_SESSION['LV1_mail'])) {
    $user_mail = $_SESSION['LV1_mail'];
    $user_name = $_SESSION['LV1_name'];
    $flag = 0;
} else if (isset($_SESSION['LV2_mail'])) {
    $user_mail = $_SESSION['LV2_mail'];
    $user_name = $_SESSION['LV2_name'];
    $flag = 0;
} else if (isset($_SESSION['LV3_mail'])) {
    $user_mail = $_SESSION['LV3_mail'];
    $user_name = $_SESSION['LV3_name'];
    $flag = 0;
} else if (isset($_SESSION['LV4_mail'])) {
    $user_mail = $_SESSION['LV4_mail'];
    $user_name = $_SESSION['LV4_name'];
    $flag = 0;
} else if (isset($_SESSION['LV5_mail'])) {
    $user_mail = $_SESSION['LV5_mail'];
    $user_name = $_SESSION['LV5_name'];
    $flag = 0;
} else if (isset($_SESSION['LV6_mail'])) {
    $user_mail = $_SESSION['LV6_mail'];
    $user_name = $_SESSION['LV6_name'];
    $flag = 0;
}
if ($flag == 1) {
    echo "<script>alert('请先登录!');history.back();</script>";
    echo "<script>url=\"/\";window.location.href=url;</script>";
    //header("Refresh:0.1;url=/");
    exit;
};
?>