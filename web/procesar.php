<?php
$conn = new mysqli('db', 'user', 'password', 'notas_db');

$stmt = $conn->prepare("INSERT INTO notas (titulo, contenido) VALUES (?, ?)");
$stmt->bind_param("ss", $_POST['titulo'], $_POST['contenido']);
$stmt->execute();

header("Location: index.php");
exit();
?>