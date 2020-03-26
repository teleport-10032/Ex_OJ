<?php

include "../admin_judge.php";
date_default_timezone_set("PRC");
header("Content-Type: text/html;charset=utf-8");
include "../../functions/user_judger.php";

//文件上传
if(isset($_POST["problem_id"]))
    $problem_id = $_POST["problem_id"];
if(isset($_POST["page"]))
    $page = $_POST["page"];


$dir = iconv("UTF-8", "GBK","../../judger/test_case/".$problem_id);

function deleteDir($path) {
    if (is_dir($path)) {
        $dirs = scandir($path);
        foreach ($dirs as $dir) {
            if ($dir != '.' && $dir != '..') {
                $sonDir = $path.'/'.$dir;
                if (is_dir($sonDir)) {
                    deleteDir($sonDir);
                    @rmdir($sonDir);
                } else {
                    @unlink($sonDir);
                }
            }
        }
        @rmdir($path);
    }
}


if(is_dir($dir))
    deleteDir($dir);

mkdir ($dir,0777,true);




//10MB限制
if ($_FILES["avatar"]["type"] == "application/zip" &&
    ($_FILES["avatar"]["size"] <= 10485760))
{
    if ($_FILES["avatar"]["error"] > 0) {
        echo "<script>alert('出大问题!请稍后再试或联系管理员');history.back();</script>";
    } else {
        $extension = "zip";
        $file = "../../judger/test_case/" . $problem_id . "/test_case." . $extension;
        if (file_exists($file)) {
            unlink($file);
        }
        $r = move_uploaded_file($_FILES["avatar"]["tmp_name"],
            $file);
        if($r == 1)
        {
            include "../../functions/conn.php";
            $conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
            // 检测连接
            if (!$conn) {
                die("连接失败: " . $conn->connect_error);
            }
            $conn->query("set names 'utf8'");
            $sql = "update problem set problem_testcase_path='$file' where problem_id='$problem_id'";
            if (mysqli_query($conn, $sql))
            {
                $zip = new ZipArchive();
                if ($zip->open($file) === true) {
                    $zip->extractTo($dir);
                    $zip->close();
                } else {
                    echo 'error';
                }
                echo "<script>alert('保存成功')</script>";
                echo "<script>url=\"../problem_admin?page=$page\";window.location.href=url;</script>";

            } else {
                echo "<script>alert('保存失败');history.back();</script>";
            }
            $conn->close();
        }
    }
}
else
{
    echo "<script>alert('qwq请上传正确的文件');history.back();</script>";
}