<?php
    class InformeModelo extends Model{       

        public function __construct(){
            parent::__construct();
        }

        public function reporteMarcas(){
            $arreglo = [];
            $sql = "SELECT * FROM marca";
            $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_object()){
                $arreglo[] = json_decode(json_encode($fila),true);
            }
            return $arreglo;
        }

        public function reporteProductos($campo, $valor){
            $arreglo = [];
            $where = ($campo==1)?'p.codigo='.$valor:'p.marca='.$valor;
            $sql = "SELECT p.codigo, p.nombre, m.nombre as marca , p.precio 
            FROM producto p INNER JOIN marca m ON p.marca = m.codigo WHERE ".$where;
            $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_object()){
                $arreglo[] = json_decode(json_encode($fila),true);
            }
            return $arreglo;
        }
    }
?>