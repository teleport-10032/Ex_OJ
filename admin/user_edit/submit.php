<?php
header("Content-Type: text/html;charset=utf-8");
include "../admin_judge.php";
include "../../functions/user_judger.php";
date_default_timezone_set("PRC");w

if(isset($_POST["page"]))
    $page = $_POST["page"];
if(isset($_POST['user_id']))
    $user_id = $_POST['user_id'];
if(isset($_POST['name']))
    $user_name = $_POST['name'];
if(isset($_POST['realname']))
    $user_realname = $_POST['realname'];
if(isset($_POST['teacher']))
    $user_teacher = $_POST['teacher'];
if(isset($_POST['permission']))
    $user_permission = $_POST['permission'];
if(isset($_POST['judgement']))
    $user_judgement = $_POST['judgement'];
if(isset($_POST['cheat']))
    $user_cheat = $_POST['cheat'];


if($user_name == "")
{
    echo "<script>alert('请填写用户名');history.back();</script>";
    exit;
}
if($user_permission == "")
{
    echo "<script>alert('请填写权限');history.back();</script>";
    exit;
}
if($user_teacher == "")
{
    $user_teacher = -1;
}
if($user_judgement == "")
{
    echo "<script>alert('请填写是否为风纪委员');history.back();</script>";
    exit;
}
if($user_cheat == "")
{
    echo "<script>alert('请填写是否为作弊者');history.back();</script>";
    exit;
}
include '../../functions/conn.php';
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (!$conn) {
    exit("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");


$sql = "
update user set user_name='$user_name',user_realname='$user_realname',user_teacher='$user_teacher',user_permission='$user_permission',user_judgement='$user_judgement',user_cheat='$user_cheat' where user_id='$user_id';
";

if (mysqli_query($conn, $sql))
{
    echo "<script>alert('保存成功')</script>";
    echo "<script>url='/admin/user_admin?page=$page';window.location.href=url;</script>";
}
else {
    echo "$user_teacher";
    echo $conn->error;
    //echo "<script>alert('保存失败');history.back();</script>";
}



$conn->close();


?>