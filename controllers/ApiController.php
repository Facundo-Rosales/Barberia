<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController
{
    public static function index()
    {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar(){

        // alamcena la cita y devuelve el id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar(); 

        $id = $resultado['id'];

        // alamacena la cita y e servicio
        $idServivios = explode(",", $_POST['servicios']);
        
        // almacena los servicos mediante un di
        foreach($idServivios as $idServicio){
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }
        // retornamos una respuesta
        echo json_encode(['resultado' => $resultado]);

    }
    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];

            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}
