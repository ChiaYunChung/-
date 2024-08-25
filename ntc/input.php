<?php
session_start();
require_once('Header.php');

?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <title>MySchedule</title>
    <meta name="keywords" content="MySchedule">
    <meta name="description" content="MySchedule">
    <link href="style1.css" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/css?family=Limelight" rel="stylesheet">
    <script type="text/javascript"
        src="http://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=3rMoA6hy05UFwyIxGDc3usjX8ObLNokdY3lNd-WZfMoEGmP_IpmyOBptmNsidzyqyu-qCzG3F9F-S7ZdS0EjPxE284MTLLPP1xo-0SDmWJI"
        charset="UTF-8"></script>
    <link rel="stylesheet" crossorigin="anonymous"
        href="http://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cDovL3dlYi5uY3l1LmVkdS50dy9-czExMDI5MjQvZW50cnkwMS9lbnRyeS5odG1s" />
</head>

<body>
    <header>
        <h1>MySchedule</h1>
        <p>♪~填~♪</p>
    </header>
    <marquee direction="right" scrollamount="20" align="top" BEHAVIOR="ALTERNATE">哈哈哈哈哈哈ㄚ哈ㄚㄚ哈哈哈阿哈哈</marquee>
    <marquee width="66%" direction="up" scrollamount="5" align="botton" bgcolor=”#AA4444”>打錯了捏打錯了捏打錯了捏灰熊摳連</marquee>
    <main id="contents">
        <p><strong><span class="require"></span>1.大小</strong></p>
        <p><strong><span class="require"></span>2.方向</strong></p>
        <p><strong><span class="require"></span>3.速度(3-10)</strong></p>
        <p><strong><span class="require"></span>4.內容</strong></p>
        <p><strong><span class="require"></span>5.顏色</strong></p>
        <p><strong><span class="require"></span>6.行為</strong></p>
        大小設定：跑馬燈字體大小，可設定為數字 1~6 ，不設定則預設大小為4</br>
        *方向設定：可設定 1.up（向上）、2.dun（向下）、3.left（向左）、4.right（向右）。</br>
        *速度設定：可設定為數字，通常設定 3~10 的範圍，數字越大跑得越快。</br>
        行為設定：可設定 1.來回跑(適用方向左右)、2.跑入後停止(適用方向左右)。</br>
        背景顏色：可設定為顏色的色碼，不設定則沒有顏色</br>
        *內容</br>
        *為必填，以","分隔，若未使用行為或顏色也要用"," 分隔 可能有比較好的方法但偶想不到
        <form id="entryForm" action="1.php" method="post" enctype="multipart/form-data">
            <!--表單--><!--加enctype那個才可將資料上傳-->
            <table class="entryTable">
                <caption>編輯公告</caption><!--主題-->
                <?php
                $DestDIR = "upload";
                if (!is_dir($DestDIR) || !is_writeable($DestDIR))
                    die("目錄不存在或無法寫入 ");
                $file_path = './upload/' . 'Ntc.txt';
                $fp = fopen($file_path, 'r');
                ?>
                <tr>
                    <th>公告內容</th>
                    <td><textarea type="text" name="Ntc"><?php while ($line = fgets($fp)) {
                        echo $line;
                    } ?></textarea>
                    </td>
                </tr>
                <?php fclose($fp); ?>

            </table>

            <div class="entryBtns">
                <input type="reset" value="清除重填">
                <input type="submit" value="送出">
            </div>

        </form>
    </main>

    <footer>
        <p><small>Copyright © MYSCHEDULE Web All Rights Reserved.</small></p>
    </footer>
</body>

</html>