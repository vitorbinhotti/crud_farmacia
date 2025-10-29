<?php
// Página para atualizar remédio
require_once '../banco-de-dados/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM remedios WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $remedio = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $codigo = $_POST['codigo'];
    $tipo = $_POST['tipo'];
    $estoque = $_POST['estoque'];
    $validade = $_POST['validade'];
    $laboratorio = $_POST['laboratorio'];
    $sql = "UPDATE remedios SET nome=?, preco=?, codigo=?, tipo=?, estoque=?, validade=?, laboratorio=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sdssissi', $nome, $preco, $codigo, $tipo, $estoque, $validade, $laboratorio, $id);
    if ($stmt->execute()) {
        echo "<p>Remédio atualizado com sucesso!</p>";
    } else {
        echo "<p>Erro ao atualizar: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Remédio</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Atualizar Remédio</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $remedio['id'] ?? '' ?>">
        <input type="text" name="nome" placeholder="Nome" value="<?= $remedio['nome'] ?? '' ?>" required><br>
        <input type="number" step="0.01" name="preco" placeholder="Preço" value="<?= $remedio['preco'] ?? '' ?>" required><br>
        <select name="codigo" required>
            <option value="TIPO A" <?= (isset($remedio) && $remedio['codigo']=='TIPO A')?'selected':'' ?>>TIPO A</option>
            <option value="TIPO B" <?= (isset($remedio) && $remedio['codigo']=='TIPO B')?'selected':'' ?>>TIPO B</option>
            <option value="TIPO C" <?= (isset($remedio) && $remedio['codigo']=='TIPO C')?'selected':'' ?>>TIPO C</option>
        </select><br>
        <select name="tipo" required>
            <option value="Comprimido" <?= (isset($remedio) && $remedio['tipo']=='Comprimido')?'selected':'' ?>>Comprimido</option>
            <option value="Xarope" <?= (isset($remedio) && $remedio['tipo']=='Xarope')?'selected':'' ?>>Xarope</option>
            <option value="Pomada" <?= (isset($remedio) && $remedio['tipo']=='Pomada')?'selected':'' ?>>Pomada</option>
            <option value="Injeção" <?= (isset($remedio) && $remedio['tipo']=='Injeção')?'selected':'' ?>>Injeção</option>
        </select><br>
        <input type="number" name="estoque" placeholder="Estoque" value="<?= $remedio['estoque'] ?? '' ?>" required><br>
        <input type="date" name="validade" value="<?= $remedio['validade'] ?? '' ?>" required><br>
        <input type="text" name="laboratorio" placeholder="Laboratório" value="<?= $remedio['laboratorio'] ?? '' ?>" required><br>
        <button type="submit">Atualizar</button>
    </form>
    <a href="../index.php">Voltar</a>
</body>
</html>
