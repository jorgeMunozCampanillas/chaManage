<?php

class Conexion{
    private static $instancia = null;
    public ?PDO $conexion = null;

    private function __construct(){
        $this->conexion = new PDO("mysql:host=localhost;dbname=proyecto", "root", "");
    }

    public static function crearConexion():Conexion|Exception{
        //Si aun no se ha instanciado una clase, lo hacemos, 
        //En el caso de error de PDO, se lo enviamos a la clase que lo este
        //utilizando y que ya ella lo gestione como deba
        if (self::$instancia==null) {
            try {
                self::$instancia = new Conexion();
            } catch (PDOException $e) {
                return $e;
            }
        }
        return self::$instancia;
    }


    //Ponemos clone como privado, y así tampoco nos pueden clonar la clase
    private function __clone(){} 


    //Retorna el ultimo id de la ultima insercción que se realizo
    public function ultimoId(){
        return $this->conexion->lastInsertId();
    }


    //Hacer consulta que retorne resultados, siempre va a retornar un array, ya que
    //no se si se van a retornar muchos resultados con la consulta o solo 1, por eso siempre va a dar un array
    public function hacerConsulta($query, ...$parametros):array{
        //Preparamos la query
        $prep = $this->conexion->prepare($query);

        //Le bindeamos tantos valores como parametros hayamos pasado
        for ($i=1; $i < count($parametros)+1; $i++) { 
            $prep->bindValue($i, $parametros[$i-1]);
        }
        
        $prep->execute();

        $res=[];
        //Cada resultado lo meto en el array res
        for ($i=0; $i < $prep->rowCount(); $i++) { 
            $res[$i]=$prep->fetchObject();  
        }

        return $res;
    }

    //Hacer consultas que no retorne resultados, si no true o false
    public function crud($query, ...$parametros):bool{
        //Preparamos la query
        $prep = $this->conexion->prepare($query);

        //Le bindeamos tantos valores como parametros hayamos pasado
        for ($i=1; $i < count($parametros)+1; $i++) { 
            $prep->bindValue($i, $parametros[$i-1]);
        }

        //Ejectamos y retornamos si se ha podido insertar o no
        return $prep->execute();
    }
}