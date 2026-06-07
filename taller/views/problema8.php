<?php
require_once __DIR__ . '/../models/Utilidades.php';
$tituloPagina = 'Problema #8 – Estación del Año';
require_once __DIR__ . '/header.php';

$estacion = '';
$imagen = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'] ?? '';
    if (!empty($fecha)) {
        $estacion = Utilidades::obtenerEstacion($fecha);
        // Mapeo de imágenes (si las tienes)
        $imagenes = [
            'Primavera' => 'primavera.jpg',
            'Verano'    => 'verano.jpg',
            'Otoño'     => 'otono.jpg',
            'Invierno'  => 'invierno.jpg'
        ];
        if (isset($imagenes[$estacion]) && file_exists(__DIR__ . '/../Imagenes/' . $imagenes[$estacion])) {
            $imagen = '../Imagenes/' . $imagenes[$estacion];
        }
    } else {
        $error = 'Seleccione una fecha válida.';
    }
}
?>

<div class="contenedor">
    <h2>🌎 Estación del Año</h2>
    <p class="descripcion">Seleccione una fecha para conocer la estación del año.</p>

    <form method="POST">
        <input type="date" name="fecha" required>
        <button type="submit">Consultar Estación</button>
    </form>

    <?php if ($error): ?>
        <div class="alert-error"><?= Utilidades::limpiarHtml($error) ?></div>
    <?php endif; ?>

    <?php if ($estacion != ''): ?>
        <div class="resultado">
            <h3>Resultado</h3>
            <p class="estacion">
                <?php
                switch ($estacion) {
                    case 'Primavera': echo '🌸 Primavera'; break;
                    case 'Verano':    echo '☀️ Verano'; break;
                    case 'Otoño':     echo '🍂 Otoño'; break;
                    case 'Invierno':  echo '❄️ Invierno'; break;
                }
                ?>
            </p>
            <?php if ($imagen): ?>
                <img src="<?= $imagen ?>" alt="<?= $estacion ?>" class="imagen-estacion">
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?= Utilidades::enlaceMenu('../index.php') ?>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>