<?php

$conn = oci_connect(
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_HOST') . ':' . getenv('DB_PORT') . '/XEPDB1',
    'AL32UTF8'
);

if (!$conn) {
    $e = oci_error();
    die('Error de conexión: ' . $e['message']);
}

echo "Conexión exitosa a la base de datos Oracle.<br>";

$sql = <<<SQL
SELECT
    p.id,
    p.nombre,
    c.descripcion
FROM personas p
LEFT JOIN categorias c
       ON c.id = p.categoria_id
WHERE p.estado = 1
  AND c.activa = 1
ORDER BY p.id
SQL;

$stmt = oci_parse($conn, $sql);
oci_execute($stmt);

echo "<h3>Listado de personas activas</h3>";

while ($row = oci_fetch_array($stmt, OCI_ASSOC | OCI_RETURN_NULLS)) {
    echo htmlspecialchars($row['NOMBRE']) .
         ' - ' .
         htmlspecialchars($row['DESCRIPCION'] ?? 'Sin categoría') .
         "<br>";
}

oci_free_statement($stmt);
oci_close($conn);
