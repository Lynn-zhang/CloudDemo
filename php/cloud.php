<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>我的云盘</title>
        <link rel="stylesheet" type="text/css" href="../css/cloud.css">
    </head>
    <body>
	
        <div class="header">
            <div class="title">我的云盘</div>
            <form id="upload-form" method="post" action="cloud.php" enctype="multipart/form-data">
                <div>上传图片</div>
                <input type="file" name="upload" id="upload">
                <input type="hidden" name="upl_time" id="upl-time">
            </form>
        </div>
        <div class="content" id="content"></div>
		
    </body>
    <?php
        require_once("cloudhandler.php");
        // 开启session
        if(!isset($_SESSION)) {
            session_start();
        }
        // 防止刷新重复上传提交
        if(isset($_FILES["upload"])) {
            if(isset($_POST["upl_time"])) {
                if(isset($_SESSION["upl_time"]) && $_POST["upl_time"] == $_SESSION["upl_time"]) {

                } else {
                    upload_pic();
                    $_SESSION["upl_time"] = $_POST["upl_time"];
                    unset($_FILES["upload"]);
                }
            }
        }

        // 防止刷新重复删除提交
        if(isset($_POST["remove"])) {
            if(isset($_POST["rm_time"])) {
                if(isset($_SESSION["rm_time"]) && $_POST["rm_time"] == $_SESSION["rm_time"]) {

                } else {
                    rmpic($_POST["remove"]);
                    $_SESSION["rm_time"] = $_POST["rm_time"];
                }
            }
        }

        // 防止刷新重复下载提交
        if(isset($_POST["download"])) {
            if(isset($_POST["down_time"])) {
                if(isset($_SESSION["down_time"]) && $_POST["down_time"] == $_SESSION["down_time"]) {

                } else {
                    download_pic($_POST["download"]);
                    $_SESSION["down_time"] = $_POST["down_time"];
                }
            }
        }
        // 显示图片
        show_pics();
    ?>
</html>