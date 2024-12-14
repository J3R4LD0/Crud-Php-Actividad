<?php
namespace Routes;

use Flight;


class Web {

    static public function handle() {

        Flight::route('GET /',function (){

            $content =  <<<HTML

                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Proyectos</title>
                    <link rel="stylesheet" href="./assets/css/style.css">
                </head>
                <body>
                    
                 <h1>Proyectos</h1>

                   <div style="display:flex;  width:100%;">
                   
                    <div>
                    <input type="text" id="searchInput" placeholder="Buscar proyectos..." style="margin:10px; width: 30%;">
                        
                        <table id="projectsTable" style="width:55%;margin:10px;">
                            <thead>
                                <tr>
                                    
                                    <th>ID</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Finalización</th>
                                    <th>Código Empresa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenarán los proyectos -->
                            </tbody>
                        </table>
                    </div>

                    <form id="projectForm" style="width:40%;margin:10px;"> 
                            <h1>Crear Proyecto</h1>
                            <input type="text" name="codigo" placeholder="Código del proyecto" required>
                            <input type="text" name="nombre" placeholder="Nombre del proyecto" required>
                            <input type="text" name="descripcion" placeholder="Descripción del proyecto">
                            <input type="date" name="fecha_inicio" placeholder="Fecha de inicio">
                            <input type="date" name="fecha_finalizacion" placeholder="Fecha de finalización">
                            <input type="text" name="codigo_empresa" placeholder="Código de la empresa" required>
                            <button type="submit" id="insertButton">Insertar Proyecto</button>
                            <button type="button" id="updateButton" style="display:none;">Actualizar Proyecto</button>
                            <button type="button" onclick="clearForm()">Limpiar</button>
                        </form>
                   </div>

                 <script src="./assets/js/index.js"></script>

                </body>
                </html>
            HTML;
          
            echo  $content;
        } );
        

    }

}
