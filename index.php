<?php
// 1. Capturamos la categoría seleccionada (por defecto 'ciencia_ficcion')
$categoria_actual = $_GET['categoria'] ?? 'ciencia_ficcion';

// 2. Definimos la ruta absoluta al archivo Prolog (vital para evitar errores en shell_exec)
$ruta_prolog = __DIR__ . '/cine.pl';

// 3. Armamos el comando para la terminal
// Usamos /usr/bin/swipl (ruta habitual en Debian/Ubuntu/Fedora) para asegurar la ejecución
$comando = '/usr/bin/swipl -q -f ' . escapeshellarg($ruta_prolog) . ' -g "forall(filtrar_por_categoria(\'' . $categoria_actual . '\', N, I), format(\'~w|~w~n\', [N, I]))" -t halt.';

// 4. Ejecutamos y capturamos la salida
$salida = shell_exec($comando);

// 5. Procesamos la salida en un arreglo
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
    <style>
        body { font-family: sans-serif; background-color: #121212; color: #fff; margin: 0; padding: 20px; }
        .filtros { text-align: center; margin-bottom: 30px; }
        .filtros a { text-decoration: none; color: #fff; background: #333; padding: 10px 20px; margin: 0 10px; border-radius: 5px; }
        .filtros a.activo { background: #e50914; }
        .grid { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .tarjeta { background: #222; border-radius: 8px; overflow: hidden; width: 200px; text-align: center; transition: transform 0.2s; }
        .tarjeta:hover { transform: scale(1.05); }
        .tarjeta img { width: 100%; height: 300px; object-fit: cover; }
        .tarjeta a { text-decoration: none; color: white; display: block; padding: 15px 5px; }
    </style>
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