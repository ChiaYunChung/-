<?php
session_start();
require_once('../../model/User.php');
if (isset($_SESSION['level'])) {
  header('Location: ../../index.php');
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>sign_in page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="../../assets/sign-in/signin.css" rel="stylesheet">
  <link href="../../assets/sign-in/modals.css" rel="stylesheet">
  <link href="../../assets/sign-in/headers.css" rel="stylesheet">
  <link href="../../assets/table.css" rel="stylesheet">
  <script>
    function myFunction(val) {
      var sid = document.getElementById('sid').value;
      $.ajax({
        type: 'POST',
        url: '../../model/User.php?type=update', // 指定要调用的PHP文件
        data: { sid: sid },
        success: function (response) {
          // 在请求成功时执行的回调函数
          if (response === 'true') {
            $('#sid').addClass('is-invalid');
            $('.error-message').text(' 此學號已註冊');
            $('.error-message').addClass('invalid-feedback');
            $('#submit').prop('disabled', true);
            
          } else {
            // 输入有效，移除错误样式和消息
            $('#sid').removeClass('is-invalid');
            $('.error-message').text('');
            $('#submit').prop('disabled', false);
          }
          
        }
      });
      var mail = document.getElementById('mail');
      mail.value = "s" + val + "@mail.ncyu.edu.tw";
    }
  </script>
</head>

<body>
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="../../index.php"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#bootstrap" />
        </svg>
        <span class="fs-4">借用系統</span>
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link">嗨，訪客 </a></li>
        <li class="nav-item"><a href="../../index.php" class="nav-link active" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="../other/bad.php" class="nav-link">違規</a></li>
        <li class="nav-item"><a href="#" class="nav-link">登入/註冊</a></li>
      </ul>
    </header>
  </div>

  <main>
    <form action="../../control/signinPost.php" class="form-signin" method="post">
      <div class="mid">
        <h1 class="h1 mb-3 fw-normal">登入</h1>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="學號" name="id" required="required">
        <label for="floatingInput">學號</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password"
          required="required">
        <label for="floatingPassword">密碼</label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">登入</button>
      <button type="button" class="signup w-100 btn btn-lg btn-primary" data-bs-toggle="modal"
        data-bs-target="#modalSignin">註冊</button>
    </form>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalSignin">
      <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5 shadow">
          <div class="modal-header p-5 pb-4 border-bottom-0">
            <!-- <h5 class="modal-title">Modal title</h5> -->
            <h2 class="fw-bold mb-0">註冊帳號</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-5 pt-0">
            <form class="" action="../../control/signupPost.php" method="post">
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-4" id="sname" placeholder="xxx" name="sname"
                  required="required">
                <label for="sname">姓名</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-4" id="sid" placeholder="" name="sid" required="required"
                  onchange="myFunction(this.value)">
                <label for="sid">學號</label>
                <div class="error-message"></div>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-4" id="phonenum" placeholder="09xxxxxxxx" name="phonenum"
                  required="required">
                <label for="phonenum">電話</label>
              </div>
              <div class="form-floating mb-3">
                <input type="email" class="form-control rounded-4" id="mail" placeholder="" readonly name="mail"
                  required="required">
                <label for="mail">電子郵件（自動套用學號）</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control rounded-4" id="floatingPassword" placeholder="Password"
                  name="password" required="required">
                <label for="floatingPassword">密碼</label>
              </div>
              <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" id="submit" type="submit">註冊</button>
              <button class="reset w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="reset">重設</button>
              <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>

            </form>
          </div>
        </div>
      </div>
    </div>


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <center>
      <font size="3">▶ 未驗證帳號者請先前往信箱驗證帳號</font>
      <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
    </center>
  </main>


</body>

</html>