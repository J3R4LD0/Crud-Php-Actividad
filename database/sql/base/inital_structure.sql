CREATE TABLE proyectos (
    id SERIAL PRIMARY KEY,
    codigo VARCHAR(255),
    nombre VARCHAR(255),
    descripcion VARCHAR(255),
    fecha_inicio VARCHAR(255),
    fecha_finalizacion VARCHAR(255),
    codigo_empresa VARCHAR(255)
);
