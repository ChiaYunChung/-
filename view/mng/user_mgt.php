<?php
require_once('../Header.php');
session_start();
if (isset($_SESSION['level'])) {
  if ($_SESSION['level'] != 'admin')
  header('Location: ../../index.php');
} else header('Location: ../../index.php');
$header = Header::ddnav();
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- 引入 Popper.js 2.x -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-yEn6+oEXXlcCtT/mC/WhIi6q4h0nxn3VoRtqu/H4P4QaQfZU9xl2pkXzX+pCH1t4"
    crossorigin="anonymous"></script>
  <!-- 引入 Bootstrap.js 而不是 Bootstrap.bundle.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <!-- Custom styles for this template -->
  <link href="../../assets/table.css" rel="stylesheet">
  <title>user_mgt</title>
</head>

<body>
  <main>
    <?php echo $header; ?>
    <table class="table table-bordered" id="user">
      <h3>List of users</h3>
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">學號</th>
          <th scope="col">姓名</th>
          <th scope="col">帳號/信箱</th>
          <th scope="col">電話號碼</th>
          <th scope="col">狀態</th>
          <th scope="col" class="tr_s">編輯</th>
        </tr>
      </thead>
      <?php
      // 取得SQL指令
      $sql = "SELECT id,name,email,phone,blocked FROM user_mng";
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
        while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
          <tbody>
            <form action="mng.php" method="post">
              <input type="hidden" name="id" value="<?php echo $rows["id"] ?>" />
              <input type="hidden" name="name" value="<?php echo $rows["name"] ?>" />
              <input type="hidden" name="email" value="<?php echo $rows["email"]; ?>" />
              <input type="hidden" name="phone" value="<?php echo $rows["phone"] ?>" />
              <input type="hidden" name="blocked" value="<?php echo $rows["blocked"]; ?>" />
              <tr>
                <td>
                  <?php echo ++$a; ?>
                </td>
                <td scope="row">
                  <?php echo $rows["id"] ?>
                  </th>
                <td>
                  <?php echo $rows["name"] ?>
                  </th>
                <td>
                  <?php echo $rows["email"] ?>
                  </th>
                <td>
                  <?php echo $rows["phone"] ?>
                  </th>
                <td>
                  <?php echo $rows["blocked"] ?>
                  </th>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" name="blocked" id="dropdownMenu2"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      狀態
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                      <li><button class="dropdown-item" type="submit" name="blocked" value="0">0</button></li>
                      <li><button class="dropdown-item" type="submit" name="blocked" value="1">1</button></li>
                    </ul>
                  </div>
                </td>
              </tr>
            </form>
          <?php }
        mysqli_free_result($result);
      }
      mysqli_close($link); // 關閉資料庫連接
      ?>

      </tbody>
    </table>


    <script src="../../assets/dist/js/bootstrap.bundle.min.js"></script>

  </main>
</body>

</html>