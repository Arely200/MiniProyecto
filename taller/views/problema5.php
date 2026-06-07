

/**
 * problema5.php — Clasificación de edades de 5 personas.
 * Se ingresan 5 edades (0-120) y se clasifican en:
 * Niño (0-12), Adolescente (13-17), Adulto (18-64), Adulto mayor (65+).
 * Genera estadísticas de cantidad por categoría.
 * Estructuras: foreach para validación, switch(true) o if-else para clasificación.
 */<?php
require_once __DIR__ . '/../models/Utilidades.php';

$tituloPagina = 'Problema #5 – Clasificación de Edades';
require_once __DIR__ . '/header.php';

$resultados = [];
$errores = [];
$mostrarResultado = false;
$conteo = ['Niño' => 0, 'Adolescente' => 0, 'Adulto' => 0, 'Adulto mayor' => 0];

function clasificarEdad(int $edad): string {
    switch (true) {
        case ($edad >= 0 && $edad <= 12): return 'Niño';
        case ($edad >= 13 && $edad <= 17): return 'Adolescente';
        case ($edad >= 18 && $edad <= 64): return 'Adulto';
        case ($edad >= 65): return 'Adulto mayor';
        default: return 'Desconocido';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entradas = $_POST['edades'] ?? [];
    foreach ($entradas as $idx => $val) {
        $val = trim($val);
        if (!filter_var($val, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 120]])) {
            $errores[] = "Edad #" . ($idx + 1) . " inválida (0-120).";
            continue;
        }
        $edad = (int)$val;
        $categoria = clasificarEdad($edad);
        $resultados[] = ['edad' => $edad, 'categoria' => $categoria];
        $conteo[$categoria]++;
    }
    if (empty($errores) && count($resultados) === 5) {
        $mostrarResultado = true;
    }
}

$maxConteo = $mostrarResultado ? max($conteo) : 1;
$colores = ['Niño' => '#3498db', 'Adolescente' => '#9b59b6', 'Adulto' => '#27ae60', 'Adulto mayor' => '#e67e22'];
?>

<div class="card problema5">
    <div class="resultado-label">CLASIFICACIÓN DE EDADES</div>
    <div class="descripcion-problema">
        Ingrese las edades de 5 personas. Cada una se clasifica en Niño (0-12), Adolescente (13-17), Adulto (18-64) o Adulto mayor (65+).
    </div>

    <form method="POST" class="edades-form">
        <div class="edades-grid">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="campo-edad">
                    <label>Persona <?= $i ?></label>
                    <input type="number" name="edades[]" min="0" max="120"
                           placeholder="Edad"
                           value="<?= isset($_POST['edades'][$i-1]) ? (int)$_POST['edades'][$i-1] : '' ?>"
                           required>
                </div>
            <?php endfor; ?>
        </div>
        <button type="submit">Clasificar</button>
    </form>

    <?php if (!empty($errores)): ?>
        <div class="error-msg">
            <?php foreach ($errores as $e): ?>
                <div>⚠️ <?= Utilidades::limpiarHtml($e) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($mostrarResultado): ?>
        <div class="resultado-edades">
            <div class="tabla-container">
                <h3>Clasificación individual</h3>
                <table class="tabla-resultados">
                    <thead>
                        <tr><th>Persona</th><th>Edad</th><th>Categoría</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $idx => $r): ?>
                            <tr>
                                <td><?= $idx + 1 ?></td>
                                <td><?= $r['edad'] ?> años</td>
                                <td><?= Utilidades::limpiarHtml($r['categoria']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="estadisticas-container">
                <h3>Estadísticas</h3>
                <div class="barras-grafica">
                    <?php foreach ($conteo as $cat => $cant): ?>
    <?php $ancho = $maxConteo > 0 ? round(($cant / $maxConteo) * 100) : 0; ?>
    
    <div class="barra-fila">
        <span class="barra-etiqueta"><?= $cat ?></span>

        <div class="barra-contenedor">
            <div class="barra"
                 style="width: <?= $ancho ?>%;
                        background: <?= $colores[$cat] ?>;">
            </div>
        </div>

        <span class="barra-valor">
            <?= $cant ?> persona<?= $cant !== 1 ? 's' : '' ?>
        </span>
    </div>
<?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="nota-proceso">✅ Usamos <code>switch(true)</code> para clasificar y <code>foreach</code> para mostrar la tabla.</div>
    <?php endif; ?>

    <?= Utilidades::enlaceMenu('../index.php') ?>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>