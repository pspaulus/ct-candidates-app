<?php

// Definimos las canciones usando arrays
$canciones = [
    ["brr", "fiu", "cric-cric", "brrah"],
    ["pep", "birip", "trri-trri", "croac"],
    ["bri-bri", "plop", "cric-cric", "brrah"]
];

// Creamos un array para almacenar los sonidos prohibidos que no deben reproducir nada
$sonidosProhibidos = ["brrah", "croac"];

// Función para buscar y reproducir los sonidos restantes de una canción dada
function reproducirSonidos($sonido) {
    global $canciones, $sonidosProhibidos;

    // Revisamos cada canción
    foreach ($canciones as $cancion) {
        // Iteramos sobre los sonidos de la canción
        for ($i = 0; $i < count($cancion); $i++) {
            // Si encontramos el sonido dado
            if ($cancion[$i] == $sonido) {
                // Si el sonido está prohibido, no reproducimos nada
                if (in_array($sonido, $sonidosProhibidos)) {
                    echo "Nada que reproducir para el sonido: $sonido\n";
                    return;
                }
                // Reproducimos los sonidos restantes
                for ($j = $i + 1; $j < count($cancion); $j++) {
                    echo $cancion[$j] . " ";
                }
                echo "\n";
                return;
            }
        }
    }
    // Si no encontramos el sonido, indicamos que no hay resultados
    echo "Sonido no encontrado en las canciones: $sonido\n";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sonido = $_POST["sonido"];
    if (!empty($sonido)) {
        echo "<h2>Resultados para el sonido: " . htmlspecialchars($sonido) . "</h2>";
        echo "<p>";
        reproducirSonidos($sonido);
        echo "</p>";
    } else {
        echo "Por favor, ingrese un sonido.";
    }
}

echo '<a href="index.html">Volver</a>';

?>
