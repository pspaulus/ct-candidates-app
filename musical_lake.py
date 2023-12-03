songs = {
    1: ['brr', 'fiu', 'cric-cric', 'brrah'],
    2: ['pep', 'birip', 'trri-trri', 'croac'],
    3: ['bri-bri', 'plop', 'cric-cric', 'brrah']
}

def sing(song, idx):
    for sound in song[song.index(idx) + 1:]:
        print(sound)

def main():
    sound = input('Ingrese el sonido: ')
    for key, value in songs.items():
        if sound in value:
            sing(value, sound)
            break

if __name__ == '__main__':
    main()
