

<?php
/**
 * problema3.php — N primeros múltiplos de 4.
 * El usuario ingresa N (entre 1 y 10000) y se generan los primeros N múltiplos de 4.
 * Estructura: ciclo for.
 * Se controla desbordamiento con límite de 10000.
 */



require_once __DIR__ . '/../models/Utilidades.php';

$tituloPagina = 'Problema #3 – Múltiplos de 4';
require_once __DIR__ . '/header.php';

$multiplos = [];
$error = '';
$n = '';
$mostrarResultado = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entrada = trim($_POST['n'] ?? '');
    if (!Utilidades::validarRango($entrada, 1, 10000)) {
        $error = 'Ingrese un número entero entre 1 y 10,000.';
    } else {
        $n = (int)$entrada;
        for ($i = 1; $i <= $n; $i++) {
            $multiplos[] = 4 * $i;
        }
        $mostrarResultado = true;
    }
}
?>

<div class="card problema3">
    <div class="resultado-label">MÚLTIPLOS DE 4</div>
    <div class="multiplos-descripcion">
        <?php if (!$mostrarResultado): ?>
            ¿Cuántos múltiplos deseas generar?
        <?php else: ?>
            Primeros <?= number_format($n) ?> múltiplos de 4
        <?php endif; ?>
    </div>

    <form method="POST" class="multiplos-form">
        <input type="number" name="n" min="1" max="10000"
               placeholder="Ej. 10"
               value="<?= Utilidades::limpiarHtml($n) ?>" required>
        <button type="submit">Generar</button>
    </form>

    <?php if ($error): ?>
        <div class="error-msg"> <?= Utilidades::limpiarHtml($error) ?></div>
    <?php endif; ?>

    <?php if ($mostrarResultado): ?>
        <div class="multiplos-lista">
            <?php foreach ($multiplos as $mult): ?>
                <span class="multiplo-item"><?= number_format($mult) ?></span>
            <?php endforeach; ?>
        </div>
        <div class="multiplos-nota">
            Calculado mediante un ciclo <code>for</code> (4 × i)
        </div>
    <?php endif; ?>

    <?= Utilidades::enlaceMenu('../index.php') ?>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>