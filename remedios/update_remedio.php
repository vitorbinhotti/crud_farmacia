<?php
require_once '../banco-de-dados/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $codigo = $_POST['codigo'];
        $tipo = $_POST['tipo'];
        $estoque = $_POST['estoque'];
        $sql = "UPDATE remedios SET nome=?, preco=?, codigo=?, tipo=?, estoque=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sdssii', $nome, $preco, $codigo, $tipo, $estoque, $id);
        if ($stmt->execute()) {
            echo "
            <div class='mensagem-sucesso'>
            <p>Remédio atualizado com sucesso!</p>
            </div>";
        } else {
            echo "<p>Erro ao atualizar: " . $conn->error . "</p>";
        }
    }

    $sql = "SELECT * FROM remedios WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $remedio = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Atualizar Remédio</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../reset.css">
</head>

<body>
    <h1>Atualizar Remédio</h1>
    <br><br>
    <?php if (isset($remedio)): ?>
        <form method="post">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($remedio['nome']) ?>" required><br><br>

            <label>Preço:</label>
            <input type="text" name="preco" value="<?= htmlspecialchars($remedio['preco']) ?>" required><br><br>

            <label>Código:</label>
            <select name="codigo" required>
                <option value="TIPO A" <?= $remedio['codigo'] == 'TIPO A' ? 'selected' : '' ?>>TIPO A</option>
                <option value="TIPO B" <?= $remedio['codigo'] == 'TIPO B' ? 'selected' : '' ?>>TIPO B</option>
                <option value="TIPO C" <?= $remedio['codigo'] == 'TIPO C' ? 'selected' : '' ?>>TIPO C</option>
            </select><br><br>

            <label>Tipo:</label>
            <select name="tipo" required>
                <option value="Comprimido" <?= $remedio['tipo'] == 'Comprimido' ? 'selected' : '' ?>>Comprimido</option>
                <option value="Xarope" <?= $remedio['tipo'] == 'Xarope' ? 'selected' : '' ?>>Xarope</option>
                <option value="Pomada" <?= $remedio['tipo'] == 'Pomada' ? 'selected' : '' ?>>Pomada</option>
                <option value="Injeção" <?= $remedio['tipo'] == 'Injeção' ? 'selected' : '' ?>>Injeção</option>
            </select><br><br>

            <label>Estoque:</label>
            <input type="number" name="estoque" value="<?= htmlspecialchars($remedio['estoque']) ?>" required><br><br>
            <button type="submit">Salvar</button>
        </form>
    <?php else: ?>
        <table border="1" style="margin:auto;">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Código</th>
                <th>Tipo</th>
                <th>Estoque</th>
                <th>Ação</th>
            </tr>
            <?php
            $sql = "SELECT * FROM remedios";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td><?= $row['preco'] ?></td>
                    <td><?= $row['codigo'] ?></td>
                    <td><?= $row['tipo'] ?></td>
                    <td><?= $row['estoque'] ?></td>
                    <td><a href="?id=<?= $row['id'] ?>">Atualizar</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
    <br>
    <div class="voltar-link">
        <a href="../index.php">Voltar</a>
    </div>
</body>

</html>