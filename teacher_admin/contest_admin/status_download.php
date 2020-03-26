<?php


header("Content-Type: text/html;charset=utf-8");
if(isset($_GET["contest_id"]))
    $contest_id = $_GET["contest_id"];

date_default_timezone_set("PRC");
$file = "/var/www/html/contest_status_file/a.xls";
if(file_exists($file))
{
    unlink($file);
}

include "../../functions/conn.php";
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
// 检测连接
if (!$conn) {
    die("连接失败: " . $conn->connect_error);
}
$sql = "select submit_user_mail,user_name,user_realname,contest_problem,submit_text,submit_when,submit_statu,contest_title
 from contest_status,user,contest
 where submit_user_mail=user_mail and submit_contest=contest_id and contest_id=$contest_id
 into outfile 'a.xls' 
CHARACTER SET gbk
";
echo $sql;
if (mysqli_query($conn, $sql)) {

    $conn->error;
    echo "<a href='/contest_status_file/a.xls'>下载</a>";
} else {
    $conn->error;
    //echo "<script>alert('出大问题！请重试或联系管理员!');history.back();</script>";
}
$conn->close();
