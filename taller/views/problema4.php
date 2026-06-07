<?php

/**
 * problema4.php — Suma independiente de números pares e impares.
 * Recorre los números del 1 al 200, clasifica como par o impar usando módulo (%),
 * y acumula las sumas por separado.
 * Estructura: ciclo for y operador ternario.
 */

require_once __DIR__ . '/../models/Utilidades.php';

$tituloPagina = 'Problema #4 – Pares e Impares';
require_once __DIR__ . '/header.php';

$sumaPares = 0;
$sumaImpares = 0;

for ($i = 1; $i <= 200; $i++) {
    if ($i % 2 == 0) {
        $sumaPares += $i;
    } else {
        $sumaImpares += $i;
    }
}
?>

<div class="card problema4">
    <div class="resultado-label">SUMA DE PARES E IMPARES</div>
    <div class="descripcion-problema">
        Se recorren los números del 1 al 200, se clasifican con el operador módulo (%) y se acumulan.
    </div>

    <div class="sumas-container">
        <div class="suma-card">
            <div class="suma-titulo">Números pares</div>
            <div class="suma-numero"><?= number_format($sumaPares) ?></div>
            <div class="suma-rango">2, 4, 6 … 200</div>
        </div>
        <div class="suma-card">
            <div class="suma-titulo">Números impares</div>
            <div class="suma-numero"><?= number_format($sumaImpares) ?></div>
            <div class="suma-rango">1, 3, 5 … 199</div>
        </div>
    </div>

    <div class="nota-proceso">
        Ciclo <code>for</code> + operador <code>%</code> para clasificar.
    </div>

    <?= Utilidades::enlaceMenu('../index.php') ?>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>