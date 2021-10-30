<?php
class Empleado extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (isset($_SESSION["nivel"]) ) {

            if($_SESSION["nivel"] != 1){
                $this->getView()->loadView('Inicio/login');
            }
            else{
                $pagina = 'Empleado/index';
                $this->getView()->loadView($pagina);
            }
        } else {
            $this->getView()->loadView('Inicio/login');
        }
    }

    public function mostrarEmpleados()
    {

        $datos = $this->getModel()->listarEmpleados();
        $tr = '';
        foreach ($datos as $value) {
            $urlEditar = constant('URL') . "empleado/modificar?codigo=" . $value['codigoEmpleado'];
            $urlEliminar = constant('URL') . "empleado/eliminar?codigo=" . $value['codigoEmpleado'];

            $tr .= '<tr>
                    <th>' . $value['codigoEmpleado'] . '</th>
                    <td>' . $value['nombre'] . '</td>
                    <td>' . $value['edad'] . '</td>
                    <td> $' . $value['sueldoBase'] . '</td>
                    <td>' . $value['Area'] . '</td>
                    <td class="text-center">
                        <div class="btn-group">';
            if ($_SESSION['nivel'] == 1) {
                $tr .= '<a href="' . $urlEliminar . '" class="btn btn-primary btn-sm" id="btnEliminar">Eliminar</a>';
            }
            $tr .= '<a href="' . $urlEditar . '"class="btn btn-dark btn-sm">Modificar</a>
                        </div>
                    </td>
                </tr>';
        }
        echo $tr;
    }

    public function nuevo()
    {
        if (isset($_SESSION["nivel"])) {
            $this->getView()->marcas = $this->getModel()->listadoMarcas();
            $pagina = 'Empleado/nuevo';
            $this->getView()->loadView($pagina);
        } else {
            $this->getView()->loadView('Inicio/login');
        }
    }

    public function agregar()
    {

        if (!empty($_POST)) {
            $this->getModel()->setNombre($_POST["txtNombre"]);
            $this->getModel()->setEdad($_POST["txtEdad"]);
            $this->getModel()->setSueldoBase($_POST["txtSueldoBase"]);
            $this->getModel()->setCodigoArea($_POST["sArea"]);
            //$this->getModel()->setEstado($_POST["txtEstado"]);
            $respuesta = $this->getModel()->insertarProductos();
            echo $respuesta;
        }
    }

    public function modificar()
    {

        if (isset($_SESSION["nivel"])) {
            if (isset($_GET["codigo"])) {
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
                var_dump($_POST);

                if (!empty($_POST)) {
                    // Capturar datos
                    $this->getModel()->setCodigo($_POST["txtCodigo"]);
                    $this->getModel()->setNombre($_POST["txtNombre"]);
                    $this->getModel()->setEdad($_POST["txtEdad"]);
                    $this->getModel()->setSueldoBase($_POST["txtSueldoBase"]);
                    $this->getModel()->setCodigoArea($_POST["sArea"]);
                    $this->getModel()->setEstado($_POST["sEstado"]);
                    // Invocar función de modificación
                    $respuesta = $this->getModel()->modificarProductos();                    
                    echo $respuesta;
                }
                else{
                    echo "POST vacio !";
                }
            }
        } else {
            $this->getView()->loadView('Inicio/login');
        }
    }

    public function eliminar()
    {
        if (isset($_GET["codigo"])) {
            $codigo = $_GET["codigo"];
            $this->getModel()->setCodigo($codigo);
            $respuesta = $this->getModel()->eliminarProductos();
            echo $respuesta;
        }
    }
}
