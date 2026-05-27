<?php
// Capturamos la categoría seleccionada (por defecto 'ciencia_ficcion')
$categoria_actual = $_GET['categoria'] ?? 'ciencia_ficcion';

// Definimos la ruta absoluta al archivo Prolog
$ruta_prolog = __DIR__ . '/cine.pl';

// Armamos el comando para la terminal
// Usamos /usr/bin/swipl (ruta habitual en Debian/Ubuntu/Fedora) para asegurar la ejecución
$comando = '/usr/bin/swipl -q -f ' . escapeshellarg($ruta_prolog) . ' -g "forall(filtrar_por_categoria(\'' . $categoria_actual . '\', N, I), format(\'~w|~w~n\', [N, I]))" -t halt.';

// Ejecutamos y capturamos la salida
$salida = shell_exec($comando); // Ejecuta un comando a través del Shell y devuelve el resultado en forma de string

// Procesamos la salida en un arreglo
$peliculas = [];
if ($salida) {
    $lineas = explode("\n", trim($salida));
    foreach ($lineas as $linea) {
        if (!empty($linea)) {
            list($nombre, $imagen) = explode("|", $linea);
            $peliculas[] = ['nombre' => $nombre, 'imagen' => $imagen];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Cine</title>
     <link rel="stylesheet" href="styles.css"> 
</head>
<body>

    <div class="filtros">
        <a href="?categoria=ciencia_ficcion" class="<?= $categoria_actual == 'ciencia_ficcion' ? 'activo' : '' ?>">Ciencia Ficción</a>
        <a href="?categoria=animacion" class="<?= $categoria_actual == 'animacion' ? 'activo' : '' ?>">Animación</a>
        <a href="?categoria=terror" class="<?= $categoria_actual == 'terror' ? 'activo' : '' ?>">Terror</a>
    </div>

    <div class="grid">
        <?php foreach ($peliculas as $peli): ?>
            <div class="tarjeta">
                <a href="detalle.php?nombre=<?= urlencode($peli['nombre']) ?>&categoria=<?= $categoria_actual ?>">
                    <img src="<?= htmlspecialchars($peli['imagen']) ?>" alt="<?= htmlspecialchars($peli['nombre']) ?>">
                    <br><?= htmlspecialchars($peli['nombre']) ?>
                </a>
            </div>
        <?php endforeach; ?>
        
        <?php if(empty($peliculas)): ?>
            <p>No se encontraron películas o hubo un error de conexión con Prolog.</p>
        <?php endif; ?>
    </div>

</body>
</html>