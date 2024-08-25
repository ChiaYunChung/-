<?php
//教室預約
require_once('../Header.php');
require_once('../../model/Classroom.php');
require_once('../../model/Classroom_rsv.php');
require_once('../../model/Object.php');
require_once('tables.php');
session_start();
if (isset($_SESSION['blocked'])) {
    if ($_SESSION['blocked'] != 0)
        header('Location: ../index.php');
} 
if (!isset($_SESSION['level'])) {
    header('Location: ../../index.php');
  } 
$header = Header::ddnav();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>教室預約</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../assets/table.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            obj_lis($('#c_id').val());
        });
        function obj_lis(cid) {
            $.ajax({
                type: 'POST',
                url: '../../model/Classroom.php?type=obj', // 指定要调用的PHP文件
                data: { cid: cid },
                success: function (response) {
                    $("#c_key").prop('checked', false);
                    $("#ac_remote").prop('checked', false);
                    $("#projector_remote").prop('checked', false);

                    if (response.search("c_key") == -1) $('#c_keyd').hide();
                    else $('#c_keyd').show();
                    if (response.search("ac_remote") == -1) $('#ac_remoted').hide();
                    else $('#ac_remoted').show();
                    if (response.search("projector_remote") == -1) $('#projector_remoted').hide();
                    else $('#projector_remoted').show();
                }
            })
        }
    </script>
</head>

<body>
    <main>
        <?php echo $header; ?>
        <br>
        <div class="mid">
        <a href="../../assets/c.pdf"><h3>檢視班級課表</h3></a>
        </div>
        <div class="mid">
            <iframe src="https://calendar.google.com/calendar/embed?src=e342f19480de86afd2be83062370b6a6de6b076b7df3fcd67fdeeb0063598e13%40group.calendar.google.com&ctz=Asia%2FTaipei" 
                style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
            <!--教室借用-->
            <form action="../../control/classroomrsvPost.php" method="post"
                style="margin-top:50px; margin-left:10px; flex: 1; display:inline-block; max-width:45%;">
                <table border="1" class="table table-bordered" height="550px">
                    <tr>
                        <th>
                            教室編號
                        </th>
                        <td>
                            <select class="form-select" name="c_id" id="c_id" required onchange="obj_lis(this.value)">
                                <?php
                                $opt = Classroom::find_id();
                                foreach ($opt as $options) {
                                    echo '<option value="' . $options['id'] . '">' . $options['id'] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            借用單位
                        </th>
                        <th>
                            <select class="form-select" name="d" required>
                                <?php
                                $opt = Classroom::find_d();
                                foreach ($opt as $options) {
                                    echo '<option value="' . $options['id'] . '">' . $options['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            日期
                        </th>
                        <th>
                            <script>
                                $(function () {
                                    var dtToday = new Date();

                                    var month = dtToday.getMonth() + 1;
                                    var day = dtToday.getDate();
                                    var year = dtToday.getFullYear();
                                    if (month < 10)
                                        month = '0' + month.toString();
                                    if (day < 10)
                                        day = '0' + day.toString();

                                    var minDate = year + '-' + month + '-' + day;

                                    $('#date').attr('min', minDate);
                                });
                            </script>
                            <input type="date" id="date" name="date" required />
                        </th>
                    </tr>
                    <tr>
                        <th>
                            開始時段
                        </th>
                        <th>
                            <input type="time" value="06:00" min="02:00" max="22:00" id="startTime" name="startTime"
                                onchange="compareTimes()" required>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            結束時段
                        </th>
                        <th>
                            <input type="time" value="07:00" min="02:00" max="22:00" onchange="compareTimes()" required
                                id="endTime" name="endTime">
                            <script>
                                function compareTimes() {
                                    var startTime = document.getElementById('startTime').value;
                                    var endTime = document.getElementById('endTime').value;

                                    if (startTime >= endTime) {
                                        alert('開始時間不能晚於或等於結束時間');
                                        $('#submit').prop('disabled', true);

                                    } else {
                                        $('#submit').prop('disabled', false);
                                    }
                                }
                            </script>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            借用物品
                        </th>
                        <th>
                            <div class="form-check" id="ac_remoted">
                                <input class="form-check-input" type="checkbox" id="ac_remote" name="obj[]"
                                    value="冷氣遙控器">
                                <label class="form-check-label" for="ac_remote">
                                    冷氣遙控器
                                </label>
                            </div>
                            <div class="form-check" id="c_keyd">
                                <input class="form-check-input" type="checkbox" id="c_key" name="obj[]" value="鑰匙">
                                <label class="form-check-label" for="c_key">
                                    鑰匙
                                </label>
                            </div>
                            <div class="form-check" id="projector_remoted">
                                <input class="form-check-input" type="checkbox" id="projector_remote" name="obj[]"
                                    value="投影機遙控器">
                                <label class="form-check-label" for="projector_remote">
                                    投影機遙控器
                                </label>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            用途
                        </th>
                        <th>
                            <div class="input-group">
                                <textarea class="form-control" aria-label="With textarea" name="activity"
                                    required></textarea>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            備註
                        </th>
                        <th>
                            <div class="input-group">
                                <textarea class="form-control" aria-label="With textarea" name="note"></textarea>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="reset" class="btn btn-primary" style="float: right;">清除</button>

                            <button type="submit" class="btn btn-primary" style="float: right;" id='submit'>送出</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <?php
        if ($_SESSION['level'] == 'user') {
        if (isset($_SESSION['level'])) {
            if (isset($_SESSION['id'])) {
                $rec = Classroom_rsv::ad_find_by_id(2);
                echo '<br><div class="mid">
                        <h3>目前所有預約情況</h3>
                        <hr>
                    </div><br>';
                user_ta($rec);
                $rec = Classroom_rsv::find_by_id($_SESSION['id'], 2);
                echo '<br><div class="mid">
                        <h3>個人目前已預約成功</h3>
                        <hr>
                    </div><br>';
                user_t($rec);
                $rec = Classroom_rsv::find_by_id($_SESSION['id'], 0);
                echo '<br><div class="mid">
                        <h3>個人目前等待預約審核</h3>
                        <hr>
                    </div><br>';
                user_t($rec);
            }

        }
        } else if ($_SESSION['level'] == 'admin') {

            if (isset($_SESSION['id'])) {
                $rec = Classroom_rsv::ad_find_by_id(0);

                echo '<br><div class="mid">
                            <h3>尚未審核（預約）</h3>
                            <hr>
                        </div><br>';
                ad_okt($rec);
            }

            if (isset($_SESSION['id'])) {
                $rec = Classroom_rsv::ad_find_by_id(2);

                echo '<br><div class="mid">
                            <h3>尚未審核（歸還）</h3>
                            <hr>
                        </div><br>';
                ad_t2($rec);
            }

            
        }
        ?>
    </main>
    <script>
        new DataTable('#example');
        //new DataTable('#example2');
        //new DataTable('#example3');

        var exampleModal = document.getElementById('exampleModal')
        exampleModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalTitle = exampleModal.querySelector('.modal-title')
            var modalBodyInput = exampleModal.querySelector('.modal-body input')

            modalTitle.textContent = 'New message to ' + recipient
            modalBodyInput.value = recipient
        })
    </script>

</body>

</html>