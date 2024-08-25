<?php
//user_state
if (isset($_POST["blocked"])) {
   // 建立mysqli物件
   //$mysqli = new mysqli("localhost", "id21351669_ncyu_csie_admin01", "SOso123...")
   $mysqli = new mysqli("localhost", "root", "")
      or die("無法開啟MySQL資料庫連接!<br/>");
   $mysqli->select_db("id21351669_ncyu_csie_reservation");  // 選擇資料庫
   // 建立更新記錄的SQL指令字串
   $sql = "UPDATE user_mng SET ";
   //echo "blocked:" . $_POST["blocked"] . "<br>";
   $sql .= "blocked='" . $_POST["blocked"] . "'";
   $sql .= " WHERE id = '" . $_POST["id"] . "'";
   //echo "<b>SQL指令: $sql</b><br/>";
   // 送出UTF8編碼的MySQL指令
   $mysqli->query('SET NAMES utf8');
   if ($mysqli->query($sql)) // 執行SQL指令
      //echo "資料庫更新記錄成功, 影響記錄數: " .
         $mysqli->affected_rows . "<br/>";
   else
      die("資料庫更新記錄失敗<br/>");
   $mysqli->close();      // 關閉資料庫連接
   header("Location: user_mgt.php");
}
?>
<?php
//classroom add+update
if (isset($_POST["classroom_mng"])) { //update or add
   $mysqli = new mysqli("localhost", "root", "")
      or die("無法開啟MySQL資料庫連接!<br/>");
   $mysqli->select_db("id21351669_ncyu_csie_reservation");  // 選擇資料庫


   $sql = "SELECT * FROM classroom_mng where id='" . $_POST["id"] . "'";

   $result = @mysqli_query($mysqli, $sql);
   if (mysqli_errno($mysqli) != 0) {
      //echo "錯誤代碼: " . mysqli_errno($mysqli) . "<br/>";
      //echo "錯誤訊息: " . mysqli_error($mysqli) . "<br/>";
   } else {
      $total_records = mysqli_num_rows($result);
      //echo $total_records;
   } //更新
   //echo "key: " . $_POST["key"];
   //echo "ac_remote: " . $_POST["ac_remote"];
   //echo "projector_remote: " . $_POST["projector_remote"];
   if ($total_records == 1) {
      $sql = "UPDATE classroom_mng SET ";
      $sql .= "c_type= '" . $_POST["c_type"] . "'";
      $sql .= ",c_key= '" . $_POST["key"] . "'";
      $sql .= ",ac_remote= '" . $_POST["ac_remote"] . "'";
      $sql .= ",projector_remote= '" . $_POST["projector_remote"] . "'";
      $sql .= ",act=0";
      $sql .= " WHERE id = '" . $_POST["id"] . "'";
      //echo "<b>SQL指令: $sql</b><br/>";

      //送出UTF8編碼的MySQL指令
      mysqli_query($mysqli, 'SET NAMES utf8');
      if (mysqli_query($mysqli, $sql)) // 執行SQL指令
         //echo "資料庫更新記錄成功, 影響記錄數: " .
            mysqli_affected_rows($mysqli) . "<br/>";
      else
         die("資料庫更新記錄失敗<br/>");
   }
   // 建立新增的SQL指令字串
   else {
       if(isset($_POST["ac_remote"])) $ac=1; else $ac=0;
       if(isset($_POST["key"])) $k=1; else $k=0;
       if(isset($_POST["projector_remote"])) $p=1; else $p=0;
      //echo "id:" . $_POST["id"] . "<br>";
      $sql = "INSERT INTO classroom_mng (id, c_type, ac_remote, c_key,";
      $sql .= "projector_remote) VALUES ('";
      $sql .=  $_POST["id"] . "','";
      $sql .=  $_POST["c_type"] . "','";
      $sql .= $ac . "','" . $k . "','" .$p . "')";
      //echo "<b>SQL指令: $sql</b><br/>";
      //送出UTF8編碼的MySQL指令
      mysqli_query($mysqli, 'SET NAMES utf8');
      if (mysqli_query($mysqli, $sql)) // 執行SQL指令
         //echo "資料庫新增記錄成功, 影響記錄數: " .
            mysqli_affected_rows($mysqli) . "<br/>";
      else
         die("資料庫新增記錄失敗<br/>");
   }

   $mysqli->close();      // 關閉資料庫連接
   header("Location: classroom_mgt.php");
}
?>
<?php
//classroom hidden
if (isset($_POST["hidden_c"])) {
   //$mysqli = new mysqli("localhost", "id21351669_ncyu_csie_admin01", "SOso123...")
   $mysqli = new mysqli("localhost", "root", "")
      or die("無法開啟MySQL資料庫連接!<br/>");
   $mysqli->select_db("id21351669_ncyu_csie_reservation");  // 選擇資料庫

   $sql = "UPDATE classroom_mng  SET ";
   $sql .= "act=1";
   $sql .= " WHERE id = '" . $_POST["id"] . "'";
   //echo "<b>SQL指令: $sql</b><br/>";
   //echo "id:" . $_POST["id"];
   //送出UTF8編碼的MySQL指令
   mysqli_query($mysqli, 'SET NAMES utf8');
   if (mysqli_query($mysqli, $sql)) // 執行SQL指令
      //echo "資料庫隱藏記錄成功, 影響記錄數: " .
         mysqli_affected_rows($mysqli) . "<br/>";
   else
      die("資料庫隱藏記錄失敗<br/>");
   mysqli_close($mysqli);      // 關閉資料庫連接
   header("Location: classroom_mgt.php");
}
//classroom show
if (isset($_POST["show_c"])) {
   //$mysqli = new mysqli("localhost", "id21351669_ncyu_csie_admin01", "SOso123...")
   $mysqli = new mysqli("localhost", "root", "")
      or die("無法開啟MySQL資料庫連接!<br/>");
   $mysqli->select_db("id21351669_ncyu_csie_reservation");  // 選擇資料庫

   $sql = "UPDATE classroom_mng  SET ";
   $sql .= "act=0";
   $sql .= " WHERE id = '" . $_POST["id"] . "'";
   //echo "<b>SQL指令: $sql</b><br/>";
   //echo "id:" . $_POST["id"];
   //送出UTF8編碼的MySQL指令
   mysqli_query($mysqli, 'SET NAMES utf8');
   if (mysqli_query($mysqli, $sql)) // 執行SQL指令
      //echo "資料庫隱藏記錄成功, 影響記錄數: " .
         mysqli_affected_rows($mysqli) . "<br/>";
   else
      die("資料庫隱藏記錄失敗<br/>");
   mysqli_close($mysqli);      // 關閉資料庫連接
   header("Location: classroom_mgt.php");
}
?>

