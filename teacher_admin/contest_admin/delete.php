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
$sql = "delete from contest where contest_id='$id'";
if (mysqli_query($conn, $sql))
{
    echo "<script>url=\"../contest_admin?page=$page\";window.location.href=url;</script>";
}
else {
    echo "<script>alert('只能删除没有提交记录的比赛。如有需要请操作数据库');history.back()</script>";
}
$conn->close();
/**
 * Created by PhpStorm.
 * User: teleport
 * Date: 2019/8/15
 * Time: 9:31
 */
?>