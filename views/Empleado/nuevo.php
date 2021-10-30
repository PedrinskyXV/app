<title>App - Nuevo Empleado</title>

<?php
require_once 'views/Template/header.php';
?>

<?php
require_once 'views/Template/menu.php';
?>

<main class="px-3">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-6 mt-4">
            <h2 class="text-center pt-3">Nuevo empleado</h2>
            <form action="<?=constant('URL')?>empleado/agregar" method="POST" id="frmProductos">
                Nombre
                <input type="text" class="form-control" name="txtNombre" data-validetta="required">
                Marca
                <select class="form-control" name="sMarca" data-validetta="required">
                    <option value="" selected>Seleccione</option>
                    <?php
                            $datos = $this->marcas;
                            foreach ($datos as $value) {
                        ?>
                    <option value="<?=$value['codigo']?>"><?=$value['nombre']?></option>
                    <?php        
                            }
                        ?>
                </select>
                Precio
                <input type="text" class="form-control" name="txtPrecio" data-validetta="required">
                <button class="btn btn-primary mt-2 btn-block btn-sm" id="btnAdd">Agregar</button>
            </form>
        </div>
    </div>
</main>
<?php
require_once 'views/Template/footer.php';
?>