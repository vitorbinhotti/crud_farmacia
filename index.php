<?php
session_start();

$conn = new mysqli('localhost', 'root', 'root', 'farmacia_db');
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_POST['nome']) && isset($_POST['senha'])) {
    $nome = $conn->real_escape_string($_POST['nome']);
    $senha = $conn->real_escape_string($_POST['senha']);

    $sql = "SELECT * FROM usuarios WHERE nome = '$nome' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $_SESSION['logado'] = true;
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Farmácia - CRUD</title>
    <link rel="stylesheet" href="./reset.css">
    <link rel="stylesheet" href="./styles.css">
    <link rel="shortcut icon" href="./images/icon/seringa.png">
</head>

<body class="<?php echo empty($_SESSION['logado']) ? 'login-bg' : ''; ?>">
    <h1>💉 Sistema de Farmácia - CRUD</h1>

    <?php if (empty($_SESSION['logado'])): ?>
        <div class="login-card">
            <h2>Login</h2>
            <form method="post">
                <label>Nome de usuário:<br>
                    <input type="text" name="nome" required>
                </label><br><br>
                <label>Senha:<br>
                    <input type="password" name="senha" required>
                </label><br><br>
                <button type="submit" class="btn-entrar">Entrar</button>
            </form>
            <?php if (!empty($erro))
                echo "
                <div class='mensagem-erro'>
                    <p>$erro</p>
                </div>"
                    ; ?>
        </div>
    <?php else: ?>
        <div class="menu">
            <div class="card">
                <h2>Remédios</h2>
                <div class="links">
                    <a href="remedios/create_remedio.php">➕ Cadastrar</a>
                    <a href="remedios/read_remedio.php">📄 Listar</a>
                    <a href="remedios/update_remedio.php">✏️ Atualizar</a>
                    <a href="remedios/delete_remedio.php">🗑️ Excluir</a>
                </div>
            </div>
        </div>
        <div class="btn-sair">
            <a href="?logout=1">Sair</a>
        </div>
    <?php endif; ?>
</body>

</html>