<?php

namespace Routes;

use App\Controllers\ProyectosController;
use Flight;


class Api {

    static public function handle() {
 
    
        Flight::route('GET /', function () {
            echo 'hello world! desde api';
        });

        Flight::route('GET /proyectos', function () {

           $data = ProyectosController::get();
           echo json_encode($data);
           
        });

        Flight::route('POST /proyectos', function () {
            $data = Flight::request()->data->getData();
            $result = ProyectosController::insert($data);
            if (isset($result['status']) && $result['status'] === 'error') {
                // Devolver un error en caso de fallo
                echo json_encode(['status' => 'error', 'message' => $result['message']]);
            } else {
                echo json_encode(['status' => 'success']);
            }
        });

        Flight::route('DELETE /proyectos/@id', function ($id) {

            $result = ProyectosController::delete($id);
            p($result);

            if (isset($result['status']) && $result['status'] === 'error') {
                // Devolver un error en caso de fallo
                echo json_encode(['status' => 'error', 'message' => $result['message']]);
            } else {
                echo json_encode(['status' => 'success']);
            }
        });
        Flight::route('POST /proyectos/@id', function ($id) {
            $data = Flight::request()->data->getData(); // Obtener los datos
            $result = ProyectosController::update($id, $data);
            exit; // Detener la ejecución para ver los datos
        
            // Verifica si $data está vacío
            if (empty($data)) {
                echo json_encode(['status' => 'error', 'message' => 'No se recibieron datos.']);
                return; // Asegúrate de salir después de enviar la respuesta
            }
        
            // Aquí puedes continuar con la lógica para actualizar el proyecto
            $result = ProyectosController::update($id, $data);
        
            // Asegúrate de devolver una respuesta JSON
            echo json_encode($result);
        });

 
     }
 
 }
 