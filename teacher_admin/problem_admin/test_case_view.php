<html>
<head>
    <title>预览测试样例</title>
</head>
<body>

</body>
</html>


<?php

date_default_timezone_set("PRC");
include "../admin_judge.php";
if(isset($_GET["problem_id"]))
{
    $problem_id = $_GET["problem_id"];
}
$dir = iconv("UTF-8", "GBK","../../judger/test_case/".$problem_id);
$files =  scandir($dir);

echo " <pre>";
print_r($files);