<?php
    class Graficos extends Controller{
        public function __construct(){
            parent::__construct();
        }

        public function anillo(){
            $p = new chartphp();
            // Contenido
            $datos[] = $this->getModel()->graficoUno();
            $p->data = $datos;
            $p->chart_type = "donut"; 
            // Diseño
            $p->title = "Usuarios por rol"; // Título
            $p->color = ["blue","orange"]; // Colores
            $p->theme = "dark"; // default light
            // Renderizar gráfico
            $out = $p->render('c1');
            $this->getView()->grafico = $out;
            $pagina = 'Graficos/anillo';
            $this->getView()->loadView($pagina);
        }

        public function barras(){
            $p = new chartphp();
            $datos[] = $this->getModel()->graficoDos();
            $p->data = $datos;
            $p->chart_type = "bar"; 
            // Diseño
            $p->title = "Cantidad de productos por marca"; // Título
            $p->xlabel = "Marcas"; //Título eje x
            $p->ylabel = "Cantidad"; //Título eje y
            $p->color = "#aa2ee6"; // Colores de las barras
            $p->theme = "dark"; // default light
            // Renderizar gráfico
            $out = $p->render('c1');
            $this->getView()->grafico = $out;
            $pagina = 'Graficos/barras';
            $this->getView()->loadView($pagina);
        }

        public function circular(){
            $p = new chartphp();
            // Contenido
            $datos[] = $this->getModel()->graficoDos();
            $p->data = $datos;
            $p->chart_type = "pie"; 
            // Diseño
            $p->title = "Porcentaje de productos por marca"; // Título
            $p->color = ["orange","purple"]; // Colores
            $p->theme = "dark"; // default light
            // Renderizar gráfico
            $out = $p->render('c1');
            $this->getView()->grafico = $out;
            $pagina = 'Graficos/circular';
            $this->getView()->loadView($pagina);
        }        
    }
?>