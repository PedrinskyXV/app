<?php    
    class Informe extends Controller{
        public function __construct(){
            parent::__construct();
        }

        public function reporteBase(){
            $pdf = new TCPDF();
            $pdf->setHeaderMargin(10);
            $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Título', 'Subtitulo');
            $pdf->SetMargins(20, 30, 20);
            $contenido = '<h1>Contenido del pdf</h1>';           
            $pdf->AddPage();
            $pdf->writeHTML($contenido);
            $pdf->Output();
        }

        public function pdfMarcas(){
            $pdf = new TCPDF();
            $pdf->setHeaderMargin(10);
            $pdf->setHeaderData(PDF_HEADER_LOGO, 60, 'Reporte', 'Marcas');
            $pdf->SetMargins(20, 30, 20);
            // Consulta a bd
            $marcas = $this->getModel()->reporteMarcas();
            $html = '<table border="1" cellpadding="3">
            <tr style="background-color: black; color: white; text-align:center;">
            <td>Código</td>
            <td>Marca</td>
            </tr>';
            foreach ($marcas as $key => $value) {
                $html .= '<tr>
                <td style="background-color: gray; text-align:center;">'.$value['codigo'].'</td>
                <td>'.$value['nombre'].'</td>
                </tr>';
            }            
            $html .= '</table>';            
            $pdf->AddPage();
            $pdf->writeHTML($html);
            $pdf->Output();
        }

        public function pdfProductos(){
            if(!empty($_POST)){
                // Capturar datos
                if(!empty($_POST['txtCodigo'])){
                    $datos = $this->getModel()->reporteProductos(1,  $_POST['txtCodigo']);
                } else {
                    if(!empty($_POST['sMarca'])){
                        $datos = $this->getModel()->reporteProductos(2, $_POST['sMarca']);
                    }                    
                }
                // Crear PDF
                $pdf = new TCPDF();
                $pdf->setHeaderMargin(10);
                $pdf->setHeaderData(PDF_HEADER_LOGO, 60, 'Reporte', 'Productos');
                $pdf->SetMargins(20, 30, 20);
                if(!empty($datos)){
                    $html = '<table border="1" cellpadding="3">
                    <tr style="background-color: black; color: white; text-align:center;">
                    <td>Código</td>
                    <td>Producto</td>
                    <td>Marca</td>
                    <td>Precio</td>
                    </tr>';
                    foreach ($datos as $key => $value) {
                        $html .= '<tr>
                        <td style="background-color: gray; text-align:center;">'.$value['codigo'].'</td>
                        <td>'.$value['nombre'].'</td>
                        <td>'.$value['marca'].'</td>
                        <td>'.$value['precio'].'</td>
                        </tr>';
                    }            
                    $html .= '</table>'; 
                } else{
                    $html = '<h1 style="text-align:center">Sin registros</h1>';
                }                           
                $pdf->AddPage();
                $pdf->writeHTML($html);
                $pdf->Output();

            } else {
                $this->getView()->marcas = $this->getModel()->reporteMarcas();
                $pagina = 'Informe/pdfProductos';
                $this->getView()->loadView($pagina);
            }            
        }
    }
?>