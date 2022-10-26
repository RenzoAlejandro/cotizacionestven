<?php

class Mensajes
{
    public static function guardar($remitente, $mensajePresentacion, $mensajeAgradecimiento, $mensajePie)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("update mensajes set
        remitente = ?,
        mensajePresentacion = ?,
        mensajeAgradecimiento = ?,
        mensajePie = ? 
        where idUsuario = ?");
        return $sentencia->execute([$remitente, $mensajePresentacion, $mensajeAgradecimiento, $mensajePie, SesionService::obtenerIdUsuarioLogueado()]);
    }

    public static function obtener()
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select remitente, mensajePresentacion, mensajeAgradecimiento, mensajePie from mensajes where idUsuario = ?;");
        $sentencia->execute([SesionService::obtenerIdUsuarioLogueado()]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
}

?>