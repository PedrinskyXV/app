<?php
    class InicioModelo extends Model{
        private $usuario;
        private $contrasena;
        private $nivel;
        
        public function __construct(){
            parent::__construct();
        }
        public function getUsuario(){
            return $this->usuario;
        }
        public function getContrasena(){
            return $this->contrasena;
        }
        public function getNivel(){
            return $this->nivel;
        }
        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }
        public function setContrasena($contrasena){
            $this->contrasena = $contrasena;
        }
        public function setNivel($nivel){
            $this->nivel = $nivel;
        }

        public function validarLogin(){
            $nivel = "";
            $sql = "SELECT nivel FROM usuario WHERE usuario='".$this->usuario."' 
            AND pass='".$this->contrasena."'";
            $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $nivel = $fila['nivel'];
            }
            return $nivel;
        }
    }
?>