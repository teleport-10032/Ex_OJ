<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
?>
<?php
include '../user_judger.php';
?>
<?php
if (isset($_SESSION['admin_name'])) {
    unset($_SESSION['admin_name']);
    unset($_SESSION['admin_mail']);
}
if (isset($_SESSION['teacher_name'])) {
    unset($_SESSION['teacher_name']);
    unset($_SESSION['teacher_mail']);
}
if (isset($_SESSION['LV0_name'])) {
    unset($_SESSION['LV0_name']);
    unset($_SESSION['LV0_mail']);
}
if (isset($_SESSION['LV1_name'])) {
    unset($_SESSION['LV1_name']);
    unset($_SESSION['LV1_mail']);
}
if (isset($_SESSION['LV2_name'])) {
    unset($_SESSION['LV2_name']);
    unset($_SESSION['LV2_mail']);
}
if (isset($_SESSION['LV3_name'])) {
    unset($_SESSION['LV3_name']);
    unset($_SESSION['LV3_mail']);
}
if (isset($_SESSION['LV4_name'])) {
    unset($_SESSION['LV4_name']);
    unset($_SESSION['LV4_mail']);
}
if (isset($_SESSION['LV5_name'])) {
    unset($_SESSION['LV5_name']);
    unset($_SESSION['LV5_mail']);
}
if (isset($_SESSION['LV6_name'])) {
    unset($_SESSION['LV6_name']);
    unset($_SESSION['LV6_mail']);
}
echo "<script>url=\"/\";window.location.href=url;</script>";
?>