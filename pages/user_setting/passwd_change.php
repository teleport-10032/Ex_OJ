<?php
header("Content-Type: text/html;charset=utf-8");

date_default_timezone_set("PRC");
include '../../functions/user_judger.php';
?>
<?php
$id = $_POST["id"];
$passwd = $_POST["passwd"];
$newpasswd = $_POST["newpasswd"];
$repasswd = $_POST["repasswd"];
if ($repasswd != $newpasswd) {
    echo "<script>alert('两次密码输入不一致！');history.back();</script>";
} else {
    include "../../functions/conn.php";
    $conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
    if (!$conn) {
        exit("连接失败: " . $conn->connect_error);
    }
    $conn->query("set names 'utf8'");
    $sql = "SELECT user_passwd FROM user where user_id = '$id'";
    $result = $conn->query($sql);
    $flag1 = 1;
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc()) {
            if (md5(md5($passwd)) == $row["user_passwd"]) {
                $md5 = md5(md5($newpasswd));
                $sql = "update user set user_passwd='$md5' where user_id='$id'";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('修改成功，请重新登录')</script>";
                    //header("Refresh:0.1;url=/functions/login_out");
                    echo "<script>url=\"/functions/login_out\";window.location.href=url;</script>";
                } else {
                    //echo $conn->error;
                    echo "<script>alert('出大问题！请重试或联系管理员')</script>";
                    //header("Refresh:0.1;url=../user_setting");
                    echo "<script>url=\"../user_setting\";window.location.href=url;</script>";
                }
                $flag1 = 0;
            }
        }
        if ($flag1 == 1) {
            echo "<script>alert('原密码输入错误！');history.back();</script>";
        }
        mysqli_free_result($result);
    } else if ($flag == 0)
    {
        echo "<script>alert('出大问题！请重试或联系管理员')</script>";
        echo "<script>url=\"../user_setting\";window.location.href=url;</script>";
    }
    $conn->close();
}
?>