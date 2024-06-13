const lista = [
    ["brr", "fiu", "cric-cric", "brrah"],
    ["pep", "birip", "trri-trri", "croac"],
    ["bri-bri", "plop", "cric-cric", "brrah"],
];

function returnSound(sound) {
    let newList = [];
    let index = 0;

    for (let i = 0; i < lista.length; i++) {
        index = lista[i].indexOf(sound);
        if (index !== -1) {
            newList = lista[i];
            break;
        }
    }
    return newList.slice(index + 1);
}

const reproducir = ["brr", "birip", "plop", "croac", "brrah"];

reproducir.forEach((item) => {
    console.log({ ingreso: item, reproduciendo: returnSound(item) });
});
