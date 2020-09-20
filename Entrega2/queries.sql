-- Query 1
SELECT nombre, ciudad, region FROM puertos;

-- Query 2 (mejillones es puerto o ciudad?)
SELECT personal.rut, personal.nombre, edad, sexo, jefe_instalacion.instalacion_id FROM personal
INNER JOIN jefe_instalacion
ON personal.rut = jefe_instalacion.rut
INNER JOIN puerto_instalacion
ON jefe_instalacion.instalacion_id = puerto_instalacion.instalacion_id
INNER JOIN puertos
ON puerto_instalacion.puerto_id = puertos.puerto_id
WHERE puertos.nombre ILIKE 'Mejillones';

-- Query 3
SELECT DISTINCT puertos.nombre, puertos.ciudad, puertos.region FROM puertos
INNER JOIN puerto_instalacion
ON puertos.puerto_id = puerto_instalacion.puerto_id
INNER JOIN instalaciones
ON instalaciones.instalacion_id = puerto_instalacion.instalacion_id
WHERE instalaciones.tipo ILIKE 'astillero';


-- Query 4 (Arica es puerto o ciudad? También mostrar descripcion/fecha_salida?)
SELECT permisos.permiso_id, atraca_en.instalacion_id, instalaciones.tipo, permisos.fecha_atraque FROM permisos
INNER JOIN atraca_en
ON atraca_en.permiso_id = permisos.permiso_id
INNER JOIN barcos
ON barcos.patente = atraca_en.patente
INNER JOIN instalaciones
ON instalaciones.instalacion_id = atraca_en.instalacion_id
INNER JOIN puerto_instalacion
ON instalaciones.instalacion_id = puerto_instalacion.instalacion_id
INNER JOIN puertos
ON puertos.puerto_id = puerto_instalacion.puerto_id
WHERE barcos.nombre ILIKE 'Calypso' AND (puertos.nombre ILIKE 'Arica' OR puertos.ciudad ILIKE 'Arica');

-- Query 5
SELECT puertos.nombre, AVG(personal.edad) AS promedio_edad FROM personal
INNER JOIN trabaja_en
ON personal.rut = trabaja_en.rut
INNER JOIN puerto_instalacion
ON puerto_instalacion.instalacion_id = trabaja_en.instalacion_id
INNER JOIN puertos
ON puertos.puerto_id = puerto_instalacion.puerto_id
GROUP BY puertos.nombre;

-- Query 6
SELECT t.nombre, barcos_atracados
FROM (SELECT puertos.nombre, COUNT(DISTINCT atraca_en.patente) AS barcos_atracados FROM puertos
      INNER JOIN puerto_instalacion
      ON puertos.puerto_id = puerto_instalacion.puerto_id
      INNER JOIN atraca_en
      ON puerto_instalacion.instalacion_id = atraca_en.instalacion_id
      GROUP BY puertos.nombre) AS t
ORDER BY barcos_atracados DESC
LIMIT 1;
