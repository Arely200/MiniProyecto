<?php
/**
 * Clase Utilidades
 * Métodos estáticos para validación, sanitización, cálculos matemáticos y utilidades varias.
 * Organizada por categorías y con indicación de los problemas que usan cada método.
 * Cumple con PSR-1, DRY y recomendaciones OWASP.
 */
class Utilidades
{
    // ==================== VALIDACIÓN ====================
    // Usados en múltiples problemas (1,2,3,4,5,6,7,8,9)

    /**
     * Valida que el valor sea numérico (entero o decimal).
     * @used-by problemas 1,2,3,4,5,6,7,9
     */
    public static function validarNumero($valor): bool
    {
        return filter_var($valor, FILTER_VALIDATE_FLOAT) !== false;
    }

    /**
     * Valida que el valor sea un entero positivo.
     * @used-by problema 3, 9
     */
    public static function validarEnteroPositivo($valor): bool
    {
        return filter_var($valor, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) !== false;
    }

    /**
     * Valida que el valor esté dentro de un rango [min, max].
     * @used-by problema 3, 7, 9
     */
    public static function validarRango($valor, int $min, int $max): bool
    {
        return filter_var($valor, FILTER_VALIDATE_INT, [
            'options' => ['min_range' => $min, 'max_range' => $max]
        ]) !== false;
    }

    /**
     * Valida formato de fecha DD-MM o MM/DD/YYYY.
     * @used-by problema 8 (original de la amiga)
     */
    public static function validarFecha(string $fecha): bool
    {
        return preg_match('/^\d{2}-\d{2}$/', $fecha) === 1
            || preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $fecha) === 1;
    }

    // ==================== SANITIZACIÓN (OWASP) ====================
    // Usados en todas las vistas

    /**
     * Sanitiza una cadena para salida HTML (previene XSS).
     * @used-by todas las vistas (problemas 1-9)
     */
    public static function limpiarHtml(string $valor): string
    {
        return htmlspecialchars($valor, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Sanitiza y devuelve un número flotante limpio.
     * @used-by problemas 1,2,3,4,5,6,7,9
     */
    public static function limpiarNumero($valor): float
    {
        return (float) filter_var($valor, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    /**
     * Devuelve $var si está definida, o $default en caso contrario.
     * @used-by varios controladores y vistas
     */
    public static function nvl(&$var, $default = '')
    {
        return isset($var) ? $var : $default;
    }

    // ==================== MATEMÁTICAS ====================
    // Métodos de cálculo estadístico y potencias

    /**
     * Calcula la media aritmética (promedio) de un arreglo de números.
     * @used-by problemas 1, 5, 7
     */
    public static function calcularMedia(array $numeros): float
    {
        $n = count($numeros);
        return $n > 0 ? array_sum($numeros) / $n : 0.0;
    }

    /**
     * Calcula la desviación estándar muestral (S = sqrt(Σ(x-x̄)² / (n-1))).
     * @used-by problemas 1, 5, 7
     */
    public static function calcularDesviacionEstandar(array $numeros): float
    {
        $n = count($numeros);
        if ($n < 2) {
            return 0.0;
        }
        $media = self::calcularMedia($numeros);
        $sumCuadrados = 0.0;
        foreach ($numeros as $x) {
            $sumCuadrados += ($x - $media) ** 2;
        }
        return sqrt($sumCuadrados / ($n - 1));
    }

    /**
     * Calcula la desviación estándar poblacional (σ = sqrt(Σ(x-μ)² / N)).
     * @used-by problema 7 (adaptación de la compañera)
     */
    public static function calcularDesviacionPoblacional(array $numeros): float
    {
        $n = count($numeros);
        if ($n === 0) return 0.0;
        $media = self::calcularMedia($numeros);
        $suma = 0;
        foreach ($numeros as $x) {
            $suma += ($x - $media) ** 2;
        }
        return sqrt($suma / $n);
    }

    /**
     * Calcula la potencia base^exponente.
     * @used-by problema 9
     */
    public static function calcularPotencia(float $base, int $exponente): float
    {
        return $base ** $exponente;
    }

    /**
     * Genera las primeras 15 potencias de un número base (1-9).
     * @return array Arreglo asociativo [exponente => resultado]
     * @used-by problema 9
     */
    public static function generarPotencias(int $base): array
    {
        $potencias = [];
        for ($exp = 1; $exp <= 15; $exp++) {
            $potencias[$exp] = self::calcularPotencia($base, $exp);
        }
        return $potencias;
    }

    // ==================== ESTACIONES (PROBLEMA 8) ====================
    // Específico para el problema 8

    /**
     * Determina la estación del año según fecha (hemisferio norte).
     * @param string $fecha En formato 'YYYY-MM-DD' o cualquier formato aceptado por strtotime.
     * @used-by problema 8
     */
    public static function obtenerEstacion(string $fecha): string
    {
        $timestamp = strtotime($fecha);
        if ($timestamp === false) return 'Desconocida';
        $mes = (int) date('m', $timestamp);
        $dia = (int) date('d', $timestamp);

        if (($mes == 3 && $dia >= 21) || $mes == 4 || $mes == 5 || ($mes == 6 && $dia <= 20)) {
            return 'Primavera';
        }
        if (($mes == 6 && $dia >= 21) || $mes == 7 || $mes == 8 || ($mes == 9 && $dia <= 22)) {
            return 'Verano';
        }
        if (($mes == 9 && $dia >= 23) || $mes == 10 || $mes == 11 || ($mes == 12 && $dia <= 20)) {
            return 'Otoño';
        }
        return 'Invierno';
    }

    // ==================== NAVEGACIÓN ====================
    // DRY: centraliza el enlace "Volver al menú"

    /**
     * Genera un enlace HTML al menú principal.
     * @used-by todas las vistas (problemas 1-9)
     */
    public static function enlaceMenu(string $url = 'index.php'): string
    {
        return '<a href="' . self::limpiarHtml($url) . '" class="btn-menu">&#8592; Volver al menú</a>';
    }

    // ==================== CSRF (OPCIONAL) ====================
    // Seguridad adicional

    /**
     * Genera token CSRF y lo almacena en sesión.
     * @used-by formularios (opcional)
     */
    public static function generarTokenCsrf(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Valida el token CSRF recibido.
     * @used-by procesamiento de formularios (opcional)
     */
    public static function validarCsrf(string $token): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}