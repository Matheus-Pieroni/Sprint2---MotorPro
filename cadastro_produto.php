<?php include('valida_sessao.php'); ?>
<?php include('conexao.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $mecanico_id = $_POST['mecanico_id'];
    $modelo = $_POST['modelo'];
    $descricao = $_POST['descricao'];
    $placa = $_POST['placa'];

    if ($id) {
        $sql = "UPDATE carro SET mecanico_id='$mecanico_id', modelo='$modelo', descricao='$descricao', placa='$placa' WHERE id='$id'";
        $mensagem = "Carro atualizado com sucesso!";
    } else {
        $sql = "INSERT INTO carro (mecanico_id, modelo, descricao, placa) VALUES ('$mecanico_id', '$modelo', '$descricao', '$placa')";
        $mensagem = "Carro cadastrado com sucesso!";
    }

    if ($conn->query($sql) !== TRUE) {
        $mensagem = "Erro: " . $conn->error;
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM carro WHERE id='$delete_id'";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "Carro excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir Carro: " . $conn->error;
    }
}

$carro = $conn->query("SELECT c.id, c.modelo, c.descricao, c.placa, m.nome AS mecanico_nome FROM carro c JOIN mecanico m ON c.mecanico_id = m.id");

$carro_edit = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $carro_edit = $conn->query("SELECT * FROM carro WHERE id='$edit_id'")->fetch_assoc();
}

$mecanico = $conn->query("SELECT id, nome FROM mecanico");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Carro</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro de Carro</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $carro_edit['id'] ?? ''; ?>">
            <label for="mecanico_id">Mecânico:</label>
            <select name="mecanico_id" required>
                <?php while ($row = $mecanico->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php if ($carro_edit && $carro_edit['mecanico_id'] == $row['id']) echo 'selected'; ?>><?php echo $row['nome']; ?></option>
                <?php endwhile; ?>
            </select>
            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" value="<?php echo $carro_edit['modelo'] ?? ''; ?>" required>
            <label for="descricao">Descrição:</label>
            <textarea name="descricao"><?php echo $carro_edit['descricao'] ?? ''; ?></textarea>
            <label for="placa">Placa:</label>
            <input type="text" name="placa" value="<?php echo $carro_edit['placa'] ?? ''; ?>" required>
            <button type="submit"><?php echo $carro_edit ? 'Atualizar' : 'Cadastrar'; ?></button>
        </form>

        <?php if (isset($mensagem)) echo "<p class='message " . ($conn->error ? "error" : "success") . "'>$mensagem</p>"; ?>

        <h2>Listagem de Carros</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Descrição</th>
                <th>Placa</th>
                <th>Mecânico</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $carro->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['modelo']; ?></td>
                <td><?php echo $row['descricao']; ?></td>
                <td><?php echo $row['placa']; ?></td>
                <td><?php echo $row['mecanico_nome']; ?></td>
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
