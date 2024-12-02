<?php
session_start();

// Verificar si se recibe un dado válido
if (!isset($_POST['dado']) || !in_array($_POST['dado'], ['1', '2'])) {
    header("Location: index.php");
    exit();
}

// Determinar el desplazamiento según el dado seleccionado
$dadoSeleccionado = (int) $_POST['dado'] - 1; // Convertir a índice (0 o 1)
$movimiento = $_SESSION['dados'][$dadoSeleccionado];

// Actualizar posición de la ficha roja
$_SESSION['ficha_roja'] += $movimiento;

// Generar un nuevo valor aleatorio para el dado seleccionado
$_SESSION['dados'][$dadoSeleccionado] = rand(1, 6);

// Determinar el estado del juego
if ($_SESSION['ficha_roja'] == $_SESSION['ficha_negra']) {
    $_SESSION['emoji'] = "😎"; // Ganaste
} elseif ($_SESSION['ficha_roja'] > $_SESSION['ficha_negra']) {
    $_SESSION['emoji'] = "😢"; // Perdiste
    $_SESSION['ficha_roja'] = 20; // Ocultar ficha roja
} else {
    $_SESSION['emoji'] = "🤔"; // Juego en curso
}

// Redirigir a la página principal
header("Location: index.php");
exit();
?>
