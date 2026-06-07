<?php
/**
 * footer.php — Cierra el main y muestra el footer con fecha.
 */
$fechaHoy = date('d/m/Y H:i:s');
?>
</main> <!-- Cierra el <main> abierto en header.php -->

<footer class="site-footer">
    <p>
        Universidad Tecnológica de Panamá &mdash;
        Desarrollo VII / PHP &mdash;
        <strong>Ejecutado el: <?= htmlspecialchars($fechaHoy, ENT_QUOTES, 'UTF-8') ?></strong>
    </p>
</footer>
</body>
</html>