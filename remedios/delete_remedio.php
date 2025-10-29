<?php
// Página para excluir remédio
require_once '../banco-de-dados/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM remedios WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        echo "<p>Remédio excluído com sucesso!</p>";
    } else {
        echo "<p>Erro ao excluir: " . $conn->error . "</p>";
    }
}
// Listar todos para escolher qual excluir
$sql = "SELECT * FROM remedios";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Remédio</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Excluir Remédio</h1>
    <table border="1" style="margin:auto;">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ação</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nome'] ?></td>
            <td><a href="?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este remédio?')">Excluir</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="../index.php">Voltar</a>
</body>
</html>
