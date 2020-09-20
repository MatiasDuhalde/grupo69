-- delete previous tables

DROP TABLE if exists puertos cascade;
DROP TABLE if exists instalaciones cascade;
DROP TABLE if exists puerto_instalacion cascade;
DROP TABLE if exists personal cascade;
DROP TABLE if exists jefe_instalacion cascade;
DROP TABLE if exists trabaja_en cascade;
DROP TABLE if exists cierres cascade;
DROP TABLE if exists barcos cascade;
DROP TABLE if exists permisos cascade;
DROP TABLE if exists permisos_astillero cascade;
DROP TABLE if exists permisos_muelle cascade;
DROP TABLE if exists atraca_en cascade;


-- create tables

CREATE TABLE puertos (
    puerto_id   SERIAL PRIMARY KEY,
    nombre      VARCHAR(255) NOT NULL,
    ciudad      VARCHAR(255) NOT NULL,
    region      VARCHAR(255) NOT NULL
);

CREATE TABLE instalaciones (
    instalacion_id  SERIAL PRIMARY KEY,
    tipo            VARCHAR(255) NOT NULL,
    capacidad       INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE puerto_instalacion (
    puerto_id       INTEGER NOT NULL REFERENCES puertos (puerto_id),
    instalacion_id  INTEGER NOT NULL REFERENCES instalaciones (instalacion_id)
);

CREATE TABLE personal (
    rut     VARCHAR(255) PRIMARY KEY NOT NULL,
    nombre  VARCHAR(255) NOT NULL,
    edad    INT NOT NULL,
    sexo    VARCHAR(255) NOT NULL
);

CREATE TABLE jefe_instalacion (
    instalacion_id  INTEGER NOT NULL REFERENCES instalaciones (instalacion_id),
    rut             VARCHAR(255) NOT NULL REFERENCES personal (rut)
);

CREATE TABLE trabaja_en (
    rut             VARCHAR(255) NOT NULL REFERENCES personal (rut),
    instalacion_id  INTEGER NOT NULL REFERENCES instalaciones (instalacion_id)
);

CREATE TABLE cierres (
    cierre_id           SERIAL PRIMARY KEY,
    instalacion_id      INTEGER NOT NULL REFERENCES instalaciones (instalacion_id),
    rut                 VARCHAR(255) NOT NULL REFERENCES personal (rut),
    fecha_cierre        DATE NOT NULL,
    fecha_reapertura    DATE
);

CREATE TABLE barcos (
    patente VARCHAR(255) PRIMARY KEY NOT NULL,
    pais    VARCHAR(255) NOT NULL,
    nombre  VARCHAR(255) NOT NULL
);

CREATE TABLE permisos (
    permiso_id      SERIAL PRIMARY KEY,
    fecha_atraque   DATE NOT NULL
);

-- está bien poner herencia así?? (IsA)
-- se puede usar INHERITS (permisos)
-- es necesario? qué cosas cambiarían?
-- esto ahorarría joins!
-- sin embargo, cambiaría la forma de introducir datos!
-- https://www.postgresql.org/docs/current/ddl-inherit.html

CREATE TABLE permisos_astillero (
    p_astillero_id  SERIAL PRIMARY KEY,
    permiso_id      INTEGER NOT NULL REFERENCES permisos (permiso_id),
    fecha_salida    DATE
);

CREATE TABLE permisos_muelle (
    p_muelle_id SERIAL PRIMARY KEY,
    permiso_id  INTEGER NOT NULL REFERENCES permisos (permiso_id),
    descripcion TEXT
);

CREATE TABLE atraca_en (
    permiso_id      INTEGER NOT NULL REFERENCES permisos (permiso_id),
    instalacion_id  INTEGER NOT NULL REFERENCES instalaciones (instalacion_id),
    patente         VARCHAR(255) NOT NULL REFERENCES barcos (patente)
);
