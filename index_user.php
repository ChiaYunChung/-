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
  <title>使用者登入後</title>
</head>

<body>

  <?php echo $header; ?>
  <main class="container">
    <div class="tab-content mid" id="myTabContent">
      <div>
        <div class="d-grid gap-2 d-md-block">
          <input type="button" class="btn btn-primary" value="預約記錄" onclick="location.href='#'">
          <input type="button" class="btn btn-primary" value="教室借用"
            onclick="location.href='rsv/classroom_reservation.php'">
          <input type="button" class="btn btn-primary" value="物品借用"
            onclick="location.href='rsv/object_reservation.php'">
          <input type="button" class="btn btn-primary" value="教室借用情形" onclick="location.href='#'">
          <input type="button" class="btn btn-primary" value="教室借用情形" onclick="location.href='#'">
        </div>
      </div>
  </main>
</body>

</html>