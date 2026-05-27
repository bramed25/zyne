<?php
$nombre_pelicula = $_GET['nombre'] ?? '';
$categoria = $_GET['categoria'] ?? '';

if (!$nombre_pelicula || !$categoria) {
    die("Faltan parámetros.");
}

$ruta_prolog = __DIR__ . '/cine.pl';

// Comando para obtener el detalle de una película específica
// Separamos los datos con un delimitador seguro '||' para evitar choques con el texto de la sinopsis
$comando = '/usr/bin/swipl -q -f ' . escapeshellarg($ruta_prolog) . ' -g "obtener_detalles(\'' . $nombre_pelicula . '\', \'' . $categoria . '\', Actores, Duracion, Idioma, Anio, Sinopsis, Imagen), format(\'~w||~w||~w||~w||~w||~w~n\', [Actores, Duracion, Idioma, Anio, Sinopsis, Imagen])" -t halt.';

$salida = shell_exec($comando);

$detalle = [];
if ($salida) {
    $datos = explode("||", trim($salida));
    if (count($datos) == 6) {
        $detalle = [
            'actores' => $datos[0],
            'duracion' => $datos[1],
            'idioma' => $datos[2],
            'anio' => $datos[3],
            'sinopsis' => $datos[4],
            'imagen' => $datos[5]
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($nombre_pelicula) ?> - Detalles</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php if (!empty($detalle)): ?>
        <div class="contenedor">
            <div class="imagen-container">
                <img src="<?= htmlspecialchars($detalle['imagen']) ?>" alt="Portada">
            </div>
            <div class="info">
                <h1><?= htmlspecialchars($nombre_pelicula) ?> (<?= htmlspecialchars($detalle['anio']) ?>)</h1>
                <p><strong>Sinopsis:</strong> <?= htmlspecialchars($detalle['sinopsis']) ?></p>
                <p><strong>Actores:</strong> <?= htmlspecialchars($detalle['actores']) ?></p>
                <p><strong>Duración:</strong> <?= htmlspecialchars($detalle['duracion']) ?></p>
                <p><strong>Idioma:</strong> <?= htmlspecialchars($detalle['idioma']) ?></p>
                <a href="index.php?categoria=<?= urlencode($categoria) ?>" class="btn-volver">← Volver al Catálogo</a>
            </div>
        </div>
    <?php else: ?>
        <p>No se pudo cargar la información de la película. Verifica la conexión con la base de conocimientos.</p>
        <a href="index.php" class="btn-volver">← Volver al Catálogo</a>
    <?php endif; ?>

</body>
</html>