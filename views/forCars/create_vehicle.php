<?php 
session_start();
include '../../db.php';

if(!isset($_SESSION['user'])){
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $ano = $_POST["ano"];
    $placa = $_POST["placa"];
    $status = $_POST["status"];
    $usuario_id = $_SESSION["id"]; // Pegando o ID do usuário logado

    $sql = "INSERT INTO veiculos (usuario_id, marca, modelo, ano, placa, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ississ", $usuario_id, $marca, $modelo, $ano, $placa, $status); // i = integer, s = string

    if ($stmt->execute()) {
        header('Location: ../../index.php');
        exit();
    } else {
        echo "Erro ao cadastrar!";
    }
}
?>
<?php include '../../includes/header.php'; ?>
<div class="min-h-screen flex items-center justify-center">
    <form method="post" class="w-full max-w-2xl bg-white p-8 rounded-lg shadow-md">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="marca">Marca</label>
            <input type="text" name="marca" placeholder="Marca" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="modelo">Modelo</label>
            <input type="text" name="modelo" placeholder="Modelo" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="ano">Ano</label>
            <input type="number" name="ano" placeholder="Ano" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="placa">Placa</label>
            <input type="text" name="placa" placeholder="Placa" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="status">Status</label>
            <select name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="Disponível">Disponível</option>
                <option value="Em manutenção">Em manutenção</option>
                <option value="Vendido">Vendido</option>
            </select>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Adicionar Veículo</button>
            <a href="../../index.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Voltar</a>
        </div>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>