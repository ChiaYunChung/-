<?php
require_once('view/Header.php');
session_start();
$header = Header::nav();
if (isset($_SESSION['level'])) {
  if ($_SESSION['level'] != 'admin')
      header('Location: index.php');
}  else header('Location: index.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <!-- Custom styles for this template -->
  <link href="../../assets/table.css" rel="stylesheet">
  <link href="ntc/table.css" rel="stylesheet">
  <title>管理者編輯公告</title>
</head>

<body>
<?php echo $header; ?>
  <main>
  <p><strong><span class="require"></span>大小(1~7), 方向(1~4), 速度(3-10), 行為(1、2), 顏色, 內容</strong></p>
        大小設定：跑馬燈字體大小，可設定為數字 1~7 ，不設定則預設大小為4</br>
        *方向設定：可設定 1.up（向上）、2.dun（向下）、3.left（向左）、4.right（向右）。</br>
        *速度設定：可設定為數字，通常設定 3~10 的範圍，數字越大跑得越快。</br>
        行為設定：可設定 1.來回跑(適用方向左右)、2.跑入後停止(適用方向左右)。</br>
        背景顏色：可設定為顏色的色碼，不設定則沒有顏色</br>
        *內容</br>
        *為必填，以","分隔，若未使用行為或顏色也要用"," 分隔 可能有比較好的方法但偶想不到
        若想輸出空格，可使用：&nbsp;
    <form id="entryForm" action="ntc/show.php" method="post" enctype="multipart/form-data">
      <table class="entryTable">
        <?php
        $DestDIR = "ntc/upload";
        if (!is_dir($DestDIR) || !is_writeable($DestDIR))
          die("目錄不存在或無法寫入 ");
        $file_path = './ntc/upload/' . 'Ntc.txt';
        $fp = fopen($file_path, 'r');
        ?>
        <tr>
          <th>編輯公告</th>
          <td><textarea type="text" name="Ntc"><?php while ($line = fgets($fp)) {
            echo $line;
          } ?></textarea></td>
        </tr>
        <?php fclose($fp); ?>

      </table>

      <div class="entryBtns">
        <input type="submit" value="送出">
      </div>
    </form>
  </main>
</body>

</html>