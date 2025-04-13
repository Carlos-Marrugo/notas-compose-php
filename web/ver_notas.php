<?php
$host = 'db';
$dbname = 'notas_db';
$user = 'user';
$pass = 'password';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->query("SELECT * FROM notas ORDER BY creado_en DESC");
    
    echo "<h1>Listado de Notas</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Título</th><th>Contenido</th><th>Fecha</th></tr>";
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($row['id'])."</td>";
        echo "<td>".htmlspecialchars($row['titulo'])."</td>";
        echo "<td>".htmlspecialchars($row['contenido'])."</td>";
        echo "<td>".$row['creado_en']."</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
} catch(PDOException $e) {
    echo "<h1 style='color:red'>Error: " . $e->getMessage() . "</h1>";
}
?>