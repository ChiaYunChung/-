<?php
require_once('../Header.php');
require_once('../../model/Classroom_rsv.php');
session_start();
$header = Header::ddnav();
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
    <title>違規</title>
</head>

<body>
    <?php echo $header; ?>
    <main>
        <br>
        <div class="mid">
            <h3>目前所有違規紀錄</h3>
            <hr>
        </div>
        <br>
        <div style="margin:0 50px; " class="mid">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:15%">單位</th>
                        <th style="width:15%">日期</th>
                        <th>違規的借用序號：違規項目</th>
                        <th style="width:20%">累積次數</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = Connection::connect();
                    $sql = "SELECT * FROM `violation_mng` ORDER BY `date` DESC";     # should add update option
                    $response = $conn->prepare($sql);
                    $response = Connection::exe($response, '尋找');
                    $v = $response->fetchall(PDO::FETCH_ASSOC);

                    foreach ($v as $sv) {
                        $dn = Classroom_rsv::find_d($sv['d_id']);
                        $rc = Classroom_rsv::finds_by_id($sv['c_rsv_id']);
                        echo '<tr>
                <td>' . $dn['name'] . '</td>
                <td>' . $sv['date'] . '</td>
                <td>' . $sv['c_rsv_id'] . '：<br>' . $rc['review_comment'] . '</td>
                <td>' . $sv['times'] . '</td>
            </tr>';
                    } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>單位</th>
                        <th>日期</th>
                        <th>項目</th>
                        <th>累積次數</th>
                    </tr>
                </tfoot>
            </table>
            <script>
                new DataTable('#example');
            </script>
        </div>
    </main>
</body>

</html>