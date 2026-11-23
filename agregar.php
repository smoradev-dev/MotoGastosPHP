<?php
// Formulario para registrar un gasto nuevo
require 'includes/funciones.php';

$titulo = 'Registrar gasto';
$errores = [];

// Valores por defecto del formulario
$fecha = date('Y-m-d');
$categoria = '';
$descripcion = '';
$valor = '';

// Si el usuario envio el formulario se validan los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = $_POST['fecha'];
    $categoria = $_POST['categoria'];
    $descripcion = limpiar($_POST['descripcion']);
    $valor = $_POST['valor'];

    if ($fecha == '' || $fecha > date('Y-m-d')) {
        $errores[] = 'La fecha es obligatoria y no puede ser futura.';
    }
    if (!in_array($categoria, $categorias)) {
        $errores[] = 'Seleccione una categoría.';
    }
    if ($descripcion == '') {
        $errores[] = 'Escriba una descripción.';
    }
    if (!is_numeric($valor) || $valor <= 0) {
        $errores[] = 'El valor debe ser un número mayor que cero.';
    }

    // Si no hay errores se guarda y se vuelve al inicio
    if (count($errores) == 0) {
        $gastos = leerGastos();
        $gastos[] = [
            'fecha' => $fecha,
            'categoria' => $categoria,
            'descripcion' => $descripcion,
            'valor' => (int) $valor,
        ];
        guardarGastos($gastos);
        header('Location: index.php?msg=Gasto registrado correctamente');
        exit;
    }
}

require 'includes/header.php';
?>

<h2>Registrar gasto</h2>

<?php if (count($errores) > 0): ?>
    <div class="error">
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="agregar.php">
    <label for="fecha">Fecha</label>
    <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">

    <label for="categoria">Categoría</label>
    <select id="categoria" name="categoria">
        <option value="">-- Seleccione --</option>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?php echo $cat; ?>" <?php if ($cat == $categoria) echo 'selected'; ?>>
                <?php echo $cat; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="descripcion">Descripción</label>
    <input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>"
           placeholder="Ej: Tanqueada en la bomba">

    <label for="valor">Valor (COP)</label>
    <input type="number" id="valor" name="valor" value="<?php echo limpiar($valor); ?>" placeholder="Ej: 25000">

    <button type="submit">Guardar gasto</button>
</form>

<?php require 'includes/footer.php'; ?>
