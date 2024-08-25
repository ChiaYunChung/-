<?php
require_once('../../model/Department.php');
//預約紀錄的表單來源
function dname($did)
{
    $dname = Department::find_name_by_id($did);
    $dname = $dname['name'];
    return $dname;
}
function user_t($rec) //使用者個人預約
{
    echo '<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>借用人學號</th>
            <th>借用單位</th>
            <th>借用教室</th>
            <th>借用物品</th>
            <th>時段</th>
            <th>用途</th>
            <th>備註</th>
            <th>刪除(本人)</th>
        </tr>
    </thead>';
    foreach ($rec as $sin) { //<td>'. $sin['review_state'] .'</td>
        echo '<tr>
                    <td>' . $sin['user_id'] . '</td>
                    <td>' . dname($sin['d_id']) . '</td>
                    <td>' . $sin['c_id'] . '</td>
                    <td>' . $sin['object'] . '</td>
                    <td>' . $sin['start_time'] . '<br> - <br>' . $sin['end_time'] . '</td>
                    <td>' . $sin['activity'] . '</td>
                    <td>' . $sin['note'] . '</td>
                    
                    <td>
                       ';
                       if($sin['review_state']==0)
                       echo '<a href="../../control/rsvget.php?cancel=' . $sin['id'] . '">
                        <button type="button" class="btn btn-primary">取消預約</button>
                        </a>';
                        else
                        echo '<button type="button" class="btn btn-primary">取消預約請洽系辦<br>（Line, FB 或親洽）</button>';
                    echo'</td>
                </tr>';
    }
    echo '
                </tbody>
                <tfoot>
                <tr>
                <th>借用人學號</th>
                <th>借用單位</th>
                <th>借用教室</th>
                <th>借用物品</th>
                <th>時段</th>
                <th>用途</th>
                <th>備註</th>
                <th>刪除(本人)</th>
            </tr>
                </tfoot>
            </table>';
}

function user_t_o($rec) //使用者個人預約
{
    echo '<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>借用人學號</th>
            <th>借用單位</th>
            <th>借用物品</th>
            <th>時段</th>
            <th>用途</th>
            <th>備註</th>
            <th>刪除(本人)</th>
        </tr>
    </thead>';
    foreach ($rec as $sin) { //<td>'. $sin['review_state'] .'</td>
        echo '<tr>
                    <td>' . $sin['user_id'] . '</td>
                    <td>' . dname($sin['d_id']) . '</td>
                    <td>' . $sin['object'] . '</td>
                    <td>' . $sin['start_time'] . '<br> - <br>' . $sin['end_time'] . '</td>
                    <td>' . $sin['activity'] . '</td>
                    <td>' . $sin['note'] . '</td>
                    <td>
                    ';
                    if($sin['review_state']==0)
                    echo '<a href="../../control/rsvget.php?cancel_o=' . $sin['id'] . '">
                     <button type="button" class="btn btn-primary">取消預約</button>
                     </a>';
                     else
                     echo '<button type="button" class="btn btn-primary">取消預約請洽系辦<br>（Line, FB 或親洽）</button>';
                 echo'</td>
             </tr>';
    }
    echo '
        </tbody>
            <tfoot>
                <tr>
                    <th>借用人學號</th>
                    <th>借用單位</th>
                    <th>借用物品</th>
                    <th>時段</th>
                    <th>用途</th>
                    <th>備註</th>
                    <th>刪除(本人)</th>
                </tr>
            </tfoot>
        </table>';
}

function user_ta($rec) //目前所有預約情況（無權限）
{
    echo '<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
        <th>序號</th>
            <th>借用人學號</th>
            <th>借用單位</th>
            <th>借用教室</th>
            <th>借用物品</th>
            <th>時段</th>
            <th>用途</th>
            <th>備註</th>
            <th>狀態</th>
        </tr>
    </thead>';
    foreach ($rec as $sin) { //
        if ($sin['review_state'] == -3 || $sin['review_state'] == -2 || $sin['review_state'] == 1)
            continue; //不顯示
        else {
            echo '<tr>
            <td>' . $sin['id'] . '</td>
                    <td>' . $sin['user_id'] . '</td>
                    <td>' . dname($sin['d_id']) . '</td>
                    <td>' . $sin['c_id'] . '</td>
                    <td>' . $sin['object'] . '</td>
                    <td>' . $sin['start_time'] . '<br> - <br>' . $sin['end_time'] . '</td>
                    <td>' . $sin['activity'] . '</td>
                    <td>' . $sin['note'] . '</td>
                    <td>';
            if ($sin['review_state'] == 0)
                echo '未審核';
            else if ($sin['review_state'] == 1)
                echo '已歸還';
            else if ($sin['review_state'] == 2)
                echo '未歸還 / 審核中';
            else if ($sin['review_state'] == -1)
                echo '歸還失敗：<br>' . $sin['review_comment'];
            else if ($sin['review_state'] == -2)
                echo '取消';
            else if ($sin['review_state'] == -3)
                echo '預約失敗：<br>' . $sin['review_comment'];
            echo '</td>

                </tr>';
        }
    }
    echo '
                </tbody>
                <tfoot>
                <tr>
                <th>序號</th>
                <th>借用人學號</th>
                <th>借用單位</th>
                <th>借用教室</th>
                <th>借用物品</th>
                <th>時段</th>
                <th>用途</th>
                <th>備註</th>
                <th>狀態</th>
            </tr>
                </tfoot>
            </table>';

}

