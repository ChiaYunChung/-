<?php
require_once('../Header.php');
require_once('../../model/Classroom.php');
require_once('../../model/Object.php');
require_once('../../model/Object_rsv.php');
require_once('tables.php');
session_start();
if (isset($_SESSION['blocked'])) {
    if ($_SESSION['blocked'] != 0)
        header('Location: ../../index.php');
}
if (!isset($_SESSION['level'])) {
    header('Location: ../../index.php');
  }  
$header = Header::ddnav();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../../assets/table.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Custom styles for this template -->

    <title>物品預約</title>
</head>

<body>
    <main>
        <?php echo $header; ?>
        <br>
        <div class="mid">
            <iframe
                src="https://calendar.google.com/calendar/embed?src=8a671f0aba485533dc922489cb5104f847d6ed546438af608eb2e7602bd12efc%40group.calendar.google.com&ctz=Asia%2FTaipei"
                style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
            <!--教室借用-->
            <form action="../../control/objectrsvPost.php" method="post"
                style="margin-top:50px; margin-left:10px; flex: 1; display:inline-block; max-width:45%;">
                <table border="1" class="table table-bordered" height="550px">
                    <tr>
                        <th>
                            物品名稱：借用數量
                        </th>
                        <td>
                            <?php
                            $opt = Obj::show_obj();
                            foreach ($opt as $options) {
                                echo '<div class="form-check form-check-inline">';
                                echo '<label class="form-check-label" for="flexCheck' . $options['name'] . '">' . $options['name'] . '（共有 ' . $options['amount'] . ' 個）：' . ' </label>';
                                echo '<input oninput="isZero()" type="number" min="0" max="' . $options['amount'] . '" name="amount[][' . $options['name'] . ']" value="0">' . ' 個';
                                echo '</div><br>';
                            }
                            ?>
                            <script>
                                $(document).ready(function () {
                                    isZero();
                                });
                                function isZero() {
                                    const numberInputs = document.querySelectorAll('input[type="number"]');
                                    let allZero = true;
                                    numberInputs.forEach(input => {
                                        const inputValue = input.value;
                                        if (inputValue != 0) {
                                            allZero = false;
                                        }
                                    });
                                    if (allZero) {
                                        $('#submit').prop('disabled', true);
                                    } else {
                                        $('#submit').prop('disabled', false);
                                    }
                                }
                            </script>
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
                                print_r($opt);
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
        </div>>


        <?php
        if ($_SESSION['level'] == 'user') {
            if (isset($_SESSION['level'])) {
                if (isset($_SESSION['id'])) {
                    $rec = Object_rsv::ad_find_by_id(2);

                    echo '<br><div class="mid">
                        <h3>目前所有預約情況</h3>
                        <hr>
                    </div><br>';
                    user_ta_o($rec);

                    $rec = Object_rsv::find_by_id($_SESSION['id'], 2);
                    echo '<br><div class="mid">
                            <h3>個人目前已預約成功</h3>
                            <hr>
                        </div><br>';
                    user_t_o($rec);

                    $rec = Object_rsv::find_by_id($_SESSION['id'], 0);
                echo '<br><div class="mid">
                        <h3>個人目前等待預約審核</h3>
                        <hr>
                    </div><br>';
                user_t_o($rec);
                }

            }
        } else if ($_SESSION['level'] == 'admin') {

            if (isset($_SESSION['id'])) {
                $rec = Object_rsv::ad_find_by_id(0);

                echo '<br><div class="mid">
                            <h3>尚未審核（預約）</h3>
                            <hr>
                        </div><br>';
                ad_okt_o($rec);

                $rec = Object_rsv::ad_find_by_id(2);

                echo '<br><div class="mid">
                            <h3>尚未審核（歸還）</h3>
                            <hr>
                        </div><br>';
                ad_t_o($rec);
            }
        }
        ?>
        <form action="mail.php" method="post">
            <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">不OK</button>-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Recipient:</label>
                                    <input type="text" class="form-control" id="recipient-name" name="To">
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Message:</label>
                                    <textarea class="form-control" id="message-text" name="TextBody"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="mail.php">
                                <button type="submit" class="btn btn-primary" name="Send">Send message</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </main>
    <script>
        new DataTable('#example');
        new DataTable('#example2');
        new DataTable('#example3');

        //mail
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