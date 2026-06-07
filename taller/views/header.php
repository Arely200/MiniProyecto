<?php
if (!isset($tituloPagina)) {
    $tituloPagina = 'Taller – Desarrollo VII / PHP';
}

$rutaCss = (basename(dirname(__FILE__)) === 'views')
    ? '../public/css/estilos.css'
    : 'public/css/estilos.css';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($tituloPagina, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $rutaCss ?>">
</head>
<body>
<header>
    <h1>Universidad Tecnológica de Panamá</h1>
    <p>Desarrollo VII – Mini Proyecto #2  </p>
    <p>Arely Mendoza</p>
  <p>Estrella Pino</p>
</header>
<main> <!-- ← Esto es clave: abre el main -->