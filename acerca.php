<?php
// Pagina informativa del proyecto
require 'includes/funciones.php';
$titulo = 'Acerca de';
require 'includes/header.php';
?>

<h2>Acerca de MotoGastos</h2>
<p>MotoGastos es un sitio web sencillo hecho en PHP para llevar el control de lo que se gasta en una moto:
gasolina, mantenimiento, repuestos y parqueadero. Es una versión web reducida del proyecto formativo ContaMoto.</p>

<h3>Tecnologías usadas</h3>
<ul>
    <li>PHP <?php echo PHP_VERSION; ?> (lado del servidor)</li>
    <li>HTML5 y CSS3 (interfaz)</li>
    <li>Archivo JSON para guardar los datos</li>
</ul>

<p><strong>Aprendiz:</strong> Santiago Calvache Mora<br>
<strong>Ficha:</strong> 3336142 - Análisis y Desarrollo de Software</p>

<?php require 'includes/footer.php'; ?>
