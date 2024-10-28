<?php include('valida_sessao.php'); ?>
<?php include('conexao.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    if ($id) {
        $sql = "UPDATE mecanico SET nome='$nome', email='$email', telefone='$telefone' WHERE id='$id'";
        $mensagem = "mecanico atualizado com sucesso!";
    } else {
        $sql = "INSERT INTO mecanico (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";
        $mensagem = "mecanico cadastrado com sucesso!";
    }

    if ($conn->query($sql) !== TRUE) {
        $mensagem = "Erro: " . $conn->error;
    }
} 

//ate aqui OK EU ACHO (codigo completo)

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM mecanico WHERE id='$delete_id'";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "Mecânico excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir mecânico: " . $conn->error;
    }
}

$mecanico = $conn->query("SELECT * FROM mecanico");

$mecanico_edit = null;

if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $mecanico_edit = $conn->query("SELECT * FROM mecanico WHERE id='$edit_id'")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Mecânico</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro de Mecânico</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $mecanico_edit['id'] ?? ''; ?>">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo $mecanico_edit['nome'] ?? ''; ?>" required>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $mecanico_edit['email'] ?? ''; ?>">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" value="<?php echo $mecanico_edit['telefone'] ?? ''; ?>">
            <button type="submit"><?php echo $mecanico_edit ? 'Atualizar' : 'Cadastrar'; ?></button>
        </form>
        <?php if (isset($mensagem)) echo "<p class='message " . ($conn->error ? "error" : "success") . "'>$mensagem</p>"; ?>

        <h2>Listagem de Mecanicos</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $mecanico->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['telefone']; ?></td>
                <td>
                    <a href="?edit_id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>