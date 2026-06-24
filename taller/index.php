<?php
require_once __DIR__ . '/models/Utilidades.php';

//Arreglo para mostrar los problemas disponibles en el menú principal
$problemas = [
    1 => ['titulo' => 'Estadísticas',        'desc' => 'Media, desv. estándar, min y máx de 5 números', 'emoji' => '🌸'],
    2 => ['titulo' => 'Suma 1 al 1000',      'desc' => 'Resultado esperado: 500,500',                   'emoji' => '🌸'],
    3 => ['titulo' => 'Múltiplos de 4',      'desc' => 'Imprime los N primeros múltiplos de 4',          'emoji' => '🌸'],
    4 => ['titulo' => 'Pares e Impares',     'desc' => 'Suma independiente entre 1 y 200',               'emoji' => '🌸'],
    5 => ['titulo' => 'Edades',              'desc' => 'Clasifica 5 personas con estadísticas',          'emoji' => '🌸'],
    6 => ['titulo' => 'Presupuesto',         'desc' => 'Distribución hospitalaria con gráfica',          'emoji' => '🌸'],
    7 => ['titulo' => 'Calculadora',         'desc' => 'N notas: promedio, desv. estándar, min, máx',   'emoji' => '🌸'],
    8 => ['titulo' => 'Estación del Año',    'desc' => 'Ingresa una fecha y obtén su estación',         'emoji' => '🌸'],
    9 => ['titulo' => 'Potencias',           'desc' => 'Las 15 primeras potencias de un número',        'emoji' => '🌸'],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Taller PHP – Desarrollo VII</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="public/css/estilo_index.css">
</head>
<body>

<header>
  <div class="header-logo"></div>
  <h1>Universidad Tecnológica de Panamá</h1>
  <p>Arely Mendoza</p>
  <p>Estrella Pino</p>
</header>

<main>
  <div class="intro">
    <div class="intro-badge"> Mini Proyecto #2 · Desarrollo VII / PHP </div>
    <h2>Selecciona un <span>Problema</span></h2>
  </div>

  <div class="problems-grid">
  <?php foreach ($problemas as $num => $info): ?>
    <a class="problem-card" href="controllers/ProblemController.php?problema=<?= $num ?>">
      <div class="card-top">
        <div class="card-emoji"><?= $info['emoji'] ?></div>
        <div>
          <div class="card-num">Problema #<?= $num ?></div>
          <div class="card-titulo"><?= htmlspecialchars($info['titulo'], ENT_QUOTES, 'UTF-8') ?></div>
        </div>
      </div>
      <div class="card-desc"><?= htmlspecialchars($info['desc'], ENT_QUOTES, 'UTF-8') ?></div>
      <div class="card-arrow">Resolver</div>
    </a>
  <?php endforeach; ?>
  </div>
</main>

<footer>
  Universidad Tecnológica de Panamá &mdash; Desarrollo VII
</footer>

</body>
</html>