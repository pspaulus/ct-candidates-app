def reproducir_cancion(sonido):
    cancion1 = ["brr", "fiu", "cric-cric", "brrah"]
    cancion2 = ["pep", "birip", "trri-trri", "croac"]
    cancion3 = ["bri-bri", "plop", "cric-cric", "brrah"]

    # Verifica en qué canción se encuentra el sonido dado
    if sonido in cancion1:
        index = cancion1.index(sonido)
        return cancion1[index + 1:]
    elif sonido in cancion2:
        index = cancion2.index(sonido)
        return cancion2[index + 1:]
    elif sonido in cancion3:
        index = cancion3.index(sonido)
        return cancion3[index + 1:]
    else:
        # Si el sonido no coincide con ninguna canción, no reproduce nada
        return []

#Uso
sonido_input = input("Ingrese un sonido: ")

resultados = reproducir_cancion(sonido_input)

if resultados:
    print("Reproduciendo:", ", ".join(resultados))
else:
    print("No se reproduce nada para el sonido dado.")
