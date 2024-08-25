<?php
require_once ('Header.php');;
session_start();
$header = Header::nav();
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
  <!-- Custom styles for this template -->
  <link href="table.css" rel="stylesheet">
  <title>編輯完後</title>
</head>
<?php
echo $header;
?>
<body>
<main id="contents">
<?php Header::showNtc(); ?>
<form id="entryForm" action="#" method="post" enctype="multipart/form-data">
<table class="entryTable">
</table>

<div class="entryBtns">
    <a href="../Notice_mgr.php"><input type="button" value="更新"></a>
</div>
</form>

</main>
</body>   
</html>