function user_ta_o($rec) //目前所有預約情況（無權限）
{
    echo '<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
        <th>序號</th>
            <th>借用人學號</th>
            <th>借用單位</th>
        <th>借用物品</th>
            <th>時段</th>
            <th>用途</th>
            <th>備註</th>
            <th>狀態</th>
        </tr>
    </thead>';
    foreach ($rec as $sin) { //
        if ($sin['review_state'] == -3 || $sin['review_state'] == -2 || $sin['review_state'] == 1)
            continue; //不顯示
        else {
            echo '<tr>
            <td>' . $sin['id'] . '</td>
                    <td>' . $sin['user_id'] . '</td>
                    <td>' . dname($sin['d_id']) . '</td>
                    <td>' . $sin['object'] . '</td>
                    <td>' . $sin['start_time'] . '<br> - <br>' . $sin['end_time'] . '</td>
                    <td>' . $sin['activity'] . '</td>
                    <td>' . $sin['note'] . '</td>
                    <td>';
            if ($sin['review_state'] == 0)
                echo '未審核';
            else if ($sin['review_state'] == 1)
                echo '已歸還';
            else if ($sin['review_state'] == 2)
                echo '未歸還 / 審核中';
            else if ($sin['review_state'] == -1)
                echo '歸還失敗：<br>' . $sin['review_comment'];
            else if ($sin['review_state'] == -2)
                echo '取消';
            else if ($sin['review_state'] == -3)
                echo '預約失敗：<br>' . $sin['review_comment'];
            echo '</td>

                </tr>';
        }
    }
    echo '
                </tbody>
                <tfoot>
                <tr>
                    <th>序號</th>
                    <th>借用人學號</th>
                    <th>借用單位</th>
                    <th>借用物品</th>
                    <th>時段</th>
                    <th>用途</th>
                    <th>備註</th>
                    <th>狀態</th>
            </tr>
                </tfoot>
            </table>';

}

function ad_t($rec) //審核歸還
{
    echo '<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
        <th>序號</th>
            <th>借用人學號</th>
            <th>借用單位</th>
            <th>借用教室</th>
            <th>借用物品</th>
            <th>時段</th>
            <th>用途</th>
            <th>備註</th>
            <th>回覆</th>
            <th></th>
            <th>檢查</th>
        </tr>
    </thead>';

    foreach ($rec as $sin) {
        echo '<tr>
            <td>' . $sin['id'] . '</td>
                    <td>' . $sin['user_id'] . '</td>
                    <td>' . dname($sin['d_id']) . '</td>
                    <td>' . $sin['c_id'] . '</td>
                    <td>' . $sin['object'] . '</td>
                    <td>' . $sin['start_time'] . '<br> - <br>' . $sin['end_time'] . '</td>
                    <td>' . $sin['activity'] . '</td>
                    <td>' . $sin['note'] . '</td>
                    <td colspan="2">
                    <form action="../../control/rsvget.php" method="post"> '; ////傳送回覆內容
        echo '
                    <div class="input-group">
                    <input name="id" value="' . $sin['id'] . '" hidden>
                    <input name="type" value="ccmt" hidden>
                        <textarea class="form-control" aria-label="With textarea" name="cmt">' . $sin['review_comment'] . '</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">儲存</button>
                </td>
                </form>
                <td>
                <a href="../../control/rsvget.php?type=cfail&id=' . $sin['id'] . '">
                    <button type="button" class="btn btn-primary">失敗</button>
                    </a>
                    <a href="../../control/rsvget.php?type=cfin&id=' . $sin['id'] . '">
                    <button type="button" class="btn btn-primary">完成</button>
                    </a>
                </td>

                </tr>';
    }
    echo '
                </tbody>
                <tfoot>
                <tr>
                <th>序號</th>
                <th>借用人學號</th>
                <th>借用單位</th>
                <th>借用教室</th>
                <th>借用物品</th>
                <th>時段</th>
                <th>用途</th>
                <th>備註</th>
                <th>回覆</th>
                <th></th>
                <th>檢查</th>
            </tr>
                </tfoot>
            </table>';
    
}

