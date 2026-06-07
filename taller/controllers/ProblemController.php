<?php
/**
 * ProblemController.php — Controlador central (MVC).
 * Recibe ?problema=N y carga la vista correspondiente.
 * OWASP Ejemplo C: Gestión de errores segura — el default evita
 * exponer rutas internas o mensajes crudos de PHP al usuario.
 */
require_once __DIR__ . '/../models/Utilidades.php';

// Obtener y validar el número de problema
$problema = Utilidades::nvl($_GET['problema'], '');

// Lista de problemas permitidos (whitelist — OWASP)
$problemasPermitidos = range(1, 9);

if (!Utilidades::validarRango($problema, 1, 9)) {
    // Gestión segura: mensaje genérico sin exponer detalles internos
    $tituloPagina = 'Error';
    require_once __DIR__ . '/../views/header.php';
    echo '<div class="card"><div class="alerta alerta-error">Problema no válido. Por favor regresa al menú.</div>';
    echo Utilidades::enlaceMenu('../index.php') . '</div>';
    require_once __DIR__ . '/../views/footer.php';
    exit;
}

$numProblema = (int) $problema;

// Enrutar al archivo de vista correspondiente
$vistaPath = __DIR__ . '/../views/problema' . $numProblema . '.php';

if (!file_exists($vistaPath)) {
    $tituloPagina = 'Error';
    require_once __DIR__ . '/../views/header.php';
    echo '<div class="card"><div class="alerta alerta-error">Vista no encontrada.</div>';
    echo Utilidades::enlaceMenu('../index.php') . '</div>';
    require_once __DIR__ . '/../views/footer.php';
    exit;
}

require_once $vistaPath;



