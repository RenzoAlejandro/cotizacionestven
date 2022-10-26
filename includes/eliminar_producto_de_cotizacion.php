<?php
if (
    empty($_GET["idProducto"])
    ||
    empty($_GET["tokenCSRF"])
    ||
    empty($_GET["idCotizacion"])
) {
    exit("Uno o más parámetros no fueron proporcionados");
}
Utiles::salirSiTokenCSRFNoCoincide($_GET["tokenCSRF"]);
Cotizaciones::eliminarProducto($_GET["idProducto"]);
Utiles::redireccionar("detalles_caracteristicas_cotizacion&id=" . $_GET["idCotizacion"]);
