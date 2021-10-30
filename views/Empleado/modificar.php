<title>App - Modificar Empleado</title>
<?php
require_once 'views/Template/header.php';
?>

<?php
require_once 'views/Template/menu.php';
?>

<main class="px-3">
    <div class="col-lg-6 mx-auto">
        <h4 class="text-primary text-center pb-2">Detalles del empleado</h4>

        <form action="<?=constant('URL')?>producto/modificar" method="POST" id="frmProductos">
            <?php
                        $datos = $this->datos;
                    ?>
            Código
            <input type="text" class="form-control" name="txtCodigo" value="<?=$datos[0]['codigo']?>" readonly>
            Nombre
            <input type="text" class="form-control" name="txtNombre" value="<?=$datos[0]['nombre']?>">
            Marca
            <select id="" class="form-control" name="sMarca">
                <?php
                            $marcas = $this->marcas;
                            foreach ($marcas as $value) {
                        ?>
                <option value="<?=$value['codigo']?>" <?=($value['codigo']==$datos[0]['marca'])?"selected":""?>>
                    <?=$value['nombre']?>
                </option>
                <?php
                            }
                        ?>
            </select>
            Precio
            <input type="text" class="form-control" name="txtPrecio" value="<?=$datos[0]['precio']?>">
            <button class="btn btn-primary mt-2 btn-block btn-sm" id="btnModificar">Modificar</button>
        </form>
    </div>
</main>
<?php
require_once 'views/Template/footer.php';
?>