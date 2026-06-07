
<?php

/**
 * problema2.php — Suma de números del 1 al 1000.
 * Calcula la suma acumulativa de los enteros desde 1 hasta 1000.
 * Estructura: ciclo for.
 * Resultado esperado: 500,500.
 */



require_once __DIR__ . '/../models/Utilidades.php';

$tituloPagina = 'Problema #2 – Suma 1 al 1000';
require_once __DIR__ . '/header.php';

$sumaTotal = 0;
for ($i = 1; $i <= 1000; $i++) {
    $sumaTotal += $i;
}
?>

<div class="card problema2">
    <div class="resultado-label">RESULTADO</div>
    <div class="suma-descripcion">SUMA DEL 1 AL 1,000</div>
    <div class="suma-igual">= <?= number_format($sumaTotal) ?></div>
    <div class="suma-nota">
        Calculado mediante un ciclo <code>for</code> que acumula cada entero.
    </div>
    <?= Utilidades::enlaceMenu('../index.php') ?>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>