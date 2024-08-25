<?php
    require_once('Connection.php');
    class Obj
    {
        private int $id;
        private string $name;
        private int $amount;
        private int $act;

        public function __construct()
        {   
        }
        public static function create($id, $name, $amount, $act)
        {
            $obj = new Obj();
            $obj->name = htmlspecialchars($name);
            $obj->amount = $amount;
            $obj->act = 0;
            $obj->register();
            return $obj;
        }
        
        public function register()
        {
            $conn = Connection::connect();
            $sql = "INSERT INTO `object_mng`(`name`, `amount`, `act`) VALUES (:name,:amount,:act)";     # should add update option
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            $response = $conn->prepare($sql);
            $response->bindParam(':name',$this->name);
            $response->bindParam(':amount',$this->amount);
            $response->bindParam(':act',$this->act);
            $str = '註冊物品';
            echo $str;
            Connection::exe($response, $str);
        }

        public static function find_by_id($id)
        {
            $conn = Connection::connect();
            $sql = "SELECT * FROM `object_mng` WHERE `id`=? ";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $id);
            $respons = Connection::exe($response, '尋找');
            $obj = $response->fetch(PDO::FETCH_ASSOC);
            return $obj;
        }
        public static function show_obj()
        {
            $conn = Connection::connect();
            $sql = "SELECT * FROM `object_mng` WHERE `act`=0";     # should add update option
            $response = $conn->prepare($sql);
            $response = Connection::exe($response, '尋找');
            $obj = $response->fetchall(PDO::FETCH_ASSOC);
            //print_r($classroom); Array ( [id] => 104 )
            return $obj;
        }
    }
    ?>