function ad_t2($rec) //審核預約
{
    echo '<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
        <th>序號</th>
            <th>借用人學號</th>
            <th>借用單位</th>
            <th>借用教室</th>
            <th>借用物品</th>
            <th>時段</th>
            <th>用途</th>
            <th>備註</th>
            <th>回覆</th>
            <th>檢查</th>
        </tr>
    </thead>';
    /*<button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">不OK</button>*/
    foreach ($rec as $sin) {
        echo '<tr>
            <td>' . $sin['id'] . '</td>
                    <td>' . $sin['user_id'] . '</td>
                    <td>' . dname($sin['d_id']) . '</td>
                    <td>' . $sin['c_id'] . '</td>
                    <td>' . $sin['object'] . '</td>
                    <td>' . $sin['start_time'] . '<br> - <br>' . $sin['end_time'] . '</td>
                    <td>' . $sin['activity'] . '</td>
                    <td>' . $sin['note'] . '</td>
                    <form action="../../control/rsvget.php" method="post">
                    <td>
                        <div class="input-group">
                        <input name="id" value="' . $sin['id'] . '" hidden>
                        <input name="user_id" value="' . $sin['user_id'] . '" hidden>
                        <input name="type" value="ccmt" hidden>
                            <textarea class="form-control" aria-label="With textarea" name="cmt">' . $sin['review_comment'] . '</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">儲存</button>
                    </td>
                    <td>
                        <a href="../../control/rsvget.php?id=' . $sin['id'] . '&type=cok">
                            <button type="button" class="btn btn-primary">完成</button>
                        </a>
                        <a href="../../control/rsvget.php?type=cnok&id='.$sin['id'] . '&user_id='. $sin['user_id']. '&cmt='. $sin['review_comment'].'">
                        <button type="button" class="btn btn-primary">失敗</button>
                    </td>
                    </form>
                    </tr>';
    }
    echo '
                </tbody>
                <tfoot>
                <tr>
                <th>序號</th>
                <th>借用人學號</th>
                <th>借用單位</th>
                <th>借用教室</th>
                <th>借用物品</th>
                <th>時段</th>
                <th>用途</th>
                <th>備註</th>
                <th>回覆</th>
                <th>檢查</th>
            </tr>
                </tfoot>
            </table>';

    echo '<form action="mail.php" method="post">
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
                            <a href="mail.php?id=' . '">
                                <button type="submit" class="btn btn-primary" name="Send">Send message</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>';

}

function ad_t_o($rec) //審核歸還
{
    echo '<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
        <th>序號</th>
        <th>借用人學號</th>
        <th>借用單位</th>
        <th>借用物品</th>
        <th>時段</th>
        <th>用途</th>
        <th>備註</th>
            <th>回覆</th>
            <th></th>
            <th>檢查</th>
        </tr>
    </thead>';

    foreach ($rec as $sin) {
        echo '<tr>
            <td>' . $sin['id'] . '</td>
                    <td>' . $sin['user_id'] . '</td>
                    <td>' . dname($sin['d_id']) . '</td>
                    <td>' . $sin['object'] . '</td>
                    <td>' . $sin['start_time'] . '<br> - <br>' . $sin['end_time'] . '</td>
                    <td>' . $sin['activity'] . '</td>
                    <td>' . $sin['note'] . '</td>
                    <td colspan="2">
                    <form action="../../control/rsvget.php" method="post"> '; ////傳送回覆內容
        echo '
                    <div class="input-group">
                    <input name="id" value="' . $sin['id'] . '" hidden>
                    <input name="type" value="ccmt_o" hidden>
                        <textarea class="form-control" aria-label="With textarea" name="cmt_o">' . $sin['review_comment'] . '</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">儲存</button>
                </td>
                </form>
                <td>
                <a href="../../control/rsvget.php?type=cfail_o&id=' . $sin['id'] . '">
                    <button type="button" class="btn btn-primary">失敗</button>
                    </a>
                    <a href="../../control/rsvget.php?type=cfin_o&id=' . $sin['id'] . '">
                    <button type="button" class="btn btn-primary">完成</button>
                    </a>
                </td>

                </tr>';
    }
    echo '
                </tbody>
                <tfoot>
                <tr>
                <th>序號</th>
                <th>借用人學號</th>
                    <th>借用單位</th>
                    <th>借用物品</th>
                    <th>時段</th>
                    <th>用途</th>
                    <th>備註</th>
                <th>回覆</th>
                <th></th>
                <th>檢查</th>
            </tr>
                </tfoot>
            </table>';

}

