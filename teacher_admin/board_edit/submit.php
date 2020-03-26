<?php
header("Content-Type: text/html;charset=utf-8");
include "../admin_judge.php";
include "../../functions/user_judger.php";
date_default_timezone_set("PRC");

$page = $_POST["page"];
$ann_id = $_POST['ann_id'];
$title = $_POST["title"];
$description = $_POST["description"];


if($title == "")
{
    echo "<script>alert('请填写标题');history.back();</script>";
    exit;
}
if($description == "")
{
    echo "<script>alert('请填写正文');history.back();</script>";
    exit;
}


include '../../functions/conn.php';
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (!$conn) {
    exit("连接失败: " . $conn->connect_error);
}

$conn->query("set names 'utf8'");
$str = "select user_id from user where user_mail='$user_mail'";
$result = $conn->query($str);
while (list($user_id) = $result->fetch_row())
{
    $id = $user_id;
}



$sql = "
update announcement set ann_time=now(),ann_author='$id',ann_title='$title',ann_text='$description' where ann_id='$ann_id'
";

if (mysqli_query($conn, $sql))
{
    echo "<script>alert('保存成功')</script>";
    echo "<script>url='../board_admin';window.location.href=url;</script>";
}
else {
    //echo $conn->error;
    echo "<script>alert('保存失败');history.back();</script>";
}



$conn->close();


?>