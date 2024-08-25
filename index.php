<?php
require_once('view/Header.php');
session_start();
if (isset($_GET['logout'])) {
  if ($_GET['logout'] == true) {
    session_unset();
    session_destroy();
    header('Location: index.php');
  }
} else {
  $str = "未登入";

  if (isset($_SESSION['level']))
    $str = $_SESSION['level'];
}

$header = Header::nav();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
  <link href="assets/table.css" rel="stylesheet">
  
  <title>
    <?php echo $str; ?>
  </title>
</head>

<body>
  <?php echo $header; ?>
  <main>
    <div>
      <?php
      Header::showNtc();
      if (isset($_GET['fail'])) {

        if ($_GET['fail'] == true) {
          echo '
        <marquee direction="right" scrollamount="20" BEHAVIOR="ALTERNATE">哈哈哈哈哈哈ㄚ哈ㄚㄚ哈哈哈阿哈哈</marquee>
          <marquee width="66%" direction="up" scrollamount="5"  bgcolor=”#AA4444”>打錯了捏打錯了捏打錯了捏灰熊摳連</marquee>
        ';
          echo '登入失敗，請 <a href="view/signin/home.php">再試一次</a> 或 <a href="view/signin/home.php">前往註冊</a> 。';
          echo '
          <marquee direction="left" scrollamount="45">登入失敗登入失敗登入失敗</marquee>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<marquee direction="left" scrollamount="8"  width="50%" bgcolor=”#AB3157”>忘記密碼？</marquee>
          <marquee direction="right" scrollamount="12" BEHAVIOR="ALTERNATE">摳連                            摳連</marquee>
        ';
        }
      }

      ?>

  
    </div>
  </main>
</body>

</html>