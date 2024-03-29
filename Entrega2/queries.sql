-- Query 1
SELECT ciudades.ciudad_id, ciudades.nombre, puertos.puerto_id, puertos.nombre FROM puertos
INNER JOIN ciudad_puerto
ON ciudad_puerto.puerto_id = puertos.puerto_id
INNER JOIN ciudades
ON ciudad_puerto.ciudad_id = ciudades.ciudad_id;

-- Query 2 (mejillones es puerto)
SELECT personal.rut, personal.nombre, edad, sexo, jefe_instalacion.instalacion_id FROM personal
INNER JOIN jefe_instalacion
ON personal.rut = jefe_instalacion.rut
INNER JOIN puerto_instalacion
ON jefe_instalacion.instalacion_id = puerto_instalacion.instalacion_id
INNER JOIN puertos
ON puerto_instalacion.puerto_id = puertos.puerto_id
WHERE puertos.nombre ILIKE '%Mejillones%';

-- Query 3
SELECT DISTINCT puertos.puerto_id, puertos.nombre FROM puertos
INNER JOIN puerto_instalacion
ON puertos.puerto_id = puerto_instalacion.puerto_id
INNER JOIN instalaciones
ON instalaciones.instalacion_id = puerto_instalacion.instalacion_id
WHERE instalaciones.tipo ILIKE '%astillero%';

-- Query 4 (Arica es puerto, ciudad, o región? También mostrar descripcion/fecha_salida?)
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
INNER JOIN ciudad_puerto
ON puertos.puerto_id = ciudad_puerto.puerto_id
INNER JOIN ciudades
ON ciudad_puerto.ciudad_id = ciudades.ciudad_id
WHERE barcos.nombre ILIKE '%Calypso%' AND ciudades.nombre ILIKE '%Arica%';

-- Query 5
SELECT puertos.puerto_id, puertos.nombre, AVG(personal.edad) AS promedio_edad FROM personal
INNER JOIN trabaja_en
ON personal.rut = trabaja_en.rut
INNER JOIN puerto_instalacion
ON puerto_instalacion.instalacion_id = trabaja_en.instalacion_id
INNER JOIN puertos
ON puertos.puerto_id = puerto_instalacion.puerto_id
GROUP BY puertos.puerto_id, puertos.nombre;

-- Query 6
SELECT t.nombre, barcos_atracados
FROM (SELECT puertos.nombre, COUNT(DISTINCT atraca_en.patente) AS barcos_atracados FROM puertos
      INNER JOIN puerto_instalacion
      ON puertos.puerto_id = puerto_instalacion.puerto_id
      INNER JOIN atraca_en
      ON puerto_instalacion.instalacion_id = atraca_en.instalacion_id
      INNER JOIN permisos
      ON atraca_en.permiso_id = permisos.permiso_id
      WHERE DATE_PART('month', permisos.fecha_atraque) = 8 AND
      DATE_PART('year', permisos.fecha_atraque) = 2020
      GROUP BY puertos.nombre) AS t
ORDER BY barcos_atracados DESC
LIMIT 1;
