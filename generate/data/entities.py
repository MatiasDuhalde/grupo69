from itertools import count
from datetime import date
from rut_generator import Rut

class Puerto:

    id_counter = count(1)

    def __init__(self, nombre: str, ciudad: str, region: str):
        self.id_ = next(self.id_counter)
        self.nombre = nombre
        self.ciudad = ciudad
        self.region = region


class Instalacion:

    id_counter = count(1)

    def __init__(self, tipo: str, capacidad: int, id_personal: int,
                 id_puerto: int):
        self.id_ = next(self.id_counter)
        self.tipo = tipo
        self.capacidad = capacidad
        self.id_personal = id_personal
        self.id_puerto = id_puerto


class Cierre:

    id_counter = count(1)

    def __init__(self, id_instalacion: int, id_personal: int,
                 fecha_cierre: date, fecha_reapertura: date):
        self.id_ = next(self.id_counter)
        self.id_instalacion = id_instalacion
        self.id_personal = id_personal
        assert(fecha_cierre <= fecha_reapertura)
        self.fecha_cierre = fecha_cierre
        self.fecha_reapertura = fecha_reapertura


class Persona:

    id_counter = count(1)

    def __init__(self, nombre: str, rut: Rut, edad: int, sexo: int,
                 id_instalacion: int):
        self.id_ = next(self.id_counter)
        self.nombre = nombre
        self.rut = rut
        self.__edad = edad
        self.sexo = sexo
        self.id_instalacion = id_instalacion

    @property
    def edad(self):
        return self.__edad

    @edad.setter
    def edad(self, value):
        assert(value >= 0)
        self.__edad = value


class Barco:

    id_counter = count(1)

    def __init__(self, pais: str, nombre: str, patente: str):
        self.id_ = next(self.id_counter)
        self.pais = pais
        self.nombre = nombre
        self.patente = patente


class PermisoAstillero:

    id_counter = count(1)

    def __init__(self, id_instalacion: int, id_barco: int, fecha_atraque: date,
                 fecha_salida: date):
        self.id_ = next(self.id_counter)
        self.id_instalacion = id_instalacion
        self.id_barco = id_barco
        assert(fecha_atraque <= fecha_salida)
        self.fecha_atraque = fecha_atraque
        self.fecha_salida = fecha_salida


class PermisoMuelle:

    id_counter = count(2, 2)

    def __init__(self, id_instalacion: int, id_barco: int, fecha_atraque: date,
                 descripcion: str):
        self.id_ = next(self.id_counter)
        self.id_instalacion = id_instalacion
        self.id_barco = id_barco
        self.fecha_atraque = fecha_atraque
        self.descripcion = descripcion


if __name__ == "__main__":
    puert1 = Puerto("San Antonio", "San Antonio", "V")
    puert2 = Puerto("Valparaiso", "Valparaiso", "V")
    print(puert1.id_)
    print(puert2.id_)

    print(date(2020,10,2))