function ad_okt($rec) //審核預約
{
    echo '<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
        <th>序號</th>
            <th>借用人學號</th>
            <th>借用單位</th>
            <th>借用教室</th>
            <th>借用物品</th>
            <th>時段</th>
            <th>用途</th>
            <th>備註</th>
            <th>不同意理由（寄信通知）</th>
            <th>審核</th>
        </tr>
    </thead>';
    /*<button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">不OK</button>*/
    foreach ($rec as $sin) {
        echo '<tr>
            <td>' . $sin['id'] . '</td>
                    <td>' . $sin['user_id'] . '</td>
                    <td>' . dname($sin['d_id']) . '</td>
                    <td>' . $sin['c_id'] . '</td>
                    <td>' . $sin['object'] . '</td>
                    <td>' . $sin['start_time'] . '<br> - <br>' . $sin['end_time'] . '</td>
                    <td>' . $sin['activity'] . '</td>
                    <td>' . $sin['note'] . '</td>
                    <form action="../../control/rsvget.php" method="post">
                    <td>
                        <div class="input-group">
                        <input name="id" value="' . $sin['id'] . '" hidden>
                        <input name="user_id" value="' . $sin['user_id'] . '" hidden>
                        <input name="type" value="ccmt" hidden>
                            <textarea class="form-control" aria-label="With textarea" name="cmt">' . $sin['review_comment'] . '</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">儲存</button>
                    </td>
                    <td>
                        <a href="../../control/rsvget.php?id=' . $sin['id'] . '&type=cok">
                            <button type="button" class="btn btn-primary">同意預約</button>
                        </a>
                        <a href="../../control/rsvget.php?type=cnok&id='.$sin['id'] . '&user_id='. $sin['user_id']. '&cmt='. $sin['review_comment'].'">
                        <button type="button" class="btn btn-primary">不同意預約</button>
                    </td>
                    </form>
                    </tr>';
    }
    echo '
                </tbody>
                <tfoot>
                <tr>
                <th>序號</th>
                <th>借用人學號</th>
                <th>借用單位</th>
                <th>借用教室</th>
                <th>借用物品</th>
                <th>時段</th>
                <th>用途</th>
                <th>備註</th>
                <th>審核</th>
            </tr>
                </tfoot>
            </table>';

    echo '<form action="mail.php" method="post">
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
                            <a href="mail.php?id=' . '">
                                <button type="submit" class="btn btn-primary" name="Send">Send message</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>';

}

function ad_okt_o($rec) //審核預約
{
    echo '<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
        <th>序號</th>
        <th>借用人學號</th>
        <th>借用單位</th>
        <th>借用物品</th>
        <th>時段</th>
        <th>用途</th>
        <th>備註</th>
            <th>不同意理由（寄信通知）</th>
            <th>審核</th>
        </tr>
    </thead>';
    /*<button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">不OK</button>*/
    foreach ($rec as $sin) {
        echo '<tr>
            <td>' . $sin['id'] . '</td>
                    <td>' . $sin['user_id'] . '</td>
                    <td>' . dname($sin['d_id']) . '</td>
                    <td>' . $sin['object'] . '</td>
                    <td>' . $sin['start_time'] . '<br> - <br>' . $sin['end_time'] . '</td>
                    <td>' . $sin['activity'] . '</td>
                    <td>' . $sin['note'] . '</td>
                    <form action="../../control/rsvget.php" method="post">
                    <td>
                        <div class="input-group">
                        <input name="id" value="' . $sin['id'] . '" hidden>
                        <input name="user_id" value="' . $sin['user_id'] . '" hidden>
                        <input name="type" value="ccmt_o" hidden>
                            <textarea class="form-control" aria-label="With textarea" name="cmt_o">' . $sin['review_comment'] . '</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">儲存</button>
                    </td>
                    <td>
                        <a href="../../control/rsvget.php?id=' . $sin['id'] . '&type=cok_o">
                            <button type="button" class="btn btn-primary">同意預約</button>
                        </a>
                        <a href="../../control/rsvget.php?type=cnok_o&id='.$sin['id'] . '&user_id='. $sin['user_id']. '&cmt_o='. $sin['review_comment'].'">
                        <button type="button" class="btn btn-primary">不同意預約</button>
                    </td>
                    </form>
                    </tr>';
    }
    echo '
                </tbody>
                <tfoot>
                <tr>
                <th>序號</th>
                <th>借用人學號</th>
                    <th>借用單位</th>
                    <th>借用物品</th>
                    <th>時段</th>
                    <th>用途</th>
                    <th>備註</th>
                <th>審核</th>
            </tr>
                </tfoot>
            </table>';

    echo '<form action="mail.php" method="post">
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
                            <a href="mail.php?id=' . '">
                                <button type="submit" class="btn btn-primary" name="Send">Send message</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>';

}

