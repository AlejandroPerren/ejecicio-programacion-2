<?php
session_start();

// Inicialización al abrir la página por primera vez o al pulsar "Reiniciar"
if (!isset($_SESSION['ficha_roja']) || isset($_GET['reiniciar'])) {
    $_SESSION['ficha_roja'] = 0; // Posición inicial de la ficha roja
    $_SESSION['ficha_negra'] = rand(10, 19); // Posición inicial aleatoria de la ficha negra
    $_SESSION['dados'] = [rand(1, 6), rand(1, 6)]; // Valores iniciales de los dados
    $_SESSION['emoji'] = "🤔"; // Emoji inicial
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego de Fichas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Juego de Fichas</h1>
    <div class="fila">
        <?php
        for ($i = 0; $i < 20; $i++) {
            echo "<div class='casilla'>";
            if ($i == $_SESSION['ficha_roja']) {
                echo "<span class='ficha roja'>🔴</span>";
            } elseif ($i == $_SESSION['ficha_negra']) {
                echo "<span class='ficha negra'>⚫</span>";
            }
            echo "</div>";
        }
        ?>
        <span class="emoji"><?= $_SESSION['emoji'] ?></span>
    </div>

    <form action="procesar.php" method="POST">
        <button type="submit" name="dado" value="1">Dado 1: <?= $_SESSION['dados'][0] ?></button>
        <button type="submit" name="dado" value="2">Dado 2: <?= $_SESSION['dados'][1] ?></button>
    </form>

    <a href="index.php?reiniciar=1">Reiniciar</a>
</body>
</html>
