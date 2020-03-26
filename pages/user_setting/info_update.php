<?php
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set("PRC");
include '../../functions/user_judger.php';
?>
<?php
$id = $_POST["id"];
$realname = $_POST["realname"];
$name = $_POST["name"];
$mood = $_POST["mood"];
$major = $_POST["major"];
$github = $_POST["github"];
include "../../functions/conn.php";
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (!$conn) {
    die("连接失败: " . $conn->connect_error);
}

$conn->query("set names 'utf8'");
$sql = "update user set user_name='$name',user_realname='$realname',user_introduction='$mood',user_major='$major',user_github='$github' where user_id='$id'";
if (mysqli_query($conn, $sql)) {

    if (isset($_SESSION['admin_name'])) {
        $_SESSION['admin_name'] = $name;
    }
    else if (isset($_SESSION['teacher_name'])) {
        $_SESSION['teacher_name'] = $name;
    }
    else if (isset($_SESSION['LV0_name']))
    {
        $_SESSION['LV0_name'] = $name;
    }
    else if (isset($_SESSION['LV1_name'])) {
        $_SESSION['LV1_name'] = $name;
    }
    else if (isset($_SESSION['LV2_name'])) {
        $_SESSION['LV2_name'] = $name;
    }else if (isset($_SESSION['LV3_name'])) {
        $_SESSION['LV3_name'] = $name;
    }else if (isset($_SESSION['LV4_name'])) {
        $_SESSION['LV4_name'] = $name;
    }else if (isset($_SESSION['LV5_name'])) {
        $_SESSION['LV5_name'] = $name;
    }else if (isset($_SESSION['LV6_name'])) {
        $_SESSION['LV6_name'] = $name;
    }

    header("Refresh:0.1;url=../user_setting");
} else {
    echo "<script>alert('出大问题！请重试或联系管理员!');history.back();</script>";
}
$conn->close();
?>