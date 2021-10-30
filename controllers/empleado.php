<?php
    class Empleado extends Controller{
        public function __construct(){
            parent::__construct();                        
        }

        public function index(){
            if(isset($_SESSION["rol"])){
                $pagina = 'Empleado/index';
                $this->getView()->loadView($pagina);
            } else {
                $this->getView()->loadView('Inicio/login'); 
            }             
        }

        public function mostrarProductos(){
            // Consulta a base de datos
            $datos = $this->getModel()->listadoProductos();
            $tr = '';
            foreach ($datos as $value) {
                $urlEditar = constant('URL')."empleado/modificar?codigo=".$value['codigo'];
                $urlEliminar = constant('URL')."empleado/eliminar?codigo=".$value['codigo'];
                $tr .='<tr>
                    <th>'.$value['codigo'].'</th>
                    <td>'.$value['nombre'].'</td>
                    <td>'.$value['marca'].'</td>
                    <td>'.$value['precio'].'</td>
                    <td class="text-center">                             
                        <div class="btn-group">';
                            if($_SESSION['rol']==1){
                                $tr .= '<a href="'.$urlEliminar.'" class="btn btn-primary btn-sm" id="btnEliminar">Eliminar</a>';
                            }                            
                            $tr .= '<a href="'.$urlEditar.'"class="btn btn-dark btn-sm">Modificar</a> 
                        </div>
                    </td>
                </tr>';
            }
            echo $tr;
        }

        public function nuevo(){
            if(isset($_SESSION["rol"])){
                $this->getView()->marcas = $this->getModel()->listadoMarcas();
                $pagina = 'Empleado/nuevo';
                $this->getView()->loadView($pagina);
            } else {
                $this->getView()->loadView('Inicio/login'); 
            }             
        }

        public function agregar(){
            if(!empty($_POST)){
                $this->getModel()->setNombre($_POST["txtNombre"]);
                $this->getModel()->setMarca($_POST["sMarca"]);
                $this->getModel()->setPrecio($_POST["txtPrecio"]);

                $respuesta = $this->getModel()->insertarProductos();
                echo $respuesta;
            }
        }

        public function modificar(){
            if(isset($_SESSION["rol"])){
                if(isset($_GET["codigo"])){
                    $codigo = $_GET["codigo"];
                    // Enviar marcas a la vista
                    $this->getView()->marcas = $this->getModel()->listadoMarcas();
                    // Enviar datos a la vista
                    $this->getModel()->setCodigo($codigo);
                    $this->getView()->datos = $this->getModel()->productoFiltrado();
                    // Mostrar vista
                    $pagina = 'Empleado/modificar';
                    $this->getView()->loadView($pagina); 
                } else {
                    if(!empty($_POST)){
                        // Capturar datos
                        $this->getModel()->setCodigo($_POST["txtCodigo"]);
                        $this->getModel()->setNombre($_POST["txtNombre"]);
                        $this->getModel()->setMarca($_POST["sMarca"]);
                        $this->getModel()->setPrecio($_POST["txtPrecio"]);
                        // Invocar función de modificación
                        $respuesta = $this->getModel()->modificarProductos();
                        echo $respuesta;
                    }                                       
                }
            } else {
                $this->getView()->loadView('Inicio/login'); 
            }                                 
        }

        public function eliminar(){
            if(isset($_GET["codigo"])){
                $codigo = $_GET["codigo"];
                $this->getModel()->setCodigo($codigo);
                $respuesta = $this->getModel()->eliminarProductos();
                echo $respuesta;
            }
        }
    }
?>