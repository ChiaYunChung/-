<?php
    require_once('Connection.php');
    date_default_timezone_set('asia/Taipei');
    class Classroom
    {
        private int $id;
        private string $c_type;
        private int $c_key;
        private int $ac_remote;
        private int $projector_remote;
        private int $act;
        public function __construct()
        {
            
        }
        public static function create($id, $c_type, $c_key, $ac_remote, $projector_remote)
        {
            $classroom = new Classroom();
            $classroom->id = $id;
            $classroom->c_type = htmlspecialchars($c_type);
            $classroom->c_key = $c_key;
            $classroom->ac_remote = $ac_remote;
            $classroom->projector_remote = $projector_remote;
            $classroom->act = 1;
            $classroom->register();
            return $classroom;
        }
        
        public function register()
        {
            $conn = Connection::connect();
            $sql = "INSERT INTO `classroom_mng`(`id`, `c_type`, `c_key`, `ac_remote`, `projector_remote`, `act`) VALUES (:id,:c_type,:c_key,:ac_remote,:projector_remote,:act";     # should add update option
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            $response = $conn->prepare($sql);
            $response->bindParam(':id',$this->id);
            $response->bindParam(':c_type',$this->c_type);
            $response->bindParam(':c_key',$this->c_key);
            $response->bindParam(':ac_remote',$this->ac_remote);
            $response->bindParam(':projector_remote',$this->projector_remote);
            $response->bindParam(':act',$this->act);
            $str = '新增教室';
            echo $str;
            Connection::exe($response, $str);
        }
        
        public function update($fid)
        {
            $conn = Connection::connect();
            $sql = "UPDATE `classroom_mng` SET `id`=:id,`c_type`=:c_type,`c_key`=:c_key,`ac_remote`=:ac_remote,`projector_remote`=:projector_remote,`act`=:act WHERE `id`=:fid";     # should add update option
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
            $sql = "SELECT * FROM `classroom_mng` WHERE `id`=? ";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $id);
            $response = Connection::exe($response, '尋找');
            $classroom = $response->fetch(PDO::FETCH_ASSOC);
            return $classroom;
        }
        public static function find_id()
        {
            $conn = Connection::connect();
            $sql = "SELECT `id` FROM `classroom_mng` WHERE `act`=0";     # should add update option
            $response = $conn->prepare($sql);
            $response = Connection::exe($response, '尋找');
            $classroom = $response->fetchall(PDO::FETCH_ASSOC);
            //print_r($classroom); Array ( [id] => 104 )
            return $classroom;
        }
        public static function find_obj($id)
        {
            $a = '';
            $obj = Classroom::find_by_id($id);
            if(isset($obj['c_key']))
                if($obj['c_key']==1) $a = $a . ' c_key';
            if(isset($obj['ac_remote']))
            if($obj['ac_remote']==1) $a = $a . ' ac_remote';
            if(isset($obj['projector_remote']))
            if($obj['projector_remote']==1) $a = $a . ' projector_remote';
            //echo Classroom::find_obj(104); 5
            return $a;
        }
        public static function find_d()
        {
            $conn = Connection::connect();
            $sql = "SELECT * FROM `department_mng` WHERE `act`=0";     # should add update option
            $response = $conn->prepare($sql);
            $response = Connection::exe($response, '尋找');
            $d = $response->fetchall(PDO::FETCH_ASSOC);
            //print_r($classroom); Array ( [id] => 104 )
            return $d;
        }
    }
    if (isset($_GET["type"])) {
        $type = $_GET["type"];
        switch($type){    
            case "obj":
                $cid = $_POST['cid'];
                $f = Classroom::find_obj($cid);
                if($f) echo $f;
                else echo 'false';
         }       
    }
?>
