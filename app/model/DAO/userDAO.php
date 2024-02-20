<?
    class userDAO{

        protected $db;

        public function __construct(){
            $this->db = DB::getInstance();
        }


        public function registration(tUser $tUser){
            $conn = $this->db->getConnection();

            $user = $tUser->getUser();
            $mail = $tUser->getMail();
            $password = $tUser->getPassword();
            $idFaculty = $tUser->getIdFaculty();
            $points = $tUser->getPoints();
            //$avatar = $tUser->getAvatar();

            $hashPassword = password_hash($password, PASSWORD_BCRYPT);

            //check if the user exists
            $q = "SELECT * FROM usuario WHERE user = '$user'";
            $com = $conn->query($q);
            
            if($com->num_rows === 0){
                //If the user does not exist, we insert it
                $q = "INSERT INTO usuario() VALUES ()";//TODO
                $resultado = $conn->query($q);

                $t = "SELECT * FROM usuario WHERE user = '$user'";
                $resultado = $conn->query($t);

                if($resultado->num_rows === 1){
                    $fila = $resultado->fetch_assoc();
                    return password_verify($password, $fila['password']);
                }else{
                    return false;
                }
            }
            else{//if user exist
                return false;
            }
        }


        public function login(tUser $user){
            $conn = $this->db->getConnection();
            $nickUser = $user->getUser();
            $pass = $user->getPassword();

            $query = "SELECT * FROM usuario WHERE usuario = '$nickUser'";
            $resultado = $conn->query($query);
            if($resultado->num_rows === 1){
                $fila = $resultado->fetch_assoc();
                if(password_verify($pass, $fila['password'])){
                    $usuario = new tUser();
                    $usuario->loginUser($nickUser, $fila[''], $pass, $fila[''], $fila['']);//TODO
                    return $usuario;
                }else{
                    //TODO
                }
            }else{

            }

        }



    }

?>