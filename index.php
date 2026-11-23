<?php
// Pagina principal: muestra la lista de gastos y el total
require 'includes/funciones.php';

$titulo = 'Inicio';
$gastos = leerGastos();
$total = calcularTotal($gastos);

// Mensaje que llega despues de guardar o eliminar
$mensaje = isset($_GET['msg']) ? limpiar($_GET['msg']) : '';

require 'includes/header.php';
?>

<h2>Mis gastos de la moto</h2>

<?php if ($mensaje != ''): ?>
    <p class="exito"><?php echo $mensaje; ?></p>
<?php endif; ?>

<div class="resumen">
    <div class="tarjeta">
        <span>Total gastado</span>
        <strong><?php echo formatoPesos($total); ?></strong>
    </div>
    <div class="tarjeta">
        <span>Gastos registrados</span>
        <strong><?php echo count($gastos); ?></strong>
    </div>
</div>

<?php if (count($gastos) == 0): ?>
    <p class="vacio">Todavía no hay gastos. <a href="agregar.php">Registra el primero</a>.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Fecha</th>
            <th>Categoría</th>
            <th>Descripción</th>
            <th>Valor</th>
            <th></th>
        </tr>
        <?php foreach ($gastos as $indice => $gasto): ?>
            <tr>
                <td><?php echo $gasto['fecha']; ?></td>
                <td><?php echo $gasto['categoria']; ?></td>
                <td><?php echo $gasto['descripcion']; ?></td>
                <td class="valor"><?php echo formatoPesos($gasto['valor']); ?></td>
                <td>
                    <a class="borrar" href="eliminar.php?id=<?php echo $indice; ?>"
                       onclick="return confirm('¿Eliminar este gasto?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>
