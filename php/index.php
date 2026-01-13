<?php
/**
 * PRUEBA TÉCNICA – PHP + ORACLE
 *
 * Objetivo:
 * - Leer código legado sin miedo
 * - Detectar bugs lógicos (no sintácticos)
 * - Entender comportamiento de Oracle (JOINs, NULLs)
 * - Proponer una corrección mínima sin romper el sistema
 *
 * Escenario:
 * Un usuario reporta que el listado de personas
 * "a veces funciona, a veces no".
 * Algunos registros no aparecen.
 */

$conn = oci_connect(
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_HOST') . ':' . getenv('DB_PORT') . '/' . getenv('DB_SERVICE'),
    'AL32UTF8'
);

if (!$conn) {
    $e = oci_error();
    die($e['message']);
}

$estado = 1;

/**
 * Consulta original del sistema
 * Problema reportado:
 * - Faltan registros
 * - A veces aparecen, a veces no
 */
$sql = "
SELECT
    p.id,
    p.nombre,
    c.descripcion
FROM PRUEBA.personas p
LEFT JOIN PRUEBA.categorias c ON c.id = p.categoria_id
WHERE p.estado = :estado
  AND c.activa = 1
";

$stmt = oci_parse($conn, $sql);
oci_bind_by_name($stmt, ':estado', $estado);
oci_execute($stmt);

/**
 * Lectura de resultados
 * El sistema solo muestra un nombre
 */
$row = oci_fetch_array($stmt, OCI_ASSOC);
echo $row['NOMBRE'] ?? 'Sin resultados';
