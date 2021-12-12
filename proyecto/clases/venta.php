<?php
require_once("conexion.php");
require_once("item.php");
    class Venta{
        private Conexion $conexion;
        public function __construct(private int $id_empleado, private $valor=0, private $fecha="", private $id=null){
            $this->conexion = Conexion::crearConexion();
        }

        public function getId():int{
            return $this->id;
        }

        /*    VENTA    */

        //Insertamos una ventaItem y retornamos si ha sido posible o no
        public function aniadirVenta():bool{
            //conexion
            $query = "INSERT INTO venta VALUES ('', ?, ?, ?);";
            
            //Ejecutamos la consulta
            $res = $this->conexion->crud($query, $this->id_empleado, $this->valor, $this->fecha);

            //almacenamos el id de la venta
            $this->id = $this->conexion->ultimoId();

            //retornamos si ha sido posible o no
            return $res;
        }

        public static function recuperarInstanciaVenta($idVenta):Venta{
            //conexion
            $conexion = Conexion::crearConexion();
            $query = "SELECT * FROM `venta` WHERE id_venta = ?; ";
            
            //Ejecutamos la consulta
            $res = $conexion->hacerConsulta($query, $idVenta);
            $res = $res[0];

            //Retornamos la venta
            return new Venta($res->id_empleado, $res->valor, $res->fecha, $res->id_venta);
        }



        //Consulta las ventas segun el id venta
        public static function consultarVenta($idVenta):array{
            //conexion
            $conexion = Conexion::crearConexion();
            $query = "SELECT * FROM `venta` WHERE id_venta = ?; ";
            
            //Ejecutamos la consulta
            $res = $conexion->hacerConsulta($query, $idVenta);

            return $res;
        }

        //Consulta las ventas, segun el empleado que la realizo
        public static function consultarVentaEmpleado($idEmpleado):array{
            //conexion
            $conexion = Conexion::crearConexion();
            $query = "SELECT * FROM `venta` WHERE id_empleado = ?; ";
            
            //Ejecutamos la consulta
            $res = $conexion->hacerConsulta($query, $idEmpleado);

            return $res;
        }

        //Elimina una venta
        public function eliminarVenta():bool{
            $query = "DELETE FROM `venta` WHERE `id_venta` = ?;";
            return $this->conexion->crud($query, $this->id);
        }

        //Actualiza el stock de un item por su id y dependiendo de cuantas veces se haya comprado en la 
        //venta con el id de esta clase
        public function actualizarStock($idItem):bool{
            $query = "UPDATE `item` SET item.stock = 
            (SELECT item.stock-ventaitem.cantidad 
            FROM item JOIN ventaitem
            ON item.id_item = ventaitem.id_item
            WHERE ventaitem.id_venta=? AND item.id_item=?)
            WHERE item.id_item=?;";

            //Eliminamos la variable carrito de sesion
            unset($_SESSION["carrito"]);

            return $this->conexion->crud($query, $this->id, $idItem, $idItem);
        }

        //Para validar una venta, le ponemos el valor y la fecha
        public function validarVenta():bool{
            $query = "UPDATE `venta` SET `valor` = '".$this->obtenerValor()[0]->total."', `fecha` = '".date("Y-m-d")."' WHERE `id_venta` = ?;";
            return $this->conexion->crud($query, $this->id);
        }

        //Para recuperar carrito si teniamos
        public static function recuperarCarrito($id):array{
            $conexion = Conexion::crearConexion();

            $query = "SELECT id_venta FROM `venta` WHERE fecha='0000-00-00' AND id_empleado=?;";
            return $conexion->hacerConsulta($query, $id);
        }

        //Nos retorna el total ganado con todas las ventas
        public static function totalGanado():array{
            $conexion = Conexion::crearConexion();
            $query = "SELECT SUM(valor) AS total FROM `venta`; ";
            return $conexion->hacerConsulta($query);
        }


        /*      VENTA ITEM   */

        //Nos retorna una ventaItem completa
        public function consultarVentaItem():array{ 
            $query = "SELECT * FROM `ventaItem` WHERE id_venta = ?; ";
            return $this->conexion->hacerConsulta($query, $this->id);
        }

        //Retorna si existe o no un item dentro de la ventaItem
        public function existeVentaItem($item, $idVenta):array{
            $query = "SELECT * FROM `ventaitem` WHERE id_item=? AND id_venta=?;";
            return $this->conexion->hacerConsulta($query, $item->getId(), $idVenta);
        }

        //Inserta una ventaItem asociada a la venta con el id de esta clase
        public function aniadirVentaItem($item, $cantidad):bool{
            $query = "INSERT INTO ventaitem VALUES (?, ?, ?);";
            return $this->conexion->crud($query, $item->getId(), $this->id, $cantidad);
        }

        //Modifica la cantidad de un item en ventaItem
        public function modificarCantidad($item, $cantidad):bool{
            $query = "UPDATE `ventaitem` SET `cantidad` = `cantidad`+? WHERE `id_item` = ? AND `id_venta` = ?;";
            return $this->conexion->crud($query, $cantidad, $item->getId(), $this->id);
        }

        //Elimina 1 ventaItem con el id del item que le pasemos
        public function eliminarVentaItem($idItem):bool{
            $query = "DELETE FROM `ventaitem` WHERE `id_item` = ? AND `id_venta` = ?";
            return $this->conexion->crud($query, $idItem, $this->id);
        }

        //Elimina todas las ventaItem asociadas al id de esta clase
        public function eliminarTodaVentaItem():bool{
            $query = "DELETE FROM `ventaitem` WHERE `id_venta` = ?;";
            return $this->conexion->crud($query, $this->id);
        }

        /*      GENERAL      */

        //Obtenemos el valor de lo que vayamos o hayamos comprando
        public function obtenerValor():array{
            $query = "SELECT SUM(I.precio*VI.cantidad) AS total FROM ventaitem VI JOIN item I ON VI.id_item = I.id_item WHERE VI.id_venta=?;";
            return $this->conexion->hacerConsulta($query, $this->id);
        }

        public function obtenerVenta():array{
            $query = "SELECT * FROM ventaitem VI JOIN venta V 
            ON VI.id_venta= V.id_venta 
            WHERE VI.id_venta=?;";

            return $this->conexion->hacerConsulta($query, $this->id);
        }

    }