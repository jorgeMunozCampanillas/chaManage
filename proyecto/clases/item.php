<?php
require_once("conexion.php");
class Item{
    //constructor por promocion de propiedades
    public function __construct(private int $id, 
                                public string $nombre, 
                                public string $descripcion, 
                                public int $precio,
                                public int $stock)
    {
        
    }                       


    //Retorna el id del item
    public function getId(){
        return $this->id;
    }

    //Busca un item por su nombre, ademas muestra todos los que tengan coincidencia con esas letras
    //Y nos retorna un array de ITEMS o uno vacio si no se ha encontrado ninguno
    public static function buscarItem(string $item):array{
        if ($item!=null) {
            $conexion = Conexion::crearConexion();
            
            $query = "SELECT * FROM `item` WHERE nombre LIKE ?";
            
            $resultado = $conexion->hacerConsulta($query, $item);

            //Con el resultado obtenido creamos un objeto item y lo almacenamos en un array de items
            $items = [];
            foreach ($resultado as $item) {
                $nuevo = new Item($item->id_item, $item->nombre, $item->descripcion, $item->precio, $item->stock);
                array_push($items, $nuevo);
            }
            return $items;
        }
        return [];
    }

    //Busca un item por su id nos retorna un ITEM o null
    public static function buscarItemId(int $id_item):?Item{
        if ($id_item!=null) {
            $conexion = Conexion::crearConexion();
            
            $query = "SELECT * FROM `item` WHERE id_item = ?";
            
            $item = $conexion->hacerConsulta($query, $id_item);
            $item = $item[0];

            //Con el resultado obtenido creamos un objeto item y lo almacenamos en un array de items
            $nuevo = new Item($item->id_item, $item->nombre, $item->descripcion, $item->precio, $item->stock);

            return $nuevo;
        }
        return null;
    }

    public static function aniadirItem(string $nombre, string $descripcion, int $precio, int $stock){
        $conexion = Conexion::crearConexion();

        //Pongo '', pq la pk es auto incremental, pero aun así necesita que le pasemos algo
        $query = "INSERT INTO `item` VALUES ('', ?, ?, ?, ?);";
        $resultado = $conexion->crud($query, $nombre, $descripcion, $precio, $stock);
    }

    public function borrarItem(){
        $conexion = Conexion::crearConexion();

        $query = "DELETE FROM `item` WHERE id_item = ?";
        $conexion->crud($query, $this->id);
    }

    public function editarItem(string $nombre, string $descripcion, int $precio, int $stock){
        $conexion = Conexion::crearConexion();
        $query = "UPDATE `item` SET `nombre` = ?, `descripcion` = ?, `precio` = ?, `stock` = ? WHERE `id_item` = ?";
        $conexion->crud($query, $nombre, $descripcion, $precio, $stock, $this->id);
    }

    public static function editarStock(int $id, int $nuevoStock){
        $conexion = Conexion::crearConexion();
        $query = "UPDATE `item` SET `stock` = ? WHERE `id_item` = ?";
        $conexion->crud($query, $nuevoStock, $id);
    }
}