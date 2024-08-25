<?php
//所有個人紀錄
require_once('../Header.php');
require_once('../../model/Classroom.php');
require_once('../../model/Classroom_rsv.php');
require_once('../../model/Object.php');
require_once('../../model/Object_rsv.php');
require_once('tables.php');
session_start();
$header = Header::ddnav();
if (!isset($_SESSION['level'])) {
    header('Location: ../../index.php');
  }  
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>所有個人紀錄</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../assets/table.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <?php echo $header; ?>
        <br>
        <?php
        echo '<br><div class="mid">
            <h2>所有個人紀錄</h2>
            <hr></div><br>';

        if (isset($_SESSION['level'])) {
            if ($_SESSION['level'] == 'user' || $_SESSION['level'] == 'admin') {
                if (isset($_SESSION['id'])) {
                    $rec = Classroom_rsv::find_by_id_a($_SESSION['id']);
                    echo '<br><div class="mid">
                            <h3>教室預約紀錄</h3>
                            <hr>
                        </div><br>';
                    user_ta($rec);

                    $rec = Object_rsv::find_by_id_a($_SESSION['id']);
                    echo '<br><div class="mid">
                            <h3>物品預約紀錄</h3>
                            <hr>
                        </div><br>';
                    user_ta_o($rec);
                }
            }
        } ?>
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