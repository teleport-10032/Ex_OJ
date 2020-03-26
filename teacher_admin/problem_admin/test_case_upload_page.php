<?php
include "../admin_judge.php";
date_default_timezone_set("PRC");
if(isset($_GET["problem_id"]))
    $problem_id = $_GET["problem_id"];
if(isset($_GET["page"]))
    $page = $_GET["page"];
?>

<html>
<head>
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <title>测试样例上传</title>
</head>
<body>

<form role="form" action="test_case_upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="avatar" accept="application/zip" id="file"/>
    <p class="help-block">
    </p>
    <?php
    echo "<input type='hidden' value='$problem_id' name='problem_id' maxlength='50' class='form-control'>";
    echo "<input type='hidden' value='$page' name='page' maxlength='50' class='form-control'>";
    ?>
    <button type="submit" class="btn btn-default">Save</button>
</form>

</body>
</html>

