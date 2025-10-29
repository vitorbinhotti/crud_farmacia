<?php
// Página para listar remédios
require_once '../banco-de-dados/db.php';
$sql = "SELECT * FROM remedios";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Remédios</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../reset.css">
</head>

<body>
    <h1>Lista de Remédios</h1>
    <br><br>
    <table border="1" style="margin:auto;">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Código</th>
            <th>Tipo</th>
            <th>Estoque</th>
            <th>Validade</th>
            <th>Laboratório</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nome'] ?></td>
                <td>R$ <?= number_format($row['preco'], 2, ',', '.') ?></td>
                <td><?= $row['codigo'] ?></td>
                <td><?= $row['tipo'] ?></td>
                <td><?= $row['estoque'] ?></td>
                <td><?= date('d/m/Y', strtotime($row['validade'])) ?></td>
                <td><?= $row['laboratorio'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <div class="voltar-link">
        <a href="../index.php">Voltar</a>
    </div>
</body>

</html>