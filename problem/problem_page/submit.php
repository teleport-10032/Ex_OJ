<?php
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set("PRC");
include "../../functions/user_judger.php";
$code = $_POST["code"];
$problem_id = $_POST["problem_id"];
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
$sql = "INSERT INTO status (submit_user_mail , submit_problem, submit_text,submit_when,submit_statu,submit_language,submit_length)
                VALUES 
                ( '$user_mail' , '$problem_id','$code',now(),'Queueing','C','$length')";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('提交成功')</script>";
    echo "<script>url=\"/statu/status\";window.location.href=url;</script>";
} else {
    echo "<script>alert('提交失败');history.back();</script>";
}
$conn->close();
?>