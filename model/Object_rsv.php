<?php
require_once('Connection.php');
require_once('Object.php');
date_default_timezone_set('asia/Taipei');
class Object_rsv
{
    private ?int $id = null; //預設
    private string $object;
    private int $d_id;
    private string $user_id;
    private string $start_time;
    private string $end_time;
    private ?string $timestamp = null; //預設
    private string $activity;
    private string $note;
    private string $review_state;
    private string $review_comment;
    public function __construct()
    {
    }

    public static function create($d_id, $user_id, $start_time, $end_time, $object, $activity, $note)
    {
        $obj = new Object_rsv();
        $obj->d_id = $d_id;
        $obj->user_id = $user_id;
        $obj->start_time = $start_time;
        $obj->end_time = $end_time;
        $obj->object = $object;
        $obj->activity = htmlspecialchars($activity);
        $obj->note = htmlspecialchars($note);
        $obj->review_state = 0;
        $obj->review_comment = "";
        $obj->register();
        return $obj;
    }

    public function register()
    {
        $conn = Connection::connect();
        $sql = "INSERT INTO `object_rsv`( `object`, `d_id`, `user_id`, `start_time`, `end_time`, `activity`, `note`, `review_state`, `review_comment`)
                 VALUES (:object, :d_id,:user_id,:start_time,:end_time,:activity, :note, :review_state,:review_comment)";     # should add update option
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $response = $conn->prepare($sql);
        $response->bindParam(':d_id', $this->d_id);
        $response->bindParam(':user_id', $this->user_id);
        $response->bindParam(':start_time', $this->start_time);
        $response->bindParam(':end_time', $this->end_time);
        $response->bindParam(':object', $this->object);
        $response->bindParam(':activity', $this->activity);
        $response->bindParam(':note', $this->note);
        $response->bindParam(':review_state', $this->review_state);
        $response->bindParam(':review_comment', $this->review_comment);
        $str = '新增物品借用';
        //echo $str;
        Connection::exe($response, $str);
    }

    public static function find_by_id($id, $s){ //使用者以狀態(s)查詢預約  	審核狀態 0:未審核 / 1:通過 / 2:未完成 / -1:失敗 / -2:取消 	
        $conn = Connection::connect();
        $sql = "SELECT * FROM `object_rsv` WHERE `user_id`=? and `review_state`=? ORDER BY `start_time` DESC, `id` ASC";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(1, $id);
        $response->bindParam(2, $s);
        $response = Connection::exe($response, '尋找');
        $object = $response->fetchall(PDO::FETCH_ASSOC);
        return $object;
    }

    public static function finds_by_id($id){ //以id找到單筆預約資料
        $conn = Connection::connect();
        $sql = "SELECT * FROM `object_rsv` WHERE `id`=?";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(1, $id);
        $response = Connection::exe($response, '尋找');
        $object = $response->fetch(PDO::FETCH_ASSOC);
        return $object;
    }

    public static function ad_find_by_id($s){//管理員依狀態查詢預約
        $conn = Connection::connect();
        $sql = "SELECT * FROM `object_rsv` WHERE `review_state`=? ORDER BY `start_time` DESC, `id` ASC";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(1, $s);
        $response = Connection::exe($response, '尋找');
        $object = $response->fetchall(PDO::FETCH_ASSOC);
        return $object;
    }

    public static function ad_find_by_a(){//查詢所有預約紀錄
        $conn = Connection::connect();
        $sql = "SELECT * FROM `object_rsv` ORDER BY `start_time` DESC, `id` ASC";     # should add update option
        $response = $conn->prepare($sql);
        $response = Connection::exe($response, '尋找');
        $object = $response->fetchall(PDO::FETCH_ASSOC);
        return $object;
    }

    public static function find_by_id_a($id){//未審核
        $conn = Connection::connect();
        $sql = "SELECT * FROM `object_rsv` WHERE `user_id`=? ORDER BY `start_time` DESC, `id` ASC";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(1, $id);
        $response = Connection::exe($response, '尋找');
        $object = $response->fetchall(PDO::FETCH_ASSOC);
        return $object;
    }

    public static function find_d($d_id)
        {
            $conn = Connection::connect();
            $sql = "SELECT `name` FROM `department_mng` WHERE `id`=? ";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $d_id);
            $response = Connection::exe($response, '尋找');
            $d = $response->fetch(PDO::FETCH_ASSOC);
            //print_r($object); Array ( [id] => 104 )
            return $d;
        }

        public static function cancel($id){ //本人取消
            $conn = Connection::connect();
            $sql = "UPDATE `object_rsv` SET `review_state`=-2 WHERE `id`=?";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $id);
            $response = Connection::exe($response, '取消');
            $object = $response->fetchall(PDO::FETCH_ASSOC);
            return $object;
        }
        public static function review($id, $s){ //改變狀態（自訂）
            $conn = Connection::connect();
            $sql = "UPDATE `object_rsv` SET `review_state`=? WHERE `id`=?";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $s);
            $response->bindParam(2, $id);
            $response = Connection::exe($response, '取消');
            $object = $response->fetchall(PDO::FETCH_ASSOC);
            return $object;
        }

        public static function review_com($id, $s){ //更新回覆
            $conn = Connection::connect();
            $sql = "UPDATE `object_rsv` SET `review_comment`=? WHERE `id`=?";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $s);
            $response->bindParam(2, $id);
            $response = Connection::exe($response, '取消');
            $object = $response->fetchall(PDO::FETCH_ASSOC);
            return $object;
        }

    /* public function update($fid)
     {
         $conn = Connection::connect();
         $sql = "UPDATE `obj_mng` SET `id`=:id,`c_type`=:c_type,`c_key`=:c_key,`ac_remote`=:ac_remote,`projector_remote`=:projector_remote,`act`=:act WHERE `id`=:fid";     # should add update option
         $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
         $response = $conn->prepare($sql);
         $response->bindParam(':id',$this->id);
         $response->bindParam(':c_type',$this->c_type);
         $response->bindParam(':c_key',$this->c_key);
         $response->bindParam(':ac_remote',$this->ac_remote);
         $response->bindParam(':projector_remote',$this->projector_remote);
         $response->bindParam(':act',$this->act);
         $response->bindParam(':fid',$fid);
         $str = '更新教室';
         Connection::exe($response, $str);
     }

     public static function find_by_id($id)
     {
         $conn = Connection::connect();
         $sql = "SELECT * FROM `obj_mng` WHERE `id`=? ";     # should add update option
         $response = $conn->prepare($sql);
         $response->bindParam(1, $id);
         $respons = Connection::exe($response, '尋找');
         $obj = $response->fetch(PDO::FETCH_ASSOC);
         return $obj;
     }*/
}
?>