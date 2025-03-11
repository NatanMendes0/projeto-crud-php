<?php
    session_start();
    include 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql  = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($senha, $row['senha'])) {
                $_SESSION['user'] = $row['nome'];
                $_SESSION['id']   = $row['id'];

                // Criar um cookie para o usuário válido por 7 dias
                setcookie('user', $row['id'], time() + 60 * 60 * 24 * 7);

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

<?php include 'includes/header.php'; ?>
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg text-center">
        <h2 class="text-4xl font-bold mb-6">Login</h2>

        <?php 
        if (!isset($_SESSION['user'])) {
            echo '<p class="text-red-600 mb-4">Você precisa estar logado para acessar a página inicial!</p>';
        }
        ?>
        <form method="post" class="space-y-4">
            <div>
                <input type="email" name="email" placeholder="E-mail" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div>
                <input type="password" name="senha" placeholder="Senha" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Login</button>
            </div>
        </form>
        <div class="mt-4">
            <a href="views/forUsers/create.php" class="text-blue-600 hover:underline">Registrar-se</a>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
