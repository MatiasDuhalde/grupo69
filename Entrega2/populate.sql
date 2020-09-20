-- \copy regiones(region_id, nombre) FROM 'datos/output/regiones.csv' DELIMITER ',' CSV HEADER;
-- \copy ciudades(ciudad_id, nombre) FROM 'datos/output/ciudades.csv' DELIMITER ',' CSV HEADER;
-- \copy region_ciudad(region_id, ciudad_id) FROM 'datos/output/region_ciudad.csv' DELIMITER ',' CSV HEADER;
-- \copy puertos(puerto_id, nombre) FROM 'datos/output/puertos.csv' DELIMITER ',' CSV HEADER;
-- \copy ciudad_puerto(ciudad_id, puerto_id) FROM 'datos/output/ciudad_puerto.csv' DELIMITER ',' CSV HEADER;
-- \copy instalaciones(instalacion_id, tipo, capacidad) FROM 'datos/output/instalaciones.csv' DELIMITER ',' CSV HEADER;
-- \copy puerto_instalacion(puerto_id, instalacion_id) FROM 'datos/output/puerto_instalacion.csv' DELIMITER ',' CSV HEADER;
-- \copy personal(rut, nombre, edad, sexo) FROM 'datos/output/personal.csv' DELIMITER ',' CSV HEADER;
-- \copy jefe_instalacion(instalacion_id, rut) FROM 'datos/output/jefe_instalacion.csv' DELIMITER ',' CSV HEADER;
-- \copy trabaja_en(rut, instalacion_id) FROM 'datos/output/trabaja_en.csv' DELIMITER ',' CSV HEADER;
-- \copy cierres(cierre_id, instalacion_id, rut, fecha_cierre, fecha_reapertura) FROM 'datos/output/cierres.csv' DELIMITER ',' CSV HEADER;
-- \copy barcos(patente, pais, nombre) FROM 'datos/output/barcos.csv' DELIMITER ',' CSV HEADER;
-- \copy permisos(permiso_id, fecha_atraque) FROM 'datos/output/permisos.csv' DELIMITER ',' CSV HEADER;
-- \copy permisos_astillero(p_astillero_id, permiso_id, fecha_salida) FROM 'datos/output/permisos_astillero.csv' DELIMITER ',' CSV HEADER;
-- \copy permisos_muelle(p_muelle_id, permiso_id, descripcion) FROM 'datos/output/permisos_muelle.csv' DELIMITER ',' CSV HEADER;
-- \copy atraca_en(permiso_id, instalacion_id, patente) FROM 'datos/output/atraca_en.csv' DELIMITER ',' CSV HEADER;

-- Update serials
SELECT setval('cierres_cierre_id_seq', (SELECT MAX(cierre_id) FROM cierres));
SELECT setval('ciudades_ciudad_id_seq', (SELECT MAX(ciudad_id) FROM ciudades));
SELECT setval('instalaciones_instalacion_id_seq', (SELECT MAX(instalacion_id) FROM instalaciones));
SELECT setval('permisos_astillero_p_astillero_id_seq', (SELECT MAX(p_astillero_id) FROM permisos_astillero));
SELECT setval('permisos_muelle_p_muelle_id_seq', (SELECT MAX(p_muelle_id) FROM permisos_muelle));
SELECT setval('permisos_permiso_id_seq', (SELECT MAX(permiso_id) FROM permisos));
SELECT setval('puertos_puerto_id_seq', (SELECT MAX(puerto_id) FROM puertos));
SELECT setval('regiones_region_id_seq', (SELECT MAX(region_id) FROM regiones));
