
/**
 * problema6.php — Distribución de presupuesto hospitalario.
 * Se ingresa el presupuesto anual y se reparte según:
 * Ginecología 40%, Traumatología 35%, Pediatría 25%.
 * Muestra resultados en tabla y gráfica circular con Chart.js.
 * Estructuras: foreach, if.
 */

<?php
require_once __DIR__ . '/../models/Utilidades.php';
$tituloPagina = 'Problema #6 – Presupuesto Hospitalario';
require_once __DIR__ . '/header.php';

$error = '';
$resultados = null;
$presupuestoIngresado = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $presupuestoIngresado = trim($_POST['presupuesto'] ?? '');
    if (!Utilidades::validarNumero($presupuestoIngresado) || (float)$presupuestoIngresado <= 0) {
        $error = 'Por favor, ingrese un monto de presupuesto válido y positivo.';
    } else {
        $total = (float)$presupuestoIngresado;
        $resultados = [
            'Ginecologia'   => $total * 0.40,
            'Traumatologia' => $total * 0.35,
            'Pediatria'     => $total * 0.25,
        ];
    }
}
?>

<div class="card problema6">
    <h2> Distribución de Presupuesto</h2>

    <form method="POST">
        <label for="presupuesto">Presupuesto Anual del Hospital ($):</label>
        <input type="number" step="0.01" min="1" id="presupuesto" name="presupuesto"
               value="<?= Utilidades::limpiarHtml($presupuestoIngresado) ?>"
               placeholder="Ej. 20000" required>
        <button type="submit">Calcular Distribución</button>
    </form>

    <?php if ($error): ?>
        <div class="alert-error"><?= Utilidades::limpiarHtml($error) ?></div>
    <?php endif; ?>

    <?php if ($resultados): ?>
        <div class="resultado-presupuesto">
            <h3>Resultados del Presupuesto</h3>
            <ul class="lista-presupuesto">
                <li><span>Ginecología (40%):</span> <strong>$<?= number_format($resultados['Ginecologia'], 2) ?></strong></li>
                <li><span>Traumatología (35%):</span> <strong>$<?= number_format($resultados['Traumatologia'], 2) ?></strong></li>
                <li><span>Pediatría (25%):</span> <strong>$<?= number_format($resultados['Pediatria'], 2) ?></strong></li>
            </ul>
            <div class="chart-wrap">
                <canvas id="graficoPresupuesto"></canvas>
            </div>
        </div>
    <?php endif; ?>

    <?= Utilidades::enlaceMenu('../index.php') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php if ($resultados): ?>
<script>
    (function() {
        // Colores fijos como en el ejemplo de la profesora (azul, naranja, rojo)
        const colores = ['#3498db', '#e67e22', '#e74c3c'];
        const ctx = document.getElementById('graficoPresupuesto').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Ginecología', 'Traumatología', 'Pediatría'],
                datasets: [{
                    data: [<?= $resultados['Ginecologia'] ?>, <?= $resultados['Traumatologia'] ?>, <?= $resultados['Pediatria'] ?>],
                    backgroundColor: colores,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: { callbacks: { label: (tooltipItem) => `${tooltipItem.label}: $${tooltipItem.raw.toFixed(2)}` } }
                }
            }
        });
    })();
</script>
<?php endif; ?>

<?php require_once __DIR__ . '/footer.php'; ?>