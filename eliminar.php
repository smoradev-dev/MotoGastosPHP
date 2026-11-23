<?php
// Elimina un gasto segun la posicion que llega por la URL
require 'includes/funciones.php';

$gastos = leerGastos();
$id = isset($_GET['id']) ? (int) $_GET['id'] : -1;

if (isset($gastos[$id])) {
    array_splice($gastos, $id, 1); // quita el gasto y reordena las posiciones
    guardarGastos($gastos);
    $msg = 'Gasto eliminado';
} else {
    $msg = 'El gasto no existe';
}

header('Location: index.php?msg=' . urlencode($msg));
exit;
