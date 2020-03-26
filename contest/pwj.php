<?php
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set("PRC");
$servername = '127.0.0.1';
$dbusername = 'root';
$dbpasswd = '1021822981';
$dbname = 'onlineJudge';

$flag = 1; //判断用户身份是否过期
if (isset($_SESSION['admin_name'])) {
    $user_mail = $_SESSION['admin_mail'];
    $user_name = $_SESSION['admin_name'];
    $flag = 0;
} else if (isset($_SESSION['teacher_mail'])) {
    $user_mail = $_SESSION['teacher_mail'];
    $user_name = $_SESSION['teacher_name'];
    $flag = 0;
} else if (isset($_SESSION['LV0_mail'])) {
    $user_mail = $_SESSION['LV0_mail'];
    $user_name = $_SESSION['LV0_name'];
    $flag = 0;
} else if (isset($_SESSION['LV1_mail'])) {
    $user_mail = $_SESSION['LV1_mail'];
    $user_name = $_SESSION['LV1_name'];
    $flag = 0;
} else if (isset($_SESSION['LV2_mail'])) {
    $user_mail = $_SESSION['LV2_mail'];
    $user_name = $_SESSION['LV2_name'];
    $flag = 0;
} else if (isset($_SESSION['LV3_mail'])) {
    $user_mail = $_SESSION['LV3_mail'];
    $user_name = $_SESSION['LV3_name'];
    $flag = 0;
} else if (isset($_SESSION['LV4_mail'])) {
    $user_mail = $_SESSION['LV4_mail'];
    $user_name = $_SESSION['LV4_name'];
    $flag = 0;
} else if (isset($_SESSION['LV5_mail'])) {
    $user_mail = $_SESSION['LV5_mail'];
    $user_name = $_SESSION['LV5_name'];
    $flag = 0;
} else if (isset($_SESSION['LV6_mail'])) {
    $user_mail = $_SESSION['LV6_mail'];
    $user_name = $_SESSION['LV6_name'];
    $flag = 0;
}
if ($flag == 1) {
    echo "<script>alert('请先登录!');history.back();</script>";
    echo "<script>url=\"/\";window.location.href=url;</script>";
    //header("Refresh:0.1;url=/");
    exit;
};


$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
// 检测连接
if (!$conn) {
    die("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");
$str = "select contest_passwd,contest_start_time,contest_end_time from contest where contest_id='$contest_id' limit 1";
$result = $conn->query($str);
while (list($passwd,$start_time,$end_time) = $result->fetch_row())
{
    $now = strtotime('now');
    if(strtotime($start_time)>$now)
    {
        echo "<script>alert('比赛尚未开始！')</script>";
        echo "<script>url=\"/contest/contests\";window.location.href=url;</script>";
        exit;
    }
    if(strtotime($end_time)<$now)
    {
        echo "<script>alert('比赛已结束！')</script>";
        echo "<script>url=\"/contest/contests\";window.location.href=url;</script>";
        exit;
    }
    $passwd = $passwd;
    if($passwd != $contest_passwd)
    {
        echo "<script>alert('您输入的密码不正确！')</script>";
        echo "<script>url='/contest/contests';window.location.href=url;</script>";
        exit;
    }


}

