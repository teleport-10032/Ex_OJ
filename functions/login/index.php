<?php
header("Content-Type: text/html;charset=utf-8");
session_start();

$user_mail = $_POST["user_mail"];
$user_passwd = $_POST["user_passwd"];

include '../conn.php';
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (!$conn) {
    exit("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");
$sql = "SELECT user_passwd,user_permission,user_name,user_mail,user_available FROM user where user_mail = '$user_mail'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    //找到邮箱
    while ($row = $result->fetch_assoc()) {
        if (md5(md5($user_passwd)) == $row["user_passwd"]) {
            if($row["user_available"] == 0)
            {
                echo "<script>alert('qaq出于某些原因您的账号已被禁止登陆，请联系老师或管理员解封')</script>";
            }
            else
            {
                //以下记录下用户所拥有的权限
                if ($row["user_permission"] == 'admin') {
                    $_SESSION['admin_name'] = $row["user_name"];
                    $_SESSION['admin_mail'] = $row["user_mail"];
                } else if ($row["user_permission"] == 'teacher') {
                    $_SESSION['teacher_name'] = $row["user_name"];
                    $_SESSION['teacher_mail'] = $row["user_mail"];
                } else if ($row["user_permission"] == 'LV1') {
                    $_SESSION['LV1_name'] = $row["user_name"];
                    $_SESSION['LV1_mail'] = $row["user_mail"];
                } else if ($row["user_permission"] == 'LV2') {
                    $_SESSION['LV2_name'] = $row["user_name"];
                    $_SESSION['LV2_mail'] = $row["user_mail"];
                } else if ($row["user_permission"] == 'LV3') {
                    $_SESSION['LV3_name'] = $row["user_name"];
                    $_SESSION['LV3_mail'] = $row["user_mail"];
                } else if ($row["user_permission"] == 'LV4') {
                    $_SESSION['LV4_name'] = $row["user_name"];
                    $_SESSION['LV4_mail'] = $row["user_mail"];
                } else if ($row["user_permission"] == 'LV5') {
                    $_SESSION['LV5_name'] = $row["user_name"];
                    $_SESSION['LV5_mail'] = $row["user_mail"];
                } else if ($row["user_permission"] == 'LV6') {
                    $_SESSION['LV6_name'] = $row["user_name"];
                    $_SESSION['LV6_mail'] = $row["user_mail"];
                } else if ($row["user_permission"] == 'LV0') {
                    $_SESSION['LV0_name'] = $row["user_name"];
                    $_SESSION['LV0_mail'] = $row["user_mail"];
                }
            }
            echo "<script>url=\"/\";window.location.href=url;</script>";
        } else {
            echo "<script>alert('用户名或密码不正确!');history.back();</script>";
        }
    }
    mysqli_free_result($result);
} else {
    //没有找到邮箱
    echo "<script>alert('用户名或密码不正确!');history.back();</script>";
}
$conn->close();
?>