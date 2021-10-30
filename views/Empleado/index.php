<title>App - Empleados</title>
<?php
require_once 'views/Template/header.php';
?>

<?php
require_once 'views/Template/menu.php';
?>
<main class="px-3">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-10 mt-4">
        <h2 class="text-center p-3 text-primary">Empleados</h2>
            <?php
                    if($_SESSION['rol']==1){
                ?>
            <a href="<?=constant('URL')?>empleado/nuevo" class="btn btn-block btn-primary mt-3">Agregar Empleado</a>
            <?php        
                    }
                ?>
            <table class="table table-hover" id="productos">
                <thead class="table-dark text-white text-center">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</main>
<?php
require_once 'views/Template/footer.php';
?>