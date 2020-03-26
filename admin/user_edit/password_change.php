<?php
header("Content-Type: text/html;charset=utf-8");
include "../admin_judge.php";
include "../../functions/user_judger.php";

$page = $_POST["page"];
$user_id = $_POST['user_id'];
$user_password = $_POST['password'];
$passwd = md5(md5($user_password));


if($user_name == "")
{
    echo "<script>alert('请填写用户名');history.back();</script>";
    exit;
}



include '../../functions/conn.php';
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (!$conn) {
    exit("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");


$sql = "
update user set user_passwd='$passwd' where user_id='$user_id';
";

if (mysqli_query($conn, $sql))
{
    echo "<script>alert('保存成功')</script>";
    echo "<script>url='/admin/user_admin?page=$page';window.location.href=url;</script>";
}
else {
    //echo $conn->error;
    echo "<script>alert('保存失败');history.back();</script>";
}



$conn->close();


?>