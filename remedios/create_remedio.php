<?php
require_once '../banco-de-dados/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $codigo = $_POST['codigo'];
    $tipo = $_POST['tipo'];
    $estoque = $_POST['estoque'];
    $validade = $_POST['validade'];
    $laboratorio = $_POST['laboratorio'];

    $sql = "INSERT INTO remedios (nome, preco, codigo, tipo, estoque, validade, laboratorio) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sdssiss', $nome, $preco, $codigo, $tipo, $estoque, $validade, $laboratorio);
    if ($stmt->execute()) {
        echo "<p>Remédio cadastrado com sucesso!</p>";
    } else {
        echo "<p>Erro ao cadastrar: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Remédio</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../reset.css">
</head>

<body>
    <h1>Cadastrar Remédio</h1>
    <br><br>
    <form method="post">
        <input type="text" name="nome" placeholder="Nome" required><br>
        <input type="number" step="0.01" name="preco" placeholder="Preço" required><br>
        <select name="codigo" required>
            <option value="TIPO A">TIPO A</option>
            <option value="TIPO B">TIPO B</option>
            <option value="TIPO C">TIPO C</option>
        </select><br>
        <select name="tipo" required>
            <option value="Comprimido">Comprimido</option>
            <option value="Xarope">Xarope</option>
            <option value="Pomada">Pomada</option>
            <option value="Injeção">Injeção</option>
        </select><br><br>
        <input type="number" name="estoque" placeholder="Estoque" required><br>
        <div>
            <p>Validade</p>
            <input type="date" name="validade" required>
        </div><br>
        <input type="text" name="laboratorio" placeholder="Laboratório" required><br>
        <button type="submit">Cadastrar</button>
    </form>
    <a href="../index.php">Voltar</a>
</body>

</html>