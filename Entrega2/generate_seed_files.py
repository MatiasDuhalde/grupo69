import pandas as pd
import numpy as np

PATH_PERMISOS_CSV = "datos/Impares/permisos.csv"
PATH_PERSONAL_INSTALACION_CSV = "datos/Impares/personal_instalacion.csv"
PATH_PUERTOS_CSV = "datos/Impares/puertos.csv"


if __name__ == "__main__":

    # load puertos.csv
    puertos_df = pd.read_csv(PATH_PUERTOS_CSV, sep=",", header=0,
        delimiter=None, names=None, index_col=None, usecols=None,
        squeeze=False, prefix=None, mangle_dupe_cols=True, dtype=None,
        engine="python", converters=None, true_values=None, false_values=None,
        skipinitialspace=False, skiprows=None, skipfooter=0, nrows=None,
        na_values=None, keep_default_na=True, na_filter=True, verbose=True,
        skip_blank_lines=True, parse_dates=["fecha_cierre", "fecha_apertura"],
        infer_datetime_format=True, keep_date_col=False, date_parser=None,
        dayfirst=True, cache_dates=True, iterator=False, chunksize=None,
        compression="infer", thousands=None, decimal=".", lineterminator=None,
        quotechar='"', quoting=0, doublequote=True, escapechar=None,
        comment=None, encoding=None, dialect=None, error_bad_lines=True,
        warn_bad_lines=True, delim_whitespace=False, low_memory=True,
        memory_map=False, float_precision=None)

    # print(puertos_df)

    # load permisos.csv
    permisos_df = pd.read_csv(PATH_PERMISOS_CSV, sep=",", header=0,
        delimiter=None, names=None, index_col=None, usecols=None,
        squeeze=False, prefix=None, mangle_dupe_cols=True, dtype=None,
        engine="python", converters=None, true_values=None, false_values=None,
        skipinitialspace=False, skiprows=None, skipfooter=0, nrows=None,
        na_values=None, keep_default_na=True, na_filter=True, verbose=True,
        skip_blank_lines=True, parse_dates=["fecha_atraque", "fecha_salida"],
        infer_datetime_format=True, keep_date_col=False, date_parser=None,
        dayfirst=True, cache_dates=True, iterator=False, chunksize=None,
        compression="infer", thousands=None, decimal=".", lineterminator=None,
        quotechar='"', quoting=0, doublequote=True, escapechar=None,
        comment=None, encoding=None, dialect=None, error_bad_lines=True,
        warn_bad_lines=True, delim_whitespace=False, low_memory=True,
        memory_map=False, float_precision=None)

    # print(permisos_df)

    # load personal_instalacion.csv
    personal_instalacion_df = pd.read_csv(PATH_PERSONAL_INSTALACION_CSV, 
        sep=",", header=0, delimiter=None, names=None, index_col=None, usecols=None,
        squeeze=False, prefix=None, mangle_dupe_cols=True, dtype=None,
        engine="python", converters=None, true_values=None, false_values=None,
        skipinitialspace=False, skiprows=None, skipfooter=0, nrows=None,
        na_values=None, keep_default_na=True, na_filter=True, verbose=True,
        skip_blank_lines=True, parse_dates=None,
        infer_datetime_format=True, keep_date_col=False, date_parser=None,
        dayfirst=True, cache_dates=True, iterator=False, chunksize=None,
        compression="infer", thousands=None, decimal=".", lineterminator=None,
        quotechar='"', quoting=0, doublequote=True, escapechar=None,
        comment=None, encoding=None, dialect=None, error_bad_lines=True,
        warn_bad_lines=True, delim_whitespace=False, low_memory=True,
        memory_map=False, float_precision=None)

    # print(personal_instalacion_df)

    # REGIONES
    regiones_out_df = puertos_df[["region_puerto"]]
    new_headers = {"region_puerto": "nombre"}
    regiones_out_df = regiones_out_df.rename(columns=new_headers)
    regiones_out_df.drop_duplicates(inplace=True, ignore_index=True)
    regiones_out_df.index.rename("region_id", inplace=True)
    print(regiones_out_df)
    regiones_out_df.to_csv("datos/output/regiones.csv")

    # CIUDADES
    ciudades_out_df = puertos_df[["ciudad_puerto"]]
    new_headers = {"ciudad_puerto": "nombre"}
    ciudades_out_df = ciudades_out_df.rename(columns=new_headers)
    ciudades_out_df.drop_duplicates(inplace=True, ignore_index=True)
    ciudades_out_df.index.rename("ciudad_id", inplace=True)
    print(ciudades_out_df)
    ciudades_out_df.to_csv("datos/output/ciudades.csv")

    # REGION_CIUDAD
    region_ciudad_df = pd.merge(puertos_df, ciudades_out_df.reset_index(), how="inner",
        left_on=["ciudad_puerto"],
        right_on=["nombre"])
    region_ciudad_df = pd.merge(region_ciudad_df, regiones_out_df.reset_index(), how="inner",
        left_on=["region_puerto"],
        right_on=["nombre"])
    region_ciudad_df = region_ciudad_df[["region_id", "ciudad_id"]]
    region_ciudad_df.drop_duplicates(inplace=True, ignore_index=True)
    region_ciudad_df.reset_index(inplace=True, drop=True)
    print(region_ciudad_df)
    region_ciudad_df.to_csv("datos/output/region_ciudad.csv", index=False)

    # PUERTOS
    puertos_out_df = puertos_df[["nombre_puerto"]]
    new_headers = {"nombre_puerto": "nombre"}
    puertos_out_df = puertos_out_df.rename(columns=new_headers)
    puertos_out_df.drop_duplicates(inplace=True, ignore_index=True)
    puertos_out_df.index.rename("puerto_id", inplace=True)
    print(puertos_out_df)
    puertos_out_df.to_csv("datos/output/puertos.csv")

    # CIUDAD_PUERTO
    ciudad_puerto_df = pd.merge(puertos_df, ciudades_out_df.reset_index(), how="inner",
        left_on=["ciudad_puerto"],
        right_on=["nombre"])
    ciudad_puerto_df = pd.merge(ciudad_puerto_df, puertos_out_df.reset_index(), how="inner",
        left_on=["nombre_puerto"],
        right_on=["nombre"])
    ciudad_puerto_df = ciudad_puerto_df[["ciudad_id", "puerto_id"]]
    ciudad_puerto_df.drop_duplicates(inplace=True, ignore_index=True)
    ciudad_puerto_df.reset_index(inplace=True, drop=True)
    print(ciudad_puerto_df)
    ciudad_puerto_df.to_csv("datos/output/ciudad_puerto.csv", index=False)

    # INSTALACIONES
    instalaciones_out_df = puertos_df[["id_instalacion", "tipo_instalacion", "capacidad_instalacion"]]
    new_headers = {"id_instalacion": "instalacion_id", "tipo_instalacion": "tipo", "capacidad_instalacion": "capacidad"}
    instalaciones_out_df = instalaciones_out_df.rename(columns=new_headers)
    instalaciones_out_df.drop_duplicates(inplace=True, ignore_index=True)
    instalaciones_out_df.set_index("instalacion_id", inplace=True)
    instalaciones_out_df.sort_index(inplace=True)
    print(instalaciones_out_df)
    instalaciones_out_df.to_csv("datos/output/instalaciones.csv", index=True)

    # PUERTO_INSTALACION
    puerto_instalacion_df = pd.merge(puertos_out_df.reset_index(), puertos_df, how="inner",
        right_on=["nombre_puerto"],
        left_on=["nombre"])
    puerto_instalacion_df = puerto_instalacion_df[["puerto_id", "id_instalacion"]]
    puerto_instalacion_df.drop_duplicates(inplace=True, ignore_index=True)
    puerto_instalacion_df.rename(columns={"id_instalacion": "instalacion_id"}, inplace=True)
    print(puerto_instalacion_df)
    puerto_instalacion_df.to_csv("datos/output/puerto_instalacion.csv", index=False)

    # PERSONAL
    personal_out_df = personal_instalacion_df[["rut", "nombre", "edad", "sexo"]]
    personal_out_df = personal_out_df.sort_values(by="rut", axis=0)
    print(personal_out_df)
    personal_out_df.to_csv("datos/output/personal.csv", index=False)

    # JEFE_INSTALACION
    jefe_instalacion_df = puertos_df[["id_instalacion", "rut_jefe"]]
    new_headers = {"id_instalacion": "instalacion_id", "rut_jefe": "rut"}
    jefe_instalacion_df = jefe_instalacion_df.rename(columns=new_headers)
    jefe_instalacion_df.drop_duplicates(inplace=True, ignore_index=True)
    jefe_instalacion_df.set_index("instalacion_id", inplace=True)
    jefe_instalacion_df.sort_index(inplace=True)
    print(jefe_instalacion_df)
    jefe_instalacion_df.to_csv("datos/output/jefe_instalacion.csv", index=True)

    # TRABAJA_EN
    trabaja_en_df = personal_instalacion_df[["rut", "id_instalacion"]]
    new_headers = {"id_instalacion": "instalacion_id"}
    trabaja_en_df = trabaja_en_df.rename(columns=new_headers)
    trabaja_en_df.set_index("rut", inplace=True)
    trabaja_en_df.sort_index(inplace=True)
    print(trabaja_en_df)
    trabaja_en_df.to_csv("datos/output/trabaja_en.csv", index=True)

    # CIERRES
    cierres_df = puertos_df[["id_instalacion", "rut_jefe_cierre", "fecha_cierre", "fecha_apertura"]]
    new_headers = {"id_instalacion": "instalacion_id", "rut_jefe_cierre": "rut",
        "fecha_apertura": "fecha_reapertura"}
    cierres_df = cierres_df.rename(columns=new_headers)
    cierres_df.sort_values(by="fecha_cierre", axis=0, inplace=True)
    cierres_df.reset_index(drop=True, inplace=True)
    cierres_df.index.rename("cierre_id", inplace=True)
    # cierres_df.drop_duplicates(inplace=True, ignore_index=True)
    print(cierres_df)
    cierres_df.to_csv("datos/output/cierres.csv", index=True)

    # BARCOS
    barcos_df = permisos_df[["patente_barco", "pais", "nombre_barco"]]
    new_headers = {"patente_barco": "patente", "nombre_barco": "nombre"}
    barcos_df = barcos_df.rename(columns=new_headers)
    barcos_df.set_index("patente", inplace=True)
    barcos_df.drop_duplicates(inplace=True)
    barcos_df.sort_index(inplace=True)
    print(barcos_df)
    barcos_df.to_csv("datos/output/barcos.csv", index=True)

    # PERMISOS
    permisos_out_df = permisos_df[["fecha_atraque"]]
    permisos_out_df = permisos_out_df.drop_duplicates(ignore_index=True)
    permisos_out_df.sort_values(by="fecha_atraque", axis=0, inplace=True)
    permisos_out_df.reset_index(drop=True, inplace=True)
    permisos_out_df.index.rename("permiso_id", inplace=True)
    print(permisos_out_df)
    permisos_out_df.to_csv("datos/output/permisos.csv", index=True)

    # PERMISOS_ASTILLERO
    permisos_astillero_df = pd.merge(permisos_out_df.reset_index(), permisos_df, how="inner",
        on="fecha_atraque")
    permisos_astillero_df = permisos_astillero_df[["permiso_id", "fecha_salida"]]
    permisos_astillero_df.dropna(axis=0, inplace=True)
    permisos_astillero_df.reset_index(drop=True, inplace=True)
    permisos_astillero_df.index.rename("p_astillero_id", inplace=True)
    print(permisos_astillero_df)
    permisos_astillero_df.to_csv("datos/output/permisos_astillero.csv", index=True)

    # PERMISOS_MUELLE
    permisos_muelle_df = pd.merge(permisos_out_df.reset_index(), permisos_df, how="inner",
        on="fecha_atraque")
    permisos_muelle_df = permisos_muelle_df[["permiso_id", "descripcion_actividad"]]
    permisos_muelle_df.rename(columns={"descripcion_actividad": "descripcion"}, inplace=True)
    permisos_muelle_df.dropna(axis=0, inplace=True)
    permisos_muelle_df.reset_index(drop=True, inplace=True)
    permisos_muelle_df.index.rename("p_muelle_id", inplace=True)
    print(permisos_muelle_df)
    permisos_muelle_df.to_csv("datos/output/permisos_muelle.csv", index=True)

    # ATRACA_EN
    atraca_en_df = pd.merge(permisos_out_df.reset_index(), permisos_df, how="inner",
        on="fecha_atraque")
    atraca_en_df = atraca_en_df[["permiso_id", "id_instalacion", "patente_barco"]]
    new_headers = {"id_instalacion": "instalacion_id", "patente_barco": "patente"}
    atraca_en_df = atraca_en_df.rename(columns=new_headers)
    atraca_en_df.set_index("permiso_id", drop=True, inplace=True)
    print(atraca_en_df)
    atraca_en_df.to_csv("datos/output/atraca_en.csv", index=True)
