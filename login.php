<?php 
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()){
        if (password_verify($senha, $row['senha'])){
            $_SESSION['user'] = $row['nome'];

            // Criar um cookie para o usuário válido por 7 dias 
            setcookie('user', $row['nome'], time() + 60 * 60 * 24 * 7);

            header('Location: index.php');
            exit();
        } else {
            echo 'Senha incorreta';
        }
    } else {
        echo 'Usuário não encontrado';
    }
}
?>

<form method="post">
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Login</button>
</form>