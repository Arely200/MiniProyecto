<?php
/**
 * problema1.php — Estadísticas de 5 números positivos.
 * Se solicitan 5 números positivos mediante formulario y se calcula:
 * media, desviación estándar, valor mínimo y máximo.
 * Estructuras: foreach para validación, for para mostrar campos.
 * Validación: números positivos, no letras, no negativos.
 */


require_once __DIR__ . '/../models/Utilidades.php';

$tituloPagina = 'Problema #1 – Estadísticas';
require_once __DIR__ . '/header.php';

$numerosValidos = [];
$errores = []; // array de mensajes por campo
$mostrarResultado = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entradas = $_POST['numeros'] ?? [];
    
    //Foreach para validar cada número
    foreach ($entradas as $idx => $val) {
        $val = trim($val);
        if (!Utilidades::validarNumero($val)) {
            $errores[$idx] = "Debe ser un número válido.";
        } elseif ((float)$val <= 0) {
            $errores[$idx] = "Debe ser un número positivo mayor a cero.";
        } else {
            $numerosValidos[$idx] = Utilidades::limpiarNumero($val);
        }
    }

    if (count($numerosValidos) === 5 && empty($errores)) {
        $mostrarResultado = true;
        // Ordenar los números por el índice original (solo por si acaso)
        ksort($numerosValidos);
        $numerosValidos = array_values($numerosValidos);
    }
}

$media  = $mostrarResultado ? Utilidades::calcularMedia($numerosValidos) : 0;
$desv   = $mostrarResultado ? Utilidades::calcularDesviacionEstandar($numerosValidos) : 0;
$minVal = $mostrarResultado ? min($numerosValidos) : 0;
$maxVal = $mostrarResultado ? max($numerosValidos) : 0;
?>

<div class="card problema1">
    <h2>Estadísticas de 5 números positivos</h2>

    <form method="POST" class="form-profesional">
        <?php for ($i = 1; $i <= 5; $i++): 
            $idx = $i - 1;
            $valorInput = isset($_POST['numeros'][$idx]) ? Utilidades::limpiarHtml($_POST['numeros'][$idx]) : '';
            $errorMsg = isset($errores[$idx]) ? $errores[$idx] : '';
        ?>
            <div class="campo-grupo">
                <input type="number" step="any" name="numeros[]" 
                       class="<?= $errorMsg ? 'input-error' : '' ?>"
                       placeholder="Ingrese el número <?= $i ?>"
                       value="<?= $valorInput ?>" required>
                <?php if ($errorMsg): ?>
                    <span class="error-msg"><?= Utilidades::limpiarHtml($errorMsg) ?></span>
                <?php endif; ?>
            </div>
        <?php endfor; ?>
        
        <button type="submit">Calcular</button>
    </form>

    <?php if ($mostrarResultado): ?>
        <div class="resultado">
            <h3>Resultados</h3>
            <table class="tabla-resultados">
                <thead><tr><th>Estadística</th><th>Valor</th></tr></thead>
                <tbody>
                    <tr>
                        <td>Números ingresados</td>
                        <td>
                            <?php 
                            $lista = '';
                            foreach ($numerosValidos as $num) {
                                $lista .= $num . ', ';
                            }
                            echo rtrim($lista, ', ');
                            ?>
                        </td>
                    </tr>
                    <tr><td>Media (promedio)</td><td><?= number_format($media, 4) ?></td></tr>
                    <tr><td>Desviación estándar (S)</td><td><?= number_format($desv, 4) ?></td></tr>
                    <tr><td>Mínimo</td><td><?= $minVal ?></td></tr>
                    <tr><td>Máximo</td><td><?= $maxVal ?></td></tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <?= Utilidades::enlaceMenu('../index.php') ?>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>