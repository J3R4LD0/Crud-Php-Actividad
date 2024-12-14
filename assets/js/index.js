console.log("Hola mundo desde js")

// Agregar funcionalidad para insertar un proyecto y actualizar la tabla
document.getElementById('projectForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    console.log([...formData]); // Muestra los datos que se están enviando
    fetch('/api/proyectos', {
        method: 'POST',
        body: formData
    })
    .then(response =>   loadProjects())
  
});
    
function loadProjects() {
    fetch('/api/proyectos')
    .then(response => response.json())
    .then(data => {
        const tableBody = document.getElementById('projectsTable').querySelector('tbody');
        tableBody.innerHTML = ''; // Limpiar tabla
        data.forEach(project => {
            const row = `<tr>
                <td>${project.id}</td>
                <td>${project.codigo}</td>
                <td>${project.nombre}</td>
                <td>${project.descripcion}</td>
                <td>${project.fecha_inicio}</td>
                <td>${project.fecha_finalizacion}</td>
                <td>${project.codigo_empresa}</td>
                <td>
                    <button onclick="editProject(${project.id}, '${project.codigo}', '${project.nombre}', '${project.descripcion}', '${project.fecha_inicio}', '${project.fecha_finalizacion}', '${project.codigo_empresa}')">Editar</button>
                    <button onclick="deleteProject(${project.id})">Eliminar</button>
                </td>
            </tr>`;
            tableBody.innerHTML += row; // Agregar fila a la tabla
        });
    });
}

// Nueva función para eliminar un proyecto
function deleteProject(id) {
    fetch(`/api/proyectos/${id}`, {
        method: 'DELETE'
    })
    .then(response =>   loadProjects())
  
}

// Nueva función para editar un proyecto
function editProject(id, codigo, nombre, descripcion, fecha_inicio, fecha_finalizacion, codigo_empresa) {
    document.querySelector('input[name="codigo"]').value = codigo;
    document.querySelector('input[name="nombre"]').value = nombre;
    document.querySelector('input[name="descripcion"]').value = descripcion;
    document.querySelector('input[name="fecha_inicio"]').value = fecha_inicio;
    document.querySelector('input[name="fecha_finalizacion"]').value = fecha_finalizacion;
    document.querySelector('input[name="codigo_empresa"]').value = codigo_empresa;

    // Mostrar el botón de actualizar y ocultar el de insertar
    document.getElementById('insertButton').style.display = 'none';
    document.getElementById('updateButton').style.display = 'inline-block';

    // Cambiar el evento del botón de actualizar
    const updateButton = document.getElementById('updateButton');
    updateButton.onclick = function() {
        const formData = new FormData(document.getElementById('projectForm'));
        console.log([...formData]); // Muestra los datos que se están enviando
        fetch(`/api/proyectos/${id}`, {
            method: 'POST',
            body: formData
        })
        .then(response =>   loadProjects())
      
    };
}

// Función para limpiar el formulario
function clearForm() {
    document.getElementById('projectForm').reset();
    document.getElementById('insertButton').style.display = 'inline-block'; // Mostrar botón de insertar
    document.getElementById('updateButton').style.display = 'none'; // Ocultar botón de actualizar

    loadProjects();
}

// Agregar evento para el buscador
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const tableBody = document.getElementById('projectsTable').querySelector('tbody');
    const rows = tableBody.querySelectorAll('tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
        row.style.display = rowText.includes(searchTerm) ? '' : 'none'; // Mostrar u ocultar fila
    });
});

// Cargar proyectos al inicio
loadProjects();