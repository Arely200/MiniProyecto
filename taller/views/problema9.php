<?php
/**
 * problema9.php — Potencias de un número.
 * Se ingresa un número del 1 al 9 y se muestran sus primeras 15 potencias
 * (base^1 hasta base^15).
 * Estructura: ciclo for.
 */

require_once __DIR__ . '/../models/Utilidades.php';
$tituloPagina = 'Problema #9 – Potencias';
require_once __DIR__ . '/header.php';

$resultados = [];
$numero = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = $_POST['numero'] ?? '';
    if (ctype_digit($numero) && $numero >= 1 && $numero <= 9) {
        $resultados = Utilidades::generarPotencias((int)$numero);
    } else {
        $error = 'Ingrese un número entero entre 1 y 9.';
    }
}
?>

<div class="card problema9">   <!-- ← AGREGADO: clase problema9 -->
    <h2>🔢 Potencias de un Número</h2>
    <form method="POST">
        <input type="number" id="numero" name="numero" min="1" max="9"
               placeholder="Ingrese un número del 1 al 9" required
               value="<?= Utilidades::limpiarHtml($numero) ?>">
        <button type="submit">Generar Potencias</button>
    </form>

    <?php if ($error): ?>
        <div class="alert-error"><?= Utilidades::limpiarHtml($error) ?></div>
    <?php endif; ?>

    <?php if (!empty($resultados)): ?>
        <div class="resultado-container">
            <table>
                <thead>
                    <tr><th>OPERACIÓN</th><th>RESULTADO</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $exp => $valor): ?>
                        <tr>
                            <td><?= (int)$numero ?>^<?= $exp ?></td>
                            <td><?= number_format($valor) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    
    <?= Utilidades::enlaceMenu('../index.php') ?>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>Y