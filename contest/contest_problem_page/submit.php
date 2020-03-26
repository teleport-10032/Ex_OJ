<?php
date_default_timezone_set("PRC");
header("Content-Type: text/html;charset=utf-8");
include "../../functions/user_judger.php";
if(isset($_POST["code"]))
    $code = $_POST["code"];
if(isset($_POST["problem"]))
    $problem = $_POST["problem"];
if(isset($_POST["contest_problem_id"]))
    $contest_problem_id = $_POST["contest_problem_id"];
if(isset($_POST["user_mail"]))
    $user_mail = $_POST["user_mail"];
if(isset($_POST["contest_id"]))
    $contest = $_POST["contest_id"];
if(isset($_GET["contest_id"]))
    $contest_id = $_GET['contest_id'];
if(isset($_POST["contest_id"]))
{
    $contest_id = $_POST['contest_id'];
}
if(isset($_POST["contest_passwd"]))
{
    $contest_passwd = $_POST['contest_passwd'];
}
if(isset($_GET["contest_passwd"]))
    $contest_passwd = $_GET['contest_passwd'];

include "../pwj.php";


$code = str_replace("<br>", chr(10), $code);
$length = strlen($code);


//echo $code;
//echo "<br>";
//$code=str_replace("\n","<br>",$code);
//echo $code;
include '../../functions/conn.php';
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (!$conn) {
    exit("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");
$sql = "INSERT INTO contest_status ( contest_problem ,submit_contest , submit_user_mail , submit_problem, submit_text,submit_when,submit_statu,submit_language,submit_length)
                VALUES 
                ('$contest_problem_id' , '$contest' , '$user_mail' , '$problem','$code',now(),'Queueing','C','$length')";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('提交成功')</script>";
    echo "<script>url='/contest/contest_statu?contest_id=$contest&contest_passwd=$contest_passwd';window.location.href=url;</script>";
} else {
    echo "<script>alert('提交失败');history.back();</script>";
}
$conn->close();
?>