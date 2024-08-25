<?php
    require_once('Connection.php');
    require_once('Classroom.php');
    date_default_timezone_set('asia/Taipei');
    class Classroom_rsv
    {
        private ?int $id = null; //預設
        private int $c_id;
        private string $d_id;
        private string $user_id;
        private string $start_time;
        private string $end_time;
        private ?string $timestamp = null; //預設
        private $object;
        private string $activity;
        private string $note;
        private string $review_state;
        private string $review_comment;
        public function __construct()
        {
        }

        public static function create($c_id, $d_id, $user_id, $start_time, $end_time, $object, $activity, $note)
        {
            $classroom = new Classroom_rsv();
            $classroom->c_id = $c_id;
            $classroom->d_id = $d_id;
            $classroom->user_id = $user_id;
            $classroom->start_time = $start_time;
            $classroom->end_time = $end_time;
            $classroom->object = $object;
            $classroom->activity = htmlspecialchars($activity);
            $classroom->note = htmlspecialchars($note);
            $classroom->review_state = 0;
            $classroom->review_comment = "";
            $classroom->register();
            return $classroom;
        }
        
        public function register()
        {
            $conn = Connection::connect();
            $sql = "INSERT INTO `classroom_rsv`(`c_id`, `d_id`, `user_id`, `start_time`, `end_time`, `object`, `activity`, `note`, `review_state`, `review_comment`)
                 VALUES (:c_id,:d_id,:user_id,:start_time,:end_time,:obj, :activity, :note, :review_state,:review_comment)";     # should add update option
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            $response = $conn->prepare($sql);
            $response->bindParam(':c_id',$this->c_id);
            $response->bindParam(':d_id',$this->d_id);
            $response->bindParam(':user_id',$this->user_id);
            $response->bindParam(':start_time',$this->start_time);
            $response->bindParam(':end_time',$this->end_time);
            $response->bindParam(':obj',$this->object);
            $response->bindParam(':activity',$this->activity);
            $response->bindParam(':note',$this->note);
            $response->bindParam(':review_state',$this->review_state);
            $response->bindParam(':review_comment',$this->review_comment);
            $str = '新增教室借用';
            //echo $str;
            Connection::exe($response, $str);
        }
      public static function find_by_id($id, $s){ //使用者以狀態(s)查詢預約  	審核狀態 0:未審核 / 1:通過 / 2:未完成 / -1:失敗 / -2:取消 	
            $conn = Connection::connect();
            $sql = "SELECT * FROM `classroom_rsv` WHERE `user_id`=? and `review_state`=? ORDER BY `start_time` DESC, `id` ASC";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $id);
            $response->bindParam(2, $s);
            $response = Connection::exe($response, '尋找');
            $classroom = $response->fetchall(PDO::FETCH_ASSOC);
            return $classroom;
        }
        public static function finds_by_id($id){ //以id找到單筆預約資料
            $conn = Connection::connect();
            $sql = "SELECT * FROM `classroom_rsv` WHERE `id`=?";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $id);
            $response = Connection::exe($response, '尋找');
            $classroom = $response->fetch(PDO::FETCH_ASSOC);
            return $classroom;
        }

        public static function ad_find_by_id($s){//管理員依狀態查詢預約
            $conn = Connection::connect();
            $sql = "SELECT * FROM `classroom_rsv` WHERE `review_state`=? ORDER BY `start_time` DESC, `id` ASC";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $s);
            $response = Connection::exe($response, '尋找');
            $classroom = $response->fetchall(PDO::FETCH_ASSOC);
            return $classroom;
        }

        public static function ad_find_by_a(){//查詢所有預約紀錄
            $conn = Connection::connect();
            $sql = "SELECT * FROM `classroom_rsv` ORDER BY `start_time` DESC, `id` ASC";     # should add update option
            $response = $conn->prepare($sql);
            $response = Connection::exe($response, '尋找');
            $classroom = $response->fetchall(PDO::FETCH_ASSOC);
            return $classroom;
        }

        public static function find_by_id_a($id){//未審核
            $conn = Connection::connect();
            $sql = "SELECT * FROM `classroom_rsv` WHERE `user_id`=? ORDER BY `start_time` DESC, `id` ASC";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $id);
            $response = Connection::exe($response, '尋找');
            $classroom = $response->fetchall(PDO::FETCH_ASSOC);
            return $classroom;
        }

        public static function find_d($d_id)
        {
            $conn = Connection::connect();
            $sql = "SELECT `name` FROM `department_mng` WHERE `id`=? ";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $d_id);
            $response = Connection::exe($response, '尋找');
            $d = $response->fetch(PDO::FETCH_ASSOC);
            //print_r($classroom); Array ( [id] => 104 )
            return $d;
        }

        public static function cancel($id){ //本人取消
            $conn = Connection::connect();
            $sql = "UPDATE `classroom_rsv` SET `review_state`=-2 WHERE `id`=?";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $id);
            $response = Connection::exe($response, '取消');
            $classroom = $response->fetchall(PDO::FETCH_ASSOC);
            return $classroom;
        }
        public static function review($id, $s){ //改變狀態（自訂）
            $conn = Connection::connect();
            $sql = "UPDATE `classroom_rsv` SET `review_state`=? WHERE `id`=?";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $s);
            $response->bindParam(2, $id);
            $response = Connection::exe($response, '取消');
            $classroom = $response->fetchall(PDO::FETCH_ASSOC);
            return $classroom;
        }

        public static function review_com($id, $s){ //更新回覆
            $conn = Connection::connect();
            $sql = "UPDATE `classroom_rsv` SET `review_comment`=? WHERE `id`=?";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $s);
            $response->bindParam(2, $id);
            $response = Connection::exe($response, '取消');
            $classroom = $response->fetchall(PDO::FETCH_ASSOC);
            return $classroom;
        }
    }
    //print_r(Classroom_rsv::find_by_id('1102943'));
    ?>