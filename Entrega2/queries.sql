-- Query 1
SELECT nombre, ciudad, region FROM puertos;

-- Query 2
SELECT personal.rut, personal.nombre, edad, sexo, jefe_instalacion.instalacion_id FROM personal
INNER JOIN jefe_instalacion
ON personal.rut = jefe_instalacion.rut
INNER JOIN puerto_instalacion
ON jefe_instalacion.instalacion_id = puerto_instalacion.instalacion_id
INNER JOIN puertos
ON puerto_instalacion.puerto_id = puertos.puerto_id
WHERE puertos.nombre = 'Mejillones';

-- Query 3
SELECT DISTINCT puertos.nombre, puertos.ciudad, puertos.region FROM puertos
INNER JOIN puerto_instalacion
ON puertos.puerto_id = puerto_instalacion.puerto_id
INNER JOIN instalaciones
ON instalaciones.instalacion_id = puerto_instalacion.instalacion_id
WHERE instalaciones.tipo = 'astillero';

