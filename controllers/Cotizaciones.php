<?php

class Cotizaciones
{
    public static function nueva($idCliente, $descripcion, $fecha)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("insert into cotizaciones(idUsuario, idCliente, descripcion, fecha) VALUES (?, ?, ?, ?);");
        return $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $idCliente, $descripcion, $fecha]);
    }

    public static function eliminarProducto($idProducto)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("delete productos_cotizaciones
from productos_cotizaciones
       inner join cotizaciones on cotizaciones.idUsuario = ?
                                    and
                                  productos_cotizaciones.id = ?");
        return $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $idProducto]);
    }

    public static function eliminarCaracteristica($idCaracteristica)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("delete caracteristicas_cotizaciones 
from caracteristicas_cotizaciones 
inner join cotizaciones on cotizaciones.idUsuario = ? and caracteristicas_cotizaciones.id = ?;");
        return $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $idCaracteristica]);
    }

    public static function obtenerProductoPorId($idProducto)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select productos_cotizaciones.id, idCotizacion, producto, costo, tiempoEnMinutos, multiplicador
from productos_cotizaciones
       inner join cotizaciones on cotizaciones.idUsuario = ? and productos_cotizaciones.id = ?");
        $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $idProducto]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public static function obtenerCaracteristicaPorId($idCaracteristica)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select caracteristicas_cotizaciones.id, idCotizacion, caracteristica
from caracteristicas_cotizaciones
       inner join cotizaciones on cotizaciones.idUsuario = ? and caracteristicas_cotizaciones.id = ?");
        $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $idCaracteristica]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public static function productosPorId($idCotizacion)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select productos_cotizaciones.id, producto, costo, tiempoEnMinutos, multiplicador
from productos_cotizaciones
       inner join cotizaciones on cotizaciones.id = productos_cotizaciones.idCotizacion and cotizaciones.id = ?
                                    and cotizaciones.idUsuario = ?;");
        $sentencia->execute([$idCotizacion, SesionService::obtenerIdUsuarioLogueado()]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public static function caracteristicasPorId($idCotizacion)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select caracteristicas_cotizaciones.id, idCotizacion, caracteristica
from caracteristicas_cotizaciones
       inner join cotizaciones on cotizaciones.id = caracteristicas_cotizaciones.idCotizacion and cotizaciones.id = ? and cotizaciones.idUsuario = ?;");
        $sentencia->execute([$idCotizacion, SesionService::obtenerIdUsuarioLogueado()]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public static function agregarProducto($idCotizacion, $producto, $costo, $tiempoEnMinutos, $multiplicador)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("insert into productos_cotizaciones (idCotizacion, producto, costo, tiempoEnMinutos, multiplicador)
        values ((select id from cotizaciones where cotizaciones.idUsuario = ? and cotizaciones.id = ?), ?, ?, ?, ?);");
        return $sentencia->execute([
            SesionService::obtenerIdUsuarioLogueado(),
            $idCotizacion,
            $producto,
            $costo,
            $tiempoEnMinutos,
            $multiplicador
        ]);
    }

    public static function agregarCaracteristica($idCotizacion, $caracteristica)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("insert into caracteristicas_cotizaciones
        (idCotizacion, caracteristica)
        values
        ((select id from cotizaciones where cotizaciones.idUsuario = ? and cotizaciones.id = ?), ?);");
        return $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $idCotizacion, $caracteristica]);
    }

    public static function actualizarProducto($idProducto, $producto, $costo, $tiempoEnMinutos, $multiplicador)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("update productos_cotizaciones
        inner join cotizaciones on productos_cotizaciones.idCotizacion = cotizaciones.id and cotizaciones.idUsuario = ?
        set producto        = ?,
            costo           = ?,
            tiempoEnMinutos = ?,
            multiplicador   = ?
        where productos_cotizaciones.id = ?;");
        return $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $producto, $costo, $tiempoEnMinutos, $multiplicador, $idProducto]);
    }

    public static function actualizarCaracteristica($idCaracteristica, $caracteristica)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("update caracteristicas_cotizaciones
        inner join cotizaciones on caracteristicas_cotizaciones.idCotizacion = cotizaciones.id and cotizaciones.idUsuario = ?
        set
        caracteristica = ?
        where caracteristicas_cotizaciones.id = ?;");
        return $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $caracteristica, $idCaracteristica]);
    }

    public static function todas()
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select
            cotizaciones.id, clientes.razonSocial, cotizaciones.descripcion, cotizaciones.fecha
            from clientes inner join cotizaciones
            on cotizaciones.idCliente = clientes.id and cotizaciones.idUsuario = ?;");
        $sentencia->execute([SesionService::obtenerIdUsuarioLogueado()]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public static function porId($id)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select
            cotizaciones.id, clientes.razonSocial, cotizaciones.descripcion, cotizaciones.fecha, cotizaciones.idCliente
            from clientes inner join cotizaciones
            on cotizaciones.idCliente = clientes.id and cotizaciones.idUsuario = ?
            where cotizaciones.id = ?;");
        $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $id]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public static function actualizar($id, $idCliente, $descripcion, $fecha)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("update cotizaciones set
        idCliente = ?,
        descripcion = ?,
        fecha = ?
        where id = ? and idUsuario = ?");
        return $sentencia->execute([$idCliente, $descripcion, $fecha, $id, SesionService::obtenerIdUsuarioLogueado()]);
    }

    public static function eliminar($id)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("delete from cotizaciones where id = ? and idUsuario = ?;");
        return $sentencia->execute([$id, SesionService::obtenerIdUsuarioLogueado()]);
    }
}
