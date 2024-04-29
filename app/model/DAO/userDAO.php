
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

            $hashPassword = password_hash($password, PASSWORD_BCRYPT);

            //check if the user exists
            $q = "SELECT * FROM usuario WHERE user = '$user'";
            $com = $conn->query($q);

            $que = "SELECT * FROM usuario WHERE mail = '$mail'";
            $com2 = $conn->query($que);
            
            if($com->num_rows === 0){
                if($com2->num_rows === 0){
                    //If the user does not exist, we insert it
                    $q = "INSERT INTO `usuario`(`user`, `mail`, `password`, `idFacultad`, `points`, `avatar`, `pointsExtra`, `winner`, `lastPlay`) VALUES ('$user', '$mail', '$hashPassword', '$idFaculty', 0, 'chico1.webp', 0, 0, null)";
                    $resultado = $conn->query($q);
                    
                    return $resultado;
                }
                else{//if mail exist
                    return -1;
                }
            }
            else{//if user exist
                return -2;
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
                    $usuario->loginUser($nickUser, $fila['mail'], $password, $fila['idFacultad'], $fila['points'], $fila['avatar'], $fila['pointsExtra'], $fila['winner'], $fila['lastPlay']);

                    return $usuario;
                }else{
                    return -1;
                }
            }else{
                return -2;
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
            else{//if the name_user exist
                return -1;
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
                    return -1;
                }
            }else{
                return false;
            }
        }

        public function editAvatar($usuario, $avatarURL){
            $conn = $this->db->getConnection();

            $query = "UPDATE usuario SET avatar = '$avatarURL' WHERE user = '$usuario'";

            $resultado = $conn->query($query);

            return $resultado;
        }

        public function deleteUser($nickUser, $password){
            $conn = $this->db->getConnection();

            $query = "SELECT * FROM usuario WHERE user = '$nickUser'";

            $resultado = $conn->query($query);

            if($resultado->num_rows === 1){

                $fila = $resultado->fetch_assoc();

                if(password_verify($password, $fila['password'])){

                    $q = "DELETE FROM usuario WHERE user = '$nickUser'";

                    $resultado = $conn->query($q);

                    return $resultado;
                }
                else{//incorrect password
                    return -1;
                }
            }
            else{//user does not exist
                return -2;
            }

        }

        public function winner($nickUser){
            $conn = $this->db->getConnection();

            $query = "SELECT * FROM usuario WHERE user = '$nickUser'";

            $resultado = $conn->query($query);
            
            $query = "UPDATE usuario SET winner = '1', lastPlay = CURDATE() WHERE user = '$nickUser'";

            $resultado = $conn->query($query);
                
            return $resultado;
        }

        public function loser($nickUser){
            $conn = $this->db->getConnection();

            $query = "SELECT * FROM usuario WHERE user = '$nickUser'";

            $resultado = $conn->query($query);
            
            $query = "UPDATE usuario SET winner = '0', lastPlay = CURDATE() WHERE user = '$nickUser'";

            $resultado = $conn->query($query);
                
            return $resultado;
        }


        public function addScore($nickUser, $score){
            $conn = $this->db->getConnection();

            $query = "SELECT * FROM usuario WHERE user = '$nickUser'";

            $resultado = $conn->query($query);
            
            $query = "UPDATE usuario SET points = points + $score WHERE user = '$nickUser'";

            $resultado = $conn->query($query);
                
            return $resultado;
        }

        public function addExtraScore($nickUser, $extraScore){
            $conn = $this->db->getConnection();

            $query = "SELECT * FROM usuario WHERE user = '$nickUser'";

            $resultado = $conn->query($query);
            
            $query = "UPDATE usuario SET pointsExtra = $extraScore WHERE user = '$nickUser'";

            $resultado = $conn->query($query);
                
            return $resultado;
        }

    }

?>