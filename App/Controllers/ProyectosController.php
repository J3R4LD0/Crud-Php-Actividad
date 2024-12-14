<?php 
namespace App\Controllers;

use App\Models\Proyectos;

class ProyectosController{

    static function get(){
        // Obtener todos los proyectos
        $proyectos = Proyectos::all();
        
        // Crear un array para almacenar los datos
        $result = [];
        
        // Recorrer los proyectos y construir el array
        foreach ($proyectos as $proyecto) {
            $result[] = [
                'id' => $proyecto->id,
                'codigo' => $proyecto->codigo,
                'nombre' => $proyecto->nombre,
                'descripcion' => $proyecto->descripcion,
                'fecha_inicio' => $proyecto->fecha_inicio,
                'fecha_finalizacion' => $proyecto->fecha_finalizacion,
                'codigo_empresa' => $proyecto->codigo_empresa,
            ];
        }
        
        // Retornar el resultado como JSON
         echo json_encode($result);
         die;
    }

    static function insert($data){
        try {
             Proyectos::create($data);
             self::get();
             die;
        } catch (\Exception $e) {
            // Manejo de errores: devolver un mensaje de error
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    static function delete($id) {
        try {
            // Consulta SQL para eliminar el proyecto por ID
            $sql = "DELETE FROM proyectos WHERE id =  $id";
        
            
            // Llamar a la función consultar con la consulta SQL
            $result = consultar($sql);
            
            if ($result) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'error', 'message' => 'No se pudo eliminar el proyecto o el proyecto no fue encontrado'];
            }
        } catch (\Exception $e) {
            // Manejo de errores: devolver un mensaje de error
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    static function update($id, $data) {
        try {

            // p($data);
            // Consulta SQL para actualizar el proyecto por ID
            $sql = "UPDATE proyectos SET 
                        codigo = '{$data['codigo']}', 
                        nombre = '{$data['nombre']}', 
                        descripcion = '{$data['descripcion']}', 
                        fecha_inicio = '{$data['fecha_inicio']}', 
                        fecha_finalizacion = '{$data['fecha_finalizacion']}', 
                        codigo_empresa = '{$data['codigo_empresa']}' 
                    WHERE id = '$id'";
            
            // Llamar a la función consultar con la consulta SQL
            $result = consultar($sql);
            
            if ($result) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'error', 'message' => 'No se pudo actualizar el proyecto'];
            }
        } catch (\Exception $e) {
            // Manejo de errores: devolver un mensaje de error
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}