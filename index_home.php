<?php
require_once('view/Header.php');
require_once('view/Body.php');
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
  <title>借用系統首頁</title>
</head>

<body>
  <?php echo $header; ?>
  <main>
  <?php echo Body::func(); ?>
  </main>
</body>

</html>