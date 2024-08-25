<?php
require_once('../Header.php');
session_start();
$header = Header::ddnav();
if (isset($_SESSION['level'])) {
  if ($_SESSION['level'] != 'admin')
      header('Location: ../../index.php');
} else header('Location: ../../index.php');
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>obj_mgt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <!-- Custom styles for this template -->
  <link href="../../assets/table.css" rel="stylesheet">
</head>

<body>
  <?php echo $header; ?>
  <main>
    <table class="table table-bordered">
      <h3>顯示的obj</h3>
      <thead>
        <tr>
          <!--<th scope="col" class="tr_s">#</th>-->
          <th scope="col">物品編號</th>
          <th scope="col">物品名稱</th>
          <th scope="col">物品數量</th>
          <th scope="col" class="tr_s">隱藏</th>
        </tr>
      </thead>
      <?php
      // 取得SQL指令
      $sql = "SELECT * FROM object_mng where act=0";
      // 開啟MySQL的資料庫連接
      $link = @mysqli_connect("localhost", "root", "")
        or die("無法開啟MySQL資料庫連接!<br/>");
      mysqli_select_db($link, "id21351669_ncyu_csie_reservation");  // 選擇myschool資料庫
      // 執行SQL查詢
      $result = @mysqli_query($link, $sql);
      if (mysqli_errno($link) != 0) {
        echo "錯誤代碼: " . mysqli_errno($link) . "<br/>";
        echo "錯誤訊息: " . mysqli_error($link) . "<br/>";
      } else {
        $meta = mysqli_fetch_field($result);
        $total_fields = mysqli_num_fields($result);
        $a = 0;
        while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) { ?>
          <tbody>
            <form action="mng.php" method="post">
              <input type="hidden" name="obj_id" value="<?php echo $rows[0] ?>" />
              <tr>
                <td scope="row">
                  <?php echo ++$a; ?>
                </td>
                <?php for ($i = 1; $i < $total_fields - 1; $i++) { ?>
                  <td scope="row">
                    <?php echo $rows[$i];
                } ?>
                </td>
                <td><button button type="submit" class="btn btn-danger" name="hidden_o">隱藏</button></td>
              </tr>
            </form>
          <?php }
        mysqli_free_result($result);
      }
      mysqli_close($link); // 關閉資料庫連接
      ?>
      </tbody>
    </table><br>
    <button type="button" class="btn btn-warning" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
      aria-controls="offcanvasBottom">新增/更新</button>
    <br>
    <hr><br><br>

    <table class="table table-bordered">
      <h3>隱藏的obj</h3>
      <thead>
        <tr>
          <th scope="col" class="tr_s">#</th>
          <th scope="col">物品編號</th>
          <th scope="col">物品名稱</th>
          <th scope="col">物品數量</th>
          <th scope="col" class="tr_s">刪除</th>
          <th scope="col" class="tr_s">顯示</th>
        </tr>
      </thead>
      <?php
      // 取得SQL指令
      $sql = "SELECT * FROM object_mng where act=1";
      // 開啟MySQL的資料庫連接
      $link = @mysqli_connect("localhost", "root", "")
        or die("無法開啟MySQL資料庫連接!<br/>");
      mysqli_select_db($link, "id21351669_ncyu_csie_reservation");  // 選擇myschool資料庫
      // 執行SQL查詢
      $result = @mysqli_query($link, $sql);
      if (mysqli_errno($link) != 0) {
        echo "錯誤代碼: " . mysqli_errno($link) . "<br/>";
        echo "錯誤訊息: " . mysqli_error($link) . "<br/>";
      } else {
        $meta = mysqli_fetch_field($result);
        $total_fields = mysqli_num_fields($result);
        $a = 0;
        while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) { ?>
          <tbody>
            <form action="mng.php" method="post">
              <input type="hidden" name="obj_id" value="<?php echo $rows[0] ?>" />
              <tr>
                <td scope="row">
                  <?php echo ++$a; ?>
                </td>
                <?php for ($i = 0; $i < $total_fields - 1; $i++) { ?>
                  <td scope="row">
                    <?php echo $rows[$i];
                } ?>
                </td>
                <td><button button type="submit" class="btn btn-danger" name="delete_o">刪除</button></td>
                <td><button button type="submit" class="btn btn-info" name="show_o">
                    <font color="white">顯示</font>
                  </button></td>
              </tr>
            </form>
          <?php }
        mysqli_free_result($result);
      }
      mysqli_close($link); // 關閉資料庫連接
      ?>
      </tbody>
    </table>


    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">新增物品</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body small">
        <form class="row gx-3 gy-2 align-items-center" name="obj" method="post" action="mng.php">

          <div class="col-auto">
            <label class="visually-hidden" for="autoSizingInput">物品編號</label>
            <input type="text" class="form-control" id="autoSizingInput" name="obj_id" placeholder="物品編號">
          </div>
          <div class="col-auto">
            <label class="visually-hidden" for="autoSizingInput">物品名稱</label>
            <input type="text" class="form-control" id="autoSizingInput" name="obj_name" placeholder="物品名稱">
          </div>
          <div class="col-auto">
            <label class="visually-hidden" for="autoSizingInput">物品數量</label>
            <input type="text" class="form-control" id="autoSizingInput" name="obj_num" placeholder="物品數量">
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-primary" name="obj_mng">Submit</button>
          </div>
        </form>

      </div>
    </div>




    <br>

    <script src="../../assets/dist/js/bootstrap.bundle.min.js"></script>

  </main>
</body>

</html>