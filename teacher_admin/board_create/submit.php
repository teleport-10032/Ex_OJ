<?php
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set("PRC");
include "../admin_judge.php";


$title = $_POST["title"];
$description = $_POST["description"];
$visiable = 0;

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

$sql = "INSERT INTO announcement (ann_time,ann_author,ann_title, ann_text,ann_visible)
                VALUES 
                (now(),'$id','$title' , '$description','$visiable')";
if (mysqli_query($conn, $sql))
{
    echo "<script>alert('保存成功')</script>";
    echo "<script>url='/teacher_admin/board_admin';window.location.href=url;</script>";
}
else {
    //echo $conn->error;
    echo "<script>alert('保存失败');history.back();</script>";
}



$conn->close();


?>