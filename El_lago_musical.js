const songs = [
    ["brr", "fiu", "cric-cric", "brrah"],
    ["pep", "birip", "trri-trri", "croac"],
    ["bri-bri", "plop", "cric-cric", "brrah"],
];

function returnSound(sound) {
    let newList = [];
    let index = 0;

    for (let i = 0; i < songs.length; i++) {
        index = songs[i].indexOf(sound);
        if (index !== -1) {
            newList = songs[i];
            break;
        }
    }
    return newList.slice(index + 1);
}

const tests = ["brr", "birip", "plop", "croac", "brrah"];

tests.forEach((item) => {
    console.log({ test: item, song: returnSound(item) });
});
