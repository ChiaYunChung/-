<?php
    require_once('Connection.php');
    class User
    {
        private string $id;
        private string $name;
        private string $level;
        private string $phone;
        private string $email;
        private int $blocked;
        private string $password_hash;

        public function __construct()
        {
            //echo 'ok';
            
        }

        public static function create($id, $password, $name, $level, $phone, $email)
        {
            $user = new User();
            $user->id = $id;
            $user->name = htmlspecialchars($name);
            $user->level = $level;
            $user->phone = htmlspecialchars($phone);
            $user->email = htmlspecialchars($email);
            $user->blocked = 0;
            $user->password_hash = password_hash(htmlspecialchars($password), PASSWORD_DEFAULT);
            
            $user->register();
            return $user;
        }
        
        public function register()
        {
            $conn = Connection::connect();
            $sql = "INSERT INTO `user_mng`(`id`, `level`, `name`, `phone`, `email`, `password_hash`, `blocked`) VALUES (:id,:level,:name,:phone,:email,:password_hash,:blocked)";     # should add update option
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            $response = $conn->prepare($sql);
            $response->bindParam(':id',$this->id);
            $response->bindParam(':level',$this->level);
            $response->bindParam(':name',$this->name);
            $response->bindParam(':phone',$this->phone);
            $response->bindParam(':email',$this->email);
            $response->bindParam(':password_hash',$this->password_hash);
            $response->bindParam(':blocked',$this->blocked);
            $str = '註冊';
            //echo $str;
            Connection::exe($response, $str);
        }
        
        public function user_type()
        {
            $conn = Connection::connect();
            $sql = "INSERT INTO `user_mng`(`id`, `level`, `name`, `phone`, `email`, `password_hash`, `blocked`) VALUES (:id,:level,:name,:phone,:email,:password_hash,:blocked)";
            
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            
            $response = $conn->prepare($sql);
            $response->bindParam(':id',$this->id);
            $response->bindParam(':level',$this->level);
            $response->bindParam(':name',$this->name);
            $response->bindParam(':phone',$this->phone);
            $response->bindParam(':email',$this->email);
            $response->bindParam(':password_hash',$this->password_hash);
            $response->bindParam(':blocked',$this->blocked);
            
            Connection::exe($response, '註冊');
        }

        public static function find_by_id($id)
        {
            $conn = Connection::connect();
            $sql = "SELECT * FROM `user_mng` WHERE `id`=? ";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $id);
            $respons = Connection::exe($response, '尋找');
            $user = $response->fetch(PDO::FETCH_ASSOC);
            return $user;
        }

        public static function login($id, $password)
        {
            $user = User::find_by_id($id);
    
            if (!($user)) {
                return null;
            }
    
            if(password_verify($password, $user['password_hash'])){
                User::session_start($user);
                return $user;
            }
        }
    
        public static function session_start($user)
        {
          session_start();
          $_SESSION['id'] = $user['id'];
          $_SESSION['name'] = $user['name'];
          $_SESSION['level'] = $user['level'];
          $_SESSION['blocked'] = $user['blocked'];
        }
        public static function logout()
        {
            session_start();
            session_unset();
            session_destroy();
        }
    
    }
    if (isset($_GET["type"])) {
        $type = $_GET["type"];
        switch($type){
            case "list":
                // 處理 REST URL: /book/list/
                // 處理 REST URL: /book/list/<row_id>
                //$bookRestHandler = new BookRestHandler();
                //$result = $bookRestHandler->getBooks();
                break;      
            case "create":
                // 處理 REST URL: /book/create/
                //$bookRestHandler = new BookRestHandler();
                //$bookRestHandler->addBook();
                break;        
            case "delete":
                // 處理 REST URL: /book/delete/<row_id>
                //$bookRestHandler = new BookRestHandler();
                //$result = $bookRestHandler->deleteBookById();
                break;         
            case "update":
                // 處理 REST URL: /book/update/<row_id>
                $sid=htmlspecialchars($_POST['sid']);
                $f = User::find_by_id($sid);
                if($f) echo 'true';
                else echo 'false';
         }       
    }
    //User::find_by_id('1102962');
    //User::create($id, $password, $name, $level, $phone, $email, $blocked);
   // User::find_by_id('1102943');
    //User::find_by_id('1102924');
    //User::find_by_id('1102962');
    ?>