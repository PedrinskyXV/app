<?php
    class EmpleadoModelo extends Model{
        private $codigo;
        private $nombre;
        private $marca;
        private $precio;

        public function __construct(){
            parent::__construct();
        }

        public function getCodigo(){
            return $this->codigo;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getMarca(){
            return $this->marca;
        }
        public function getPrecio(){
            return $this->precio;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setMarca($marca){
            $this->marca = $marca;
        }
        public function setPrecio($precio){
            $this->precio = $precio;
        }

        public function listadoProductos(){
            $arreglo = [];
            $sql = "SELECT p.codigo, p.nombre, p.precio, m.nombre as marca 
            FROM producto p INNER JOIN marca m ON m.codigo=p.marca WHERE p.estado = 1";
            $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_object()){
                $arreglo[] = json_decode(json_encode($fila),true);
            }
            return $arreglo;
        }

        public function listadoMarcas(){
            $arreglo = [];
            $sql = "SELECT * FROM marca";
            $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_object()){
                $arreglo[] = json_decode(json_encode($fila),true);
            }
            return $arreglo;
        }

        public function insertarProductos(){
            $sql = "INSERT INTO producto(nombre, marca, precio) 
            VALUES ('".$this->nombre."',".$this->marca.",".$this->precio.")";
            $res = $this->getDb()->conectar()->query($sql);
            return ($res===TRUE)?true:false;
        }

        public function productoFiltrado(){
            $arreglo = [];
            $sql = "SELECT * FROM producto WHERE codigo=".$this->codigo;
            $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_object()){
                $arreglo[] = json_decode(json_encode($fila),true);
            }
            return $arreglo;
        }

        public function modificarProductos(){
            $sql = "UPDATE producto 
            SET 
            nombre='".$this->nombre."',
            marca=".$this->marca.", 
            precio=".$this->precio."
            WHERE codigo=".$this->codigo;
            $res = $this->getDb()->conectar()->query($sql);
            return ($res===TRUE)?true:false;
        }

        public function eliminarProductos(){

            $sql = "UPDATE producto SET estado = 0 WHERE codigo = ".$this->codigo;

            $res = $this->getDb()->conectar()->query($sql);

            return ($res===TRUE)?true:false;

        }
    }
?>