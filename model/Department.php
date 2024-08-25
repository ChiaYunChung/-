<?php
    require_once('Connection.php');
    class Department
    {
        private int $id;
        private string $name;
        private int $act;
        private int $vio_time;

        public function __construct()
        {   
        }
        public static function create($id, $name, $act, $vio_time)
        {
            $dep = new Department();
            $dep->name = htmlspecialchars($name);
            $dep->act = 0;
            $dep->vio_time = 0;
            $dep->register();
            return $dep;
        }
        
        public function register()
        {
            $conn = Connection::connect();
            $sql = "INSERT INTO `department_mng`(`name`, `vio_time`, `act`) VALUES (:name,:amount,:act)";     # should add update option
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            $response = $conn->prepare($sql);
            $response->bindParam(':name',$this->name);
            $response->bindParam(':vio_time',$this->vio_time);
            $response->bindParam(':act',$this->act);
            $str = '註冊單位';
            echo $str;
            Connection::exe($response, $str);
        }

        public static function find_by_id($id)
        {
            $conn = Connection::connect();
            $sql = "SELECT * FROM `department_mng` WHERE `id`=? ";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $id);
            $response = Connection::exe($response, '尋找');
            $dep = $response->fetch(PDO::FETCH_ASSOC);
            return $dep;
        }
        public static function find_name_by_id($id)
        {
            $conn = Connection::connect();
            $sql = "SELECT `name` FROM `department_mng` WHERE `id`=? ";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $id);
            $response = Connection::exe($response, '尋找');
            $dep = $response->fetch(PDO::FETCH_ASSOC);
            return $dep;
        }

        public static function show_dep()
        {
            $conn = Connection::connect();
            $sql = "SELECT * FROM `department_mng` WHERE `act`=0";     # should add update option
            $response = $conn->prepare($sql);
            $response = Connection::exe($response, '尋找');
            $dep = $response->fetchall(PDO::FETCH_ASSOC);
            //print_r($classroom); Array ( [id] => 104 )
            return $dep;
        }
    }
    ?>