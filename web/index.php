<?php
$host = 'db';
$dbname = 'notas_db';
$user = 'user';
$pass = 'password';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $conn->prepare("INSERT INTO notas (titulo, contenido) VALUES (?, ?)");
        $stmt->execute([$_POST['titulo'], $_POST['contenido']]);
        header("Location: index.php");
        exit();
    }
    
    $notas = $conn->query("SELECT * FROM notas ORDER BY creado_en DESC");
    
} catch(PDOException $e) {
    $error = "Error de conexión: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Notas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>Sistema de Notas</h1>
        
        <?php if(isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <input type="text" name="titulo" placeholder="Título" required>
            <textarea name="contenido" placeholder="Contenido" required></textarea>
            <button type="submit">Guardar Nota</button>
        </form>
        
        <h2>Mis Notas</h2>
        <?php if(isset($notas)): ?>
        <table>
            <tr>
                <th>Título</th>
                <th>Contenido</th>
                <th>Fecha</th>
            </tr>
            <?php while($nota = $notas->fetch()): ?>
            <tr>
                <td><?= htmlspecialchars($nota['titulo']) ?></td>
                <td><?= htmlspecialchars($nota['contenido']) ?></td>
                <td><?= $nota['creado_en'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php endif; ?>
    </div>
</body>
</html>