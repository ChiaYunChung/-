<?php

class Header
{
  public static function header()
  {
    return '<!DOCTYPE html>
    <html>    
    <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!--data table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title><?php echo $str; ?></title>
    </head>
    <body>
    
    <main>';
  }
  public static function nav()
  {
    $str = 1;
    
    if(isset($_SESSION['level']))
      $str = $_SESSION['level'];

    if($str=='user')
    {
        $header = '<div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">借用系統</span>
          </a>
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link">嗨，'.$_SESSION['name'].' </a></li>
            <li class="nav-item"><a href="../index.php" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="../view/other/bad.php" class="nav-link">違規</a></li>
            <li class="nav-item"><a href="../index.php?logout=true;" class="nav-link">登出</a></li>
          </ul>
        </header>
        </div>';
    }
    else if($str=='admin')
    {
      $header = '<div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">  
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">借用系統</span>
          </a>
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link">嗨，'.$_SESSION['name'].' </a></li>
            <li class="nav-item"><a href="../index.php" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="../view/other/bad.php" class="nav-link">違規</a></li>
            <li class="nav-item"><a href="../index.php?logout=true;" class="nav-link">登出</a></li>
          </ul>
        </header>
        </div>';
    }
    else
    {
      $header = '<div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">借用系統</span>
          </a>
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link">嗨，訪客 </a></li>
            <li class="nav-item"><a href="../index.php" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="../view/other/bad.php" class="nav-link">違規</a></li>
            <li class="nav-item"><a href="../index.html" class="nav-link">登入/註冊</a></li>
          </ul>
        </header>
        </div>';
    }
    return $header; 
  }

  public static function ddnav()
  {
    $str = 1;
    
    if(isset($_SESSION['level']))
      $str = $_SESSION['level'];

    if($str=='user')
    {
        $header = '<div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">借用系統</span>
          </a>
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link">嗨，'.$_SESSION['name'].' </a></li>
            <li class="nav-item"><a href="../index_user.php" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="../bad.php" class="nav-link">違規</a></li>
            <li class="nav-item"><a href="../index.php?logout=true;" class="nav-link">登出</a></li>
          </ul>
        </header>
        </div>';
    }
    else if($str=='admin')
    {
      $header = '<div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">  
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">借用系統</span>
          </a>
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link">嗨，'.$_SESSION['name'].' </a></li>
            <li class="nav-item"><a href="../index_mgr.php" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="../bad.php" class="nav-link">違規</a></li>
            <li class="nav-item"><a href="../index.php?logout=true;" class="nav-link">登出</a></li>
          </ul>
        </header>
        </div>';
    }
    else
    {
      $header = '<div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">借用系統</span>
          </a>
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link">嗨，訪客 </a></li>
            <li class="nav-item"><a href="../index.php" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="../bad.php" class="nav-link">違規</a></li>
            <li class="nav-item"><a href="../index.html" class="nav-link">登入/註冊</a></li>
          </ul>
        </header>
        </div>';
    }
    return $header; 
  }
  /*
  <marquee direction="right" scrollamount="20" BEHAVIOR="ALTERNATE">哈哈哈哈哈哈ㄚ哈ㄚㄚ哈哈哈阿哈哈</marquee>
  <marquee width="66%" direction="up" scrollamount="5"  bgcolor=”#AA4444”>打錯了捏打錯了捏打錯了捏灰熊摳連</marquee>
    方向設定：direction="參數值"；可設定 1.up（向上）、2.dun（向下）、3.left（向左）、4.right（向右）。
    速度設定：scrollamount="參數值" ；可設定為數字，通常設定 1~10 的範圍，數字越大跑得越快。
    行為設定：behavior="參數值"；可設定 1.alternate（來回跑）
    背景顏色：bgcolor="參數值"；可設定為顏色的色碼，不設定則沒有顏色
    內容
  */
  public static function Notice_board($size,$dir,$speed,$beh,$color,$text)
  {
    switch ($size) 
    { 
      case null : $size = 4;
          break ;
    }
    switch ($dir) 
    { 
      case '1' : $dir='up';
          break ;
      case '2' : $dir='down';
         break ;
      case '3' : $dir='left';
          break ;
      case '4' : $dir='right';
         break ;
      default : return '錯誤！';
    }
    switch ($beh) 
    { 
      case '1' : $beh='alternate';
          break ;
      case '2' : $beh='slide';
          break ;
      default : $beh='';
    }
    switch ($color) 
    { 
      case null : $color='';
          break ;
      default : $color='#'.$color;
    }
    return '<font size='.$size.'><marquee  onMouseOver="this.stop()" onMouseOut="this.start()" direction="'.$dir.'" scrollamount="'.$speed.'" behavior="'.$beh.'" bgcolor="'.$color.'" >'.$text.'</marquee></font>';
  }

  public static function option()
  {
    if(isset($_SESSION['level']))
    {
      if($_SESSION['level']=='user')
      {
        return'';
      }
      else if($_SESSION['level']=='admin')
      {
        return '';
      }
    }
    
  }
  
  public static function showNtc()
  {
    if(isset($_POST["Ntc"])) $ntc = $_POST["Ntc"];
    if ($ntc) 
    {
        $DestDIR="upload";
        if(!is_dir($DestDIR) || !is_writeable($DestDIR))
            die("目錄不存在或無法寫入 ");
        $file_path = './upload/'.'Ntc.txt';

        $fp = fopen($file_path, 'w');
        fwrite($fp, $ntc);  
        fclose($fp);
        $file_arr = file($file_path);//逐行讀取檔案內容
        for($i = 0; $i < count($file_arr); $i++)
        {
            $Ntxt[$i] = explode(",", $file_arr[$i]);//字串轉陣列 以","分割
        }
        for($i=0;$i<count($Ntxt);$i++)
        {
            for($j=0;$j<6;$j++)
            {
                if($Ntxt[$i][$j]==null)
                {
                    $Ntxt[$i][$j]='';
                }
                $notice = Header::Notice_board($Ntxt[$i][0],$Ntxt[$i][1],$Ntxt[$i][2],$Ntxt[$i][3],$Ntxt[$i][4],$Ntxt[$i][5]); 
            } 
            echo $notice;
      } 
    }
  }
}
