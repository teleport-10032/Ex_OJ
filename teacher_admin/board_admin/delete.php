<?php
header("Content-Type: text/html;charset=utf-8");
include "../admin_judge.php";
date_default_timezone_set("PRC");
?>
<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
include "../../functions/conn.php";
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (!$conn) {
    die("连接失败: " . $conn->connect_error);
}

$conn->query("set names 'utf8'");
//通过ann_id查作者，若不是该教师则退出
//$sql = "select user_mail from announcement,user where ann_author=user_id";
//$result = $conn->query($sql);
//list($mail) = $result->fetch_row();
//if($mail != $user_mail)
//{
//    echo "<script>alert('对不起，您无权执行此操作';history.back();)</script>";
//    exit;
//}

$sql = "delete from announcement where ann_id='$id'";
if (mysqli_query($conn, $sql))
{
    echo "<script>url=\"../board_admin?page=$page\";window.location.href=url;</script>";
}
else {
    echo "<script>alert('出大问题！请重试或联系管理员';history.back();)</script>";
}
$conn->close();
/**
 * Created by PhpStorm.
 * User: teleport
 * Date: 2019/8/15
 * Time: 9:31
 */
?>