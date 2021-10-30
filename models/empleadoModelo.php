<?php
    class EmpleadoModelo extends Model{
        private $codigo;
        private $nombre;
        private $edad;
        private $sueldoBase;
        private $codigoArea;
        private $estado;
        
        /**
         * Get the value of codigo
         */ 
        public function getCodigo()
        {
                return $this->codigo;
        }

        /**
         * Set the value of codigo
         *
         * @return  self
         */ 
        public function setCodigo($codigo)
        {
                $this->codigo = $codigo;

                return $this;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of edad
         */ 
        public function getEdad()
        {
                return $this->edad;
        }

        /**
         * Set the value of edad
         *
         * @return  self
         */ 
        public function setEdad($edad)
        {
                $this->edad = $edad;

                return $this;
        }

        /**
         * Get the value of sueldoBase
         */ 
        public function getSueldoBase()
        {
                return $this->sueldoBase;
        }

        /**
         * Set the value of sueldoBase
         *
         * @return  self
         */ 
        public function setSueldoBase($sueldoBase)
        {
                $this->sueldoBase = $sueldoBase;

                return $this;
        }

        /**
         * Get the value of codigoArea
         */ 
        public function getCodigoArea()
        {
                return $this->codigoArea;
        }

        /**
         * Set the value of codigoArea
         *
         * @return  self
         */ 
        public function setCodigoArea($codigoArea)
        {
                $this->codigoArea = $codigoArea;

                return $this;
        }

        /**
         * Get the value of estado
         */ 
        public function getEstado()
        {
                return $this->estado;
        }

        /**
         * Set the value of estado
         *
         * @return  self
         */ 
        public function setEstado($estado)
        {
                $this->estado = $estado;

                return $this;
        }

        public function __construct(){
            parent::__construct();
        }        

        public function listarEmpleados(){
            $arreglo = [];
            $sql = "SELECT 
            e.codigoEmpleado,
            e.nombre,
            e.edad,
            e.sueldoBase,
            e.codigoArea,
            e.estado,
            a.nombre as Area
        FROM
            empleado e
                INNER JOIN
            area a ON e.codigoArea = a.codigoArea WHERE e.estado = 1 ORDER BY e.codigoEmpleado ASC";
            $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_object()){
                $arreglo[] = json_decode(json_encode($fila),true);
            }
            return $arreglo;
        }

        public function listadoMarcas(){
            $arreglo = [];
            $sql = "SELECT * FROM area";
            $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_object()){
                $arreglo[] = json_decode(json_encode($fila),true);
            }
            return $arreglo;
        }

        public function insertarProductos(){
            $sql = "INSERT INTO empleado (nombre, edad, sueldoBase, codigoArea, estado) values
             ('".$this->nombre."',".$this->edad.",".$this->sueldoBase.",".$this->codigoArea.", 1)";
            $res = $this->getDb()->conectar()->query($sql);
            return ($res===TRUE)?true:false;
        }

        public function productoFiltrado(){
            $arreglo = [];
            $sql = "SELECT * FROM empleado WHERE codigoEmpleado=".$this->codigo;
            $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_object()){
                $arreglo[] = json_decode(json_encode($fila),true);
            }
            return $arreglo;
        }

        public function modificarProductos(){
           try {
            $sql = "UPDATE empleado 
            SET 
            nombre ='".$this->nombre."',
            edad =".$this->edad.",
            sueldoBase =".$this->sueldoBase.",
            codigoArea =".$this->codigoArea.", 
            estado = ".$this->estado."
            WHERE codigoEmpleado = ".$this->codigo;
            $res = $this->getDb()->conectar()->query($sql);

            print_r($sql);
            print_r($res);

            return ($res===TRUE)?true:false;
           } catch (\Throwable $th) {
            var_dump($th->getMessage());
            return $th->getMessage();            
           }
            
        }

        public function eliminarProductos(){

            $sql = "UPDATE empleado SET estado = 0 WHERE codigoEmpleado = ".$this->codigo;

            $res = $this->getDb()->conectar()->query($sql);

            return ($res===TRUE)?true:false;

        }        
    }
?>