<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Reset Passwd|Excalibur OJ
    </title>
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
</head>
<body>
</body>

<?php
session_start();
if(isset($_SESSION["veri"]))
    $veri_code = $_SESSION["veri"];
header("Content-Type: text/html;charset=utf-8");
?>
<?php


if(isset($_POST["user_mail"]))
    $usr_mail = $_POST["user_mail"];
if(isset($_POST["newpasswd"]))
    $newpasswd = $_POST["newpasswd"];
if(isset($_POST["repasswd"]))
    $repasswd = $_POST["repasswd"];
if(isset($_POST["veri"]))
    $veri = $_POST["veri"];

if ($repasswd != $newpasswd) {
//    echo "<script>alert('$newpasswd');</script>";
//    echo "<script>alert('$repasswd');</script>";
    echo "<script>alert('两次密码输入不一致！');history.back();</script>";
    exit;
}
else if($veri != $veri_code)
{

    echo "<script>alert('验证码输入错误！');history.back();</script>";
    exit;
}

else
    {
    include "../functions/conn.php";
    $conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
        if (!$conn) {
            exit("连接失败: " . $conn->connect_error);
        }
        $md5 = md5(md5($newpasswd));
        $sql = "update user set user_passwd='$md5' where user_mail='$usr_mail'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('重置密码成功！')</script>";
            //header("Refresh:0.1;url=/functions/login_out");
            echo "<script>url=\"/\";window.location.href=url;</script>";
        } else {
            //echo $conn->error;
            echo "<script>alert('出大问题！请重试或联系管理员')</script>";
            //header("Refresh:0.1;url=../user_setting");
            echo "<script>url=\"../user_setting\";window.location.href=url;</script>";
        }
    }
//if ($flag == 0) {
//    echo "<script>alert('出大问题！请重试或联系管理员')</script>";
//    echo "<script>url=\"../user_setting\";window.location.href=url;</script>";
//}
$conn->close();
?>