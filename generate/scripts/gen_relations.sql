CREATE TABLE puertos (
    id          SERIAL PRIMARY KEY,
    nombre      VARCHAR(255) NOT NULL,
    ciudad      VARCHAR(255) NOT NULL,
    region      VARCHAR(255) NOT NULL
);

CREATE TABLE instalaciones (
    id          SERIAL PRIMARY KEY,
    tipo        VARCHAR(255) NOT NULL,
    capacidad   INTEGER NOT NULL DEFAULT 0,
    id_personal INTEGER NOT NULL,           --jefe de instalación
    id_puerto   INTEGER NOT NULL            --puerto que contiene instalación
);

CREATE TABLE cierre_de_instalaciones (
    id                  SERIAL PRIMARY KEY,
    id_instalacion      INTEGER NOT NULL,   --instalación a cerrar
    id_personal         INTEGER NOT NULL,   --persona a cargo de cerrar
    fecha_cierre        DATE NOT NULL,      --date
    fecha_reapertura    DATE
);

CREATE TABLE personal (
    id              SERIAL PRIMARY KEY,
    nombre          VARCHAR(255) NOT NULL,
    rut             VARCHAR(255) NOT NULL,  --colocar en una re??
    edad            INTEGER NOT NULL,       --limitar rango -> smallint??
    sexo            INTEGER NOT NULL,       -- 0 -> m, 1 -> f
    id_instalacion  INTEGER NOT NULL        --instalación en la cual trabaja
);

CREATE TABLE barcos (
    id      SERIAL PRIMARY KEY,
    pais    VARCHAR(255) NOT NULL,
    nombre  VARCHAR(255) NOT NULL,
    patente VARCHAR(255) NOT NULL           --mismas consideraciones que rut??
);

CREATE TABLE permisos_astillero (
    id              SERIAL PRIMARY KEY,     --forzar impar: IDENTITY?? ALTER SEQUENCE??
    id_instalacion  INTEGER NOT NULL,       --DEBE SER ASTILLERO
    id_barco        INTEGER NOT NULL,
    fecha_atraque   DATE NOT NULL,
    fecha_salida    DATE NOT NULL
);

CREATE TABLE permisos_muelle (
    id              SERIAL PRIMARY KEY,     --forzar par: IDENTITY?? ALTER SEQUENCE??
    id_instalacion  INTEGER NOT NULL,       --DEBE SER MUELLE
    id_barco        INTEGER NOT NULL,
    fecha_atraque   DATE NOT NULL,
    descripcion     TEXT
);

ALTER SEQUENCE permisos_astillero_id_seq INCREMENT BY 2 MINVALUE 1 START WITH 1 RESTART WITH 1;

ALTER SEQUENCE permisos_muelle_id_seq INCREMENT BY 2 MINVALUE 2 START WITH 2 RESTART WITH 2;