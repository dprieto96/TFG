
<?php
    
    require_once("../model/DAO/conexion.php");
    require_once("../model/domains/tUser.php");

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
            $points = (int) $tUser->getPoints();
            //$avatar = $tUser->getAvatar();

            $hashPassword = password_hash($password, PASSWORD_BCRYPT);

            //check if the user exists
            $q = "SELECT * FROM usuario WHERE user = '$user'";
            $com = $conn->query($q);

            $que = "SELECT * FROM usuario WHERE mail = '$mail'";
            $com2 = $conn->query($que);
            
            if($com->num_rows === 0){
                if($com2->num_rows === 0){
                    //If the user does not exist, we insert it
                    $q = "INSERT INTO `usuario`(`user`, `mail`, `password`, `idFacultad`, `points`) VALUES ('$user', '$mail', '$hashPassword', '$idFaculty', 0)";
                    $resultado = $conn->query($q);
                    
                    return $resultado;
                }
                else{
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
            $password = $user->getPassword();

            $query = "SELECT * FROM usuario WHERE user = '$nickUser'";
            
            $resultado = $conn->query($query);
            
            if($resultado->num_rows === 1){
                $fila = $resultado->fetch_assoc();
                if(password_verify($password, $fila['password'])){

                    $usuario = new tUser();
                    $usuario->loginUser($nickUser, $fila['mail'], $password, $fila['idFacultad'], $fila['points']);

                    return $usuario;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }


        public function editUser($newUser, $oldUser){
            $conn = $this->db->getConnection();

            $query = "SELECT * FROM usuario WHERE user = '$newUser'";

            $resultado = $conn->query($query);
            
            //Nobody have this user
            if($resultado->num_rows === 0){
                $query = "UPDATE usuario SET user = '$newUser' WHERE user = '$oldUser'";

                $resultado = $conn->query($query);
                
                return $resultado;
            }
            else{
                return false;
            }
        }

        public function editPassword($usuario, $oldPassword, $newPassword){
            $conn = $this->db->getConnection();

            $query = "SELECT * FROM usuario WHERE user = '$usuario'";
            
            $resultado = $conn->query($query);
            
            if($resultado->num_rows === 1){
                $fila = $resultado->fetch_assoc();
                if(password_verify($oldPassword, $fila['password'])){
                    $hashPassword = password_hash($oldPassword, PASSWORD_BCRYPT);
                    $query = "UPDATE usuario SET password = '$hashPassword' WHERE user = '$usuario'";

                    $resultado = $conn->query($query);
                    
                    return $resultado;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }


    }

?>