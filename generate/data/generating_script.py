import json
from entities import (Puerto, Instalacion, Persona, Cierre, Barco,
                      PermisoAstillero, PermisoMuelle)
from output import dump_puertos






if __name__ == "__main__":

    with open("puertos.json", "r") as json_file:
        data = json.load(json_file)
    puertos = []
    for nombre, ciudad, region in data['puertos']:
        puerto = Puerto(nombre, ciudad, region)
        puertos.append(puerto)
    dump_puertos(puertos)
        
