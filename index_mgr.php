<?php
require_once('view/Header.php');
session_start();
$header = Header::nav();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <link href="assets/table.css" rel="stylesheet">
  <title>管理者登入後</title>
</head>

<body>
  <?php echo $header; ?>
  <main>
    <div class="tab-content mid" id="myTabContent">
      <div class="d-grid gap-2 d-md-block">
        <input type="button" class="btn btn-primary" value="審核紀錄" onclick="location.href='view/#'">
        <input type="button" class="btn btn-primary" value="教室借用"
          onclick="location.href='view/rsv/classroom_reservation.php'">
        <input type="button" class="btn btn-primary" value="物品借用"
          onclick="location.href='view/rsv/object_reservation.php'">
        <input type="button" class="btn btn-primary" value="管理單位" onclick="location.href='view/#'">
        <input type="button" class="btn btn-primary" value="管理使用者" onclick="location.href='view/mng/user_mgt.php'">
        <input type="button" class="btn btn-primary" value="管理教室" onclick="location.href='view/mng/classroom_mgt.php'">
        <input type="button" class="btn btn-primary" value="管理物品" onclick="location.href='view/mng/object_mgt.php'">
        <input type="button" class="btn btn-primary" value="管理公告" onclick="location.href='Notice_mgr.php'">
        <input type="button" class="btn btn-primary" value="開放期初預約研討室" onclick="location.href='view/#'">
      </div>
    </div>
  </main>
</body>

</html>