<?php
//classroom delete
if (isset($_POST["delete_c"])) {
   //$mysqli = new mysqli("localhost", "id21351669_ncyu_csie_admin01", "SOso123...")
   $mysqli = new mysqli("localhost", "root", "")
      or die("無法開啟MySQL資料庫連接!<br/>");
   $mysqli->select_db("id21351669_ncyu_csie_reservation");  // 選擇資料庫

   $sql = "DELETE FROM classroom_mng ";
   $sql .= " WHERE id = '" . $_POST["id"] . "'";
   //echo "<b>SQL指令: $sql</b><br/>";
   //echo "id:" . $_POST["id"];
   //送出UTF8編碼的MySQL指令
   mysqli_query($mysqli, 'SET NAMES utf8');
   if (mysqli_query($mysqli, $sql)) // 執行SQL指令
      //echo "資料庫隱藏記錄成功, 影響記錄數: " .
         mysqli_affected_rows($mysqli) . "<br/>";
   else
      die("資料庫隱藏記錄失敗<br/>");
   mysqli_close($mysqli);      // 關閉資料庫連接
   header("Location: classroom_mgt.php");
}
?>

<?php
//obj add+update
if (isset($_POST["obj_mng"])) { //update or add
   //$mysqli = new mysqli("localhost", "id21351669_ncyu_csie_admin01", "SOso123...")
   $mysqli = new mysqli("localhost", "root", "")
      or die("無法開啟MySQL資料庫連接!<br/>");
   $mysqli->select_db("id21351669_ncyu_csie_reservation");  // 選擇資料庫


   $sql = "SELECT * FROM object_mng where id='" . $_POST["obj_id"] . "'";

   $result = @mysqli_query($mysqli, $sql);
   if (mysqli_errno($mysqli) != 0) {
      //echo "錯誤代碼: " . mysqli_errno($mysqli) . "<br/>";
      //echo "錯誤訊息: " . mysqli_error($mysqli) . "<br/>";
   } else {
      $total_records = mysqli_num_rows($result);
      //echo $total_records;
   } //更新
   //echo "id: " . $_POST["obj_id"];
   //echo "obj_name: " . $_POST["obj_name"];
   //echo "obj_num: " . $_POST["obj_num"];
   if ($total_records == 1) {
      $sql = "UPDATE object_mng SET ";
      $sql .= "name= '" . $_POST["obj_name"] . "'";
      $sql .= ",amount= '" . $_POST["obj_num"] . "'";
      $sql .= ",act= 0";
      $sql .= " WHERE id = '" . $_POST["obj_id"] . "'";
      //echo "<b>SQL指令: $sql</b><br/>";

      //送出UTF8編碼的MySQL指令
      mysqli_query($mysqli, 'SET NAMES utf8');
      if (mysqli_query($mysqli, $sql)) // 執行SQL指令
         //echo "資料庫更新記錄成功, 影響記錄數: " .
            mysqli_affected_rows($mysqli) . "<br/>";
      else
         die("資料庫更新記錄失敗<br/>");
   }
   // 建立新增的SQL指令字串
   else {
      //echo "id:" . $_POST["obj_id"] . "<br>";
      $sql = "INSERT INTO object_mng (name, amount";
      $sql .= ") VALUES ('";
      $sql .= $_POST["obj_name"] . "','";
      $sql .= $_POST["obj_num"] . "')";
      //echo "<b>SQL指令: $sql</b><br/>";
      //送出UTF8編碼的MySQL指令
      mysqli_query($mysqli, 'SET NAMES utf8');
      if (mysqli_query($mysqli, $sql)) // 執行SQL指令
         //echo "資料庫新增記錄成功, 影響記錄數: " .
            mysqli_affected_rows($mysqli) . "<br/>";
      else
         die("資料庫新增記錄失敗<br/>");
   }

   mysqli_close($mysqli);       // 關閉資料庫連接
   header("Location: object_mgt.php");
}
?>
<?php
//obj hidden
if (isset($_POST["hidden_o"])) {
   //$mysqli = new mysqli("localhost", "id21351669_ncyu_csie_admin01", "SOso123...")
   $mysqli = new mysqli("localhost", "root", "")
      or die("無法開啟MySQL資料庫連接!<br/>");
   $mysqli->select_db("id21351669_ncyu_csie_reservation");  // 選擇資料庫

   //echo "id:" . $_POST["obj_id"];
   $sql = "UPDATE object_mng   SET ";
   $sql .= "act=1";
   $sql .= " WHERE id = '" . $_POST["obj_id"] . "'";
   //echo "<b>SQL指令: $sql</b><br/>";
   //送出UTF8編碼的MySQL指令
   mysqli_query($mysqli, 'SET NAMES utf8');
   if (mysqli_query($mysqli, $sql)) // 執行SQL指令
      //echo "資料庫隱藏記錄成功, 影響記錄數: " .
         mysqli_affected_rows($mysqli) . "<br/>";
   else
      die("資料庫隱藏記錄失敗<br/>");
   mysqli_close($mysqli);      // 關閉資料庫連接
   header("Location: object_mgt.php");
}
//obj show
if (isset($_POST["show_o"])) {
   //$mysqli = new mysqli("localhost", "id21351669_ncyu_csie_admin01", "SOso123...")
   $mysqli = new mysqli("localhost", "root", "")
      or die("無法開啟MySQL資料庫連接!<br/>");
   $mysqli->select_db("id21351669_ncyu_csie_reservation");  // 選擇資料庫

   //echo "id:" . $_POST["obj_id"];
   $sql = "UPDATE object_mng   SET ";
   $sql .= "act=0";
   $sql .= " WHERE id = '" . $_POST["obj_id"] . "'";
   //echo "<b>SQL指令: $sql</b><br/>";
   //送出UTF8編碼的MySQL指令
   mysqli_query($mysqli, 'SET NAMES utf8');
   if (mysqli_query($mysqli, $sql)) // 執行SQL指令
      //echo "資料庫隱藏記錄成功, 影響記錄數: " .
         mysqli_affected_rows($mysqli) . "<br/>";
   else
      die("資料庫隱藏記錄失敗<br/>");
   mysqli_close($mysqli);      // 關閉資料庫連接
   header("Location: object_mgt.php");
}
?>
<?php
//obj delete
if (isset($_POST["delete_o"])) { //update or add
   //$mysqli = new mysqli("localhost", "id21351669_ncyu_csie_admin01", "SOso123...")
   $mysqli = new mysqli("localhost", "root", "")
      or die("無法開啟MySQL資料庫連接!<br/>");
   $mysqli->select_db("id21351669_ncyu_csie_reservation");  // 選擇資料庫

   //echo "id:" . $_POST["obj_id"];
   $sql = "DELETE FROM object_mng ";
   $sql .= " WHERE id = '" . $_POST["obj_id"] . "'";
   //echo "<b>SQL指令: $sql</b><br/>";
   //送出UTF8編碼的MySQL指令
   mysqli_query($mysqli, 'SET NAMES utf8');
   if (mysqli_query($mysqli, $sql)) // 執行SQL指令
      //echo "資料庫刪除記錄成功, 影響記錄數: " .
         mysqli_affected_rows($mysqli) . "<br/>";
   else
      die("資料庫刪除記錄失敗<br/>");
   mysqli_close($mysqli);      // 關閉資料庫連接
   header("Location: object_mgt.php");
}
?>