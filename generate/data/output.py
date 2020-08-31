
def dump_puertos(puertos_list):
    with open("csv/puertos.csv", "w") as puertos_csv:
        print("nombre,ciudad,region", file=puertos_csv)
        for puerto in puertos_list:
            print(puerto.nombre, puerto.ciudad, puerto.region, file=puertos_csv, sep=",")
