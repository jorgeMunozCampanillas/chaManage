<?php
    require_once("conexion.php");
    class Usuario{
        
        protected function __construct(protected int $id_usuario, protected int $tipo){}

        //Funcion, que nos va a crear un tipo de usuario o otro segun seamos
        public static function crearUsuario($id_usuario, $tipo){
                switch ($tipo) {
                    case '1':
                        $usuario = new Admin($id_usuario, $tipo);
                        break;

                    default:
                        $usuario = new Empleado($id_usuario, $tipo);
                        break;
                }
            return $usuario;
        }

        //Retorna los datos del usuario si existe y false si no
        public static function validarUsuario(string $user, string $pass):array|false{
            $conexion = Conexion::crearConexion();
            
            $query = "SELECT * FROM `empleado` WHERE nombre = ? AND contrasenia = ?;";           
            $resultado = $conexion->hacerConsulta($query, $user, $pass);
            return $resultado;
        }

        //Si existe el usuario, lo crea y indica si lo ha creado o no
        public static function login(string $user, string $pass):object|bool{
            if ($res = self::validarUsuario($user, $pass)) {
                $usuario = self::crearUsuario($res[0]->id_empleado, $res[0]->tipo);
            }
            return $usuario ?? false;
        }

        public function getTipo(){
            return $this->tipo;
        } 

        public function getId(){
            return $this->id_usuario;
        } 
    }



    class Admin extends Usuario{
        public function __construct(protected int $id_usuario, protected int $tipo){
            parent::__construct($id_usuario, $tipo);
        }

        //Permite buscar un usuario por su Nombre
        public function buscarUsuarioNombre(string $nombre):array{
            if ($nombre!=null) {
                $conexion = Conexion::crearConexion();
                
                $query = "SELECT * FROM `empleado` WHERE nombre LIKE ?";
                
                $resultado = $conexion->hacerConsulta($query, $nombre);
                return $resultado;
            }
            return [];
        }

        //Permite buscar un usuario por su ID
        public function buscarUsuarioID(string $idUsuario):array{
            $conexion = Conexion::crearConexion();
                
            $query = "SELECT * FROM `empleado` WHERE id_empleado = ?";
            $resultado = $conexion->hacerConsulta($query, $idUsuario);
            return $resultado;
        }

        //Permite añadir un nuevo usuario
        public function aniadirUsuario(string $contrasenia, string $nombre, int $tipo, string $fecha){
            $conexion = Conexion::crearConexion();
    
            $query = "INSERT INTO `empleado` VALUES ('', ?, ?, ?, ?);";
            $resultado = $conexion->crud($query, $contrasenia, $tipo, $nombre, $fecha);
        }

        //Permite borrar un usuario por su id
        public function borrarUsuario($idUsuario){
            $conexion = Conexion::crearConexion();
    
            $query = "DELETE FROM `empleado` WHERE id_empleado = ?";
            $conexion->crud($query, $idUsuario);
        }

        //Permite editar un usuario
        public function editarUsuario(int $idUsuario, string $contrasenia, string $tipo, string $nombre){
            $conexion = Conexion::crearConexion();
            
            $query = "UPDATE `empleado` SET `contrasenia` = ?, `tipo` = ?, `nombre` = ? WHERE `id_empleado` = ?";
            $conexion->crud($query, $contrasenia, $tipo, $nombre, $idUsuario);
        }

    }

    class Empleado extends Usuario{
        public function __construct(protected int $id_usuario, protected int $tipo){
            parent::__construct($id_usuario, $tipo);
        }
    }
