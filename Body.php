<?php

class Body
{
  public static function func()
  {
    $str = '';
    if (isset($_SESSION['level']))
      $str = $_SESSION['level'];

    if ($str == 'user') {
      if (isset($_SESSION['blocked']))
        if ($_SESSION['blocked'] == 0) {
          $func = '    <div class="tab-content mid" id="myTabContent">
      <div class="d-grid gap-2 d-md-block">
        <input type="button" class="btn btn-primary" value="預約記錄" onclick="location.href=\'view/rsv/rsv_rec_all.php\'">
        <input type="button" class="btn btn-primary" value="教室借用"
          onclick="location.href=\'view/rsv/classroom_reservation.php\'">
        <input type="button" class="btn btn-primary" value="物品借用" onclick="location.href=\'view/rsv/object_reservation.php\'">
        <input type="button" class="btn btn-primary" value="教室借用情形" onclick="location.href=\'view/rsv/classroom_reservation_v.php\'">
        <input type="button" class="btn btn-primary" value="物品借用情形" onclick="location.href=\'view/rsv/object_reservation_v.php\'">
      </div>
    </div>';
        } else {
          $func = '    <div class="mid">
          <br>您因多次惡意操作，已遭管理員黑名單（禁止借用），詳情請洽系辦以解除。<br><br>
          </div>
          <div class="tab-content mid" id="myTabContent">
      <div class="d-grid gap-2 d-md-block">
      <input type="button" class="btn btn-primary" value="預約記錄" onclick="location.href=\'view/rsv/rsv_rec_all.php\'">
      <input type="button" class="btn btn-primary" value="教室借用情形" onclick="location.href=\'view/rsv/classroom_reservation_v.php\'">
        <input type="button" class="btn btn-primary" value="物品借用情形"onclick="location.href=\'view/rsv/object_reservation_v.php\'">
      </div>
    </div>
    ';
        }

    } else if ($str == 'admin') {
      //        <input type="button" class="btn btn-primary" value="管理單位" onclick="location.href=\'view/#\'">
      //<input type="button" class="btn btn-primary" value="開放期初預約研討室" >
      $func = ' <div class="tab-content mid" id="myTabContent">
      <div class="d-grid gap-2 d-md-block">
        <input type="button" class="btn btn-primary" value="審核紀錄" onclick="location.href=\'view/rsv/classroom_rsv_rec.php\'">
        <input type="button" class="btn btn-primary" value="教室借用"
          onclick="location.href=\'view/rsv/classroom_reservation.php\'">
        <input type="button" class="btn btn-primary" value="物品借用"
          onclick="location.href=\'view/rsv/object_reservation.php\'">

        <input type="button" class="btn btn-primary" value="管理使用者" onclick="location.href=\'view/mng/user_mgt.php\'">
        <input type="button" class="btn btn-primary" value="管理教室" onclick="location.href=\'view/mng/classroom_mgt.php\'">
        <input type="button" class="btn btn-primary" value="管理物品" onclick="location.href=\'view/mng/object_mgt.php\'">
        <input type="button" class="btn btn-primary" value="管理公告" onclick="location.href=\'Notice_mgr.php\'">
        
      </div>
    </div>';
    } else {
      $func = '    <div class="tab-content mid" id="myTabContent">
      <div class="d-grid gap-2 d-md-block">
      <input type="button" class="btn btn-primary" value="教室借用情形" onclick="location.href=\'view/rsv/classroom_reservation_v.php\'">
        <input type="button" class="btn btn-primary" value="物品借用情形"onclick="location.href=\'view/rsv/object_reservation_v.php\'">
      </div>
    </div>';
    }
    return $func;
  }

  public static function Notice_board($dir, $speed, $text)
  {
    return '<marquee direction="' . $dir . '" scrollamount="' . $speed . '">' . $text . '</marquee>';
  }


  public static function option()
  {
    if (isset($_SESSION['level'])) {
      if ($_SESSION['level'] == 'user') {
        return '';
      } else if ($_SESSION['level'] == 'admin') {
        return '';
      }
    }
  }


}