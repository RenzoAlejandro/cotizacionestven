<?php
if (
    empty($_POST["idProducto"])
    ||
    empty($_POST["idCotizacion"])
    ||
    empty($_POST["producto"])
    ||
    empty($_POST["costo"])
    ||
    empty($_POST["tiempoEnMinutos"])
    ||
    empty($_POST["multiplicador"])
    ||
    empty($_POST["tokenCSRF"])
) {
    exit("Uno o más datos no fueron enviados");
}
Utiles::salirSiTokenCSRFNoCoincide($_POST["tokenCSRF"]);

Cotizaciones::actualizarProducto(
    $_POST["idProducto"],
    $_POST["producto"],
    $_POST["costo"],
    $_POST["tiempoEnMinutos"],
    $_POST["multiplicador"]
);
Utiles::redireccionar("detalles_caracteristicas_cotizacion&id=" . $_POST["idCotizacion"]);
