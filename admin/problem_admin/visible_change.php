<?php
header("Content-Type: text/html;charset=utf-8");
include "../admin_judge.php";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['visible'])) {
    $visible = $_GET['visible'];
}

include '../../functions/conn.php';
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (!$conn) {
    exit("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");

if($visible==1)
{
    $sql = "update problem set problem_visible='0' where problem_id='$id'";
}
else
{
    $sql = "update problem set problem_visible='1' where problem_id='$id'";
}
if (mysqli_query($conn, $sql))
{
    echo "<script>url='/admin/problem_admin?page=$page';window.location.href=url;</script>";
}
else {
    echo $conn->error;
    echo "<script>alert('保存失败');history.back();</script>";
}

$conn->close();

?>