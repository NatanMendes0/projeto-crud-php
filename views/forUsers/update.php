<?php
    include '../config/db.php';

    if (isset($_GET["id"])) {
        $id   = $_GET["id"];
        $sql  = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user   = $result->fetch_assoc();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id   = $_POST["id"];
        $nome = $_POST["nome"];
        $sql  = "UPDATE usuarios SET nome = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $nome, $id);
        $stmt->execute();
        header("Location: index.php");
        exit();
    }
?>

<h1>Atualizar Usuário</h1>
<p>Atualize o nome do usuário</p>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $user['id']?>">
    <input type="text" name="nome" value="<?php echo $user['nome']?>" required>
    <button type="submit">Atualizar</button>
</form>