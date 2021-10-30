<?php
    class GraficosModelo extends Model{
        public function __construct(){
            parent::__construct();
        }

        public function graficoUno(){
            $arreglo = [];
            $sql = "SELECT if(rol=1, 'Administrador', 'Supervisor') as rol, 
            count(usuario) cantidad FROM usuario GROUP BY rol";
            $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_row()){
                $arreglo [] = $fila;
            }
            return $arreglo;
        }

        public function graficoDos(){
            $arreglo = [];
            $sql = "SELECT m.nombre as marca, COUNT(p.codigo) as productos 
            FROM PRODUCTO p INNER JOIN marca m ON m.codigo = p.marca 
            GROUP BY marca";
            $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_row()){
                $arreglo [] = $fila;
            }
            return $arreglo;
        }        
    }
?>