<?php

if (empty($_GET["idProducto"])) {
    exit("No proporcionaste un id de producto o servicio");
}
if (empty($_GET["idCotizacion"])) {
    exit("No proporcionaste un id de cotización");
}
$producto = Cotizaciones::obtenerProductoPorId($_GET["idProducto"]);
if (!$producto) {
    exit("No existe el producto o servicio");
}
$tokenCSRF = Utiles::obtenerTokenCSRF();
?>


<div class="col-sm-4">
    <h3>Editar producto</h3>
    <form method="post" action="<?php echo BASE_URL ?>/?p=actualizar_producto_de_cotizacion">
        <input type="hidden" name="idCotizacion" value="<?php echo $producto->idCotizacion ?>">
        <input type="hidden" name="idProducto" value="<?php echo $producto->id ?>">
        <input type="hidden" name="tokenCSRF" value="<?php echo $tokenCSRF ?>">
        <div class="form-group">
            <label for="producto">Producto</label>
            <input value="<?php echo $producto->producto; ?>" autofocus name="producto o servicio" autocomplete="off" required type="text" class="form-control" id="servicio" placeholder="">
        </div>
        <div class="form-group">
            <label for="costo">Costo</label>
            <input value="<?php echo $producto->costo; ?>" name="costo" autocomplete="off" required type="number" class="form-control" id="costo" placeholder="Costo especificado en USD">
        </div>
        <div class="form-group">
            <label for="tiempoEnMinutos">Tiempo</label>
            <input value="<?php echo $producto->tiempoEnMinutos; ?>" name="tiempoEnMinutos" autocomplete="off" required type="number" class="form-control" id="tiempoEnMinutos" placeholder="Cantidad de tiempo que tomará la entrega del producto">
        </div>
        <div class="form-group">
            <label for="multiplicador">Especificado en</label>
            <select required class="form-control" name="multiplicador" id="multiplicador">
                <option <?php echo strval($producto->multiplicador) === "1" ? "selected" : "" ?> value="1">Minutos
                </option>
                <option <?php echo strval($producto->multiplicador) === "60" ? "selected" : "" ?> value="60">Horas
                </option>
                <option <?php echo strval($producto->multiplicador) === "1440" ? "selected" : "" ?> value="1440">Días
                </option>
                <option <?php echo strval($producto->multiplicador) === "10080" ? "selected" : "" ?> value="10080">
                    Semanas (7 días)
                </option>
                <option <?php echo strval($producto->multiplicador) === "43200" ? "selected" : "" ?> value="43200">Meses
                    (30 días)
                </option>
                <option <?php echo strval($producto->multiplicador) === "518400" ? "selected" : "" ?> value="518400">
                    Años (12 meses)
                </option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-success" href="<?php echo BASE_URL ?>/?p=detalles_caracteristicas_cotizacion&id=<?php echo $_GET["idCotizacion"] ?>">&larr;
            Volver</a>
    </form>
</div>