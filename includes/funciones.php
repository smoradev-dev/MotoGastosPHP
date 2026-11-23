<?php
// Funciones del proyecto MotoGastos
// Aprendiz: Santiago Calvache Mora - Ficha 3336142
// Los gastos se guardan en un archivo JSON para no necesitar base de datos

define('ARCHIVO_DATOS', __DIR__ . '/../datos/gastos.json');

// Lista de categorias que se pueden escoger en el formulario
$categorias = ['Gasolina', 'Mantenimiento', 'Repuestos', 'Parqueadero', 'Otros'];

// Lee el archivo y devuelve el arreglo de gastos
function leerGastos()
{
    if (!file_exists(ARCHIVO_DATOS)) {
        return [];
    }
    $contenido = file_get_contents(ARCHIVO_DATOS);
    $gastos = json_decode($contenido, true);
    return is_array($gastos) ? $gastos : [];
}

// Guarda el arreglo de gastos en el archivo
function guardarGastos($gastos)
{
    file_put_contents(ARCHIVO_DATOS, json_encode($gastos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Suma el valor de todos los gastos
function calcularTotal($gastos)
{
    $total = 0;
    foreach ($gastos as $gasto) {
        $total += $gasto['valor'];
    }
    return $total;
}

// Muestra un numero como pesos colombianos, ej: $ 25.000
function formatoPesos($valor)
{
    return '$ ' . number_format($valor, 0, ',', '.');
}

// Evita que se ejecute codigo HTML que escriba el usuario
function limpiar($texto)
{
    return htmlspecialchars(trim($texto), ENT_QUOTES, 'UTF-8');
}