function ad_showt($rec) //顯示所有預約紀錄
{
    echo '<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
        <th>序號</th>
            <th>借用人學號</th>
            <th>借用單位</th>
            <th>借用教室</th>
            <th>借用物品</th>
            <th>時段</th>
            <th>用途</th>
            <th>備註</th>
            <th>審核</th>
        </tr>
    </thead>';

    foreach ($rec as $sin) { //
        echo '<tr>
            <td>' . $sin['id'] . '</td>
                    <td>' . $sin['user_id'] . '</td>
                    <td>' . dname($sin['d_id']) . '</td>
                    <td>' . $sin['c_id'] . '</td>
                    <td>' . $sin['object'] . '</td>
                    <td>' . $sin['start_time'] . '<br> - <br>' . $sin['end_time'] . '</td>
                    <td>' . $sin['activity'] . '</td>
                    <td>' . $sin['note'] . '</td>
                    <td>';
        if ($sin['review_state'] == 0)
            echo '未審核';
        else if ($sin['review_state'] == 1)
            echo '已歸還';
        else if ($sin['review_state'] == 2)
            echo '未歸還 / 審核中';
        else if ($sin['review_state'] == -1)
            echo '失敗：<br>' . $sin['review_comment'];
        else if ($sin['review_state'] == -2)
            echo '取消';
        else if ($sin['review_state'] == -3)
            echo '預約失敗：<br>' . $sin['review_comment'];
        echo '</td>

                </tr>';
    }
    echo '
                </tbody>
                <tfoot>
                <tr>
                <th>序號</th>
                <th>借用人學號</th>
                <th>借用單位</th>
                <th>借用教室</th>
                <th>借用物品</th>
                <th>時段</th>
                <th>用途</th>
                <th>備註</th>
                <th>審核</th>
            </tr>
                </tfoot>
            </table>';

}

function ad_showt_o($rec) //顯示所有預約紀錄
{
    echo '<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
        <th>序號</th>
        <th>借用人學號</th>
        <th>借用單位</th>
        <th>借用物品</th>
        <th>時段</th>
        <th>用途</th>
        <th>備註</th>
            <th>審核</th>
        </tr>
    </thead>';

    foreach ($rec as $sin) { //
        echo '<tr>
            <td>' . $sin['id'] . '</td>
                    <td>' . $sin['user_id'] . '</td>
                    <td>' . dname($sin['d_id']) . '</td>
                    <td>' . $sin['object'] . '</td>
                    <td>' . $sin['start_time'] . '<br> - <br>' . $sin['end_time'] . '</td>
                    <td>' . $sin['activity'] . '</td>
                    <td>' . $sin['note'] . '</td>
                    <td>';
        if ($sin['review_state'] == 0)
            echo '未審核';
        else if ($sin['review_state'] == 1)
            echo '已歸還';
        else if ($sin['review_state'] == 2)
            echo '未歸還 / 審核中';
        else if ($sin['review_state'] == -1)
            echo '失敗：<br>' . $sin['review_comment'];
        else if ($sin['review_state'] == -2)
            echo '取消';
        else if ($sin['review_state'] == -3)
            echo '預約失敗：<br>' . $sin['review_comment'];
        echo '</td>

                </tr>';
    }
    echo '
                </tbody>
                <tfoot>
                <tr>
                <th>序號</th>
                <th>借用人學號</th>
                    <th>借用單位</th>
                    <th>借用物品</th>
                    <th>時段</th>
                    <th>用途</th>
                    <th>備註</th>
                <th>審核</th>
            </tr>
                </tfoot>
            </table>';

}
