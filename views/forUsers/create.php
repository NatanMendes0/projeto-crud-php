<?php
    include '../../db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome  = $_POST["nome"];
        $email = $_POST["email"];
        $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

        $sql  = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $senha);

        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar!";
        }
    }
?>

<?php include '../../includes/header.php'; ?>
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-4">Crie uma nova conta</h1>
        <p class="mb-4">Preencha os campos abaixo para criar uma nova conta</p>
        <form method="post" class="space-y-4">
            <input type="text" name="nome" placeholder="Nome" required class="w-full p-2 border border-gray-300 rounded">
            <input type="email" name="email" placeholder="E-mail" required class="w-full p-2 border border-gray-300 rounded">
            <input type="password" name="senha" placeholder="Senha" required class="w-full p-2 border border-gray-300 rounded">
            <button type="submit" class="w-full p-2 bg-green-500 text-white rounded hover:bg-green-600">Cadastrar</button>
        </form>
        <a href="../../login.php" class="block mt-4 text-blue-500 hover:underline">Já tem uma conta? Faça login</a>
    </div>
</div>
<?php include '../../includes/footer.php'; ?>