<?php
/**
 * problema7.php - Adaptación del código de la compañera.
 * Calcula promedio, desviación estándar, mínimo y máximo de 5 notas fijas.
 */
require_once __DIR__ . '/../models/Utilidades.php';
$tituloPagina = 'Problema #7 – Calculadora Estadística';
require_once __DIR__ . '/header.php';

$resultado = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notas = $_POST['notas'] ?? [];
    $notasValidas = [];
    foreach ($notas as $i => $n) {
        $n = trim($n);
        if (!is_numeric($n) || $n < 0 || $n > 100) {
            $error = "La nota " . ($i + 1) . " debe ser un número entre 0 y 100.";
            break;
        }
        $notasValidas[] = (float) $n;
    }
    if (empty($error) && count($notasValidas) === 5) {
        $resultado = [
            'promedio'   => Utilidades::calcularMedia($notasValidas),      // ← cambiar
            'desviacion' => Utilidades::calcularDesviacionPoblacional($notasValidas),
            'minimo'     => min($notasValidas),                           // ← nativo
            'maximo'     => max($notasValidas),                           // ← nativo
        ];
    }
}
?>

<div class="contenedor">
    <h2>Calculadora de Datos Estadísticos</h2>
    <form method="POST">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <input type="number" step="0.01" min="0" max="100" name="notas[]"
                   placeholder="Ingrese la nota <?= $i ?>" required>
        <?php endfor; ?>
        <button type="submit">Calcular</button>
    </form>

    <?php if ($error): ?>
        <div class="alert-error"><?= Utilidades::limpiarHtml($error) ?></div>
    <?php endif; ?>

    <?php if ($resultado): ?>
        <div class="resultados">
            <h3>Resultados</h3>
            <p><strong>Promedio:</strong> <?= number_format($resultado['promedio'], 2) ?></p>
            <p><strong>Desviación Estándar:</strong> <?= number_format($resultado['desviacion'], 2) ?></p>
            <p><strong>Nota Mínima:</strong> <?= $resultado['minimo'] ?></p>
            <p><strong>Nota Máxima:</strong> <?= $resultado['maximo'] ?></p>
        </div>
    <?php endif; ?>

    <?= Utilidades::enlaceMenu('../index.php') ?>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>