<?php
    include '../../db.php';

    if (isset($_GET['id'])) {
        $id   = $_GET["id"];
        $sql  = "SELECT * FROM veiculos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result  = $stmt->get_result();
        $veiculo = $result->fetch_assoc();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id     = $_POST["id"];
        $marca  = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $ano    = $_POST["ano"];
        $placa  = $_POST["placa"];
        $status = $_POST["status"];

        $sql  = "UPDATE veiculos SET marca = ?, modelo = ?, ano = ?, placa = ?, status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssissi", $marca, $modelo, $ano, $placa, $status, $id);
        $stmt->execute();
        header('Location: ../../index.php');
        exit();
    }
?>
<?php include '../../includes/header.php'; ?>
<main class="container mx-auto p-4 flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4">Atualize o veículo</h1>
        <p class="mb-6">Preencha os campos abaixo para atualizar o veículo</p>
        <form method="post" class="space-y-4">
            <input type="hidden" name="id" value="<?php echo $veiculo['id']?>">
            <div>
                <label for="marca" class="block text-left mb-1">Marca</label>
                <input type="text" id="marca" name="marca" value="<?php echo $veiculo['marca']?>" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label for="modelo" class="block text-left mb-1">Modelo</label>
                <input type="text" id="modelo" name="modelo" value="<?php echo $veiculo['modelo']?>" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label for="ano" class="block text-left mb-1">Ano</label>
                <input type="number" id="ano" name="ano" value="<?php echo $veiculo['ano']?>" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label for="placa" class="block text-left mb-1">Placa</label>
                <input type="text" id="placa" name="placa" value="<?php echo $veiculo['placa']?>" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label for="status" class="block text-left mb-1">Status</label>
                <select id="status" name="status" class="w-full p-2 border rounded">
                    <option value="Disponível" <?php echo $veiculo['status'] == 'Disponível' ? 'selected' : ''?>>Disponível</option>
                    <option value="Em manutenção" <?php echo $veiculo['status'] == 'Em manutenção' ? 'selected' : ''?>>Em manutenção</option>
                    <option value="Vendido" <?php echo $veiculo['status'] == 'Vendido' ? 'selected' : ''?>>Vendido</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Atualizar Veículo</button>
        </form>
    </div>
</main>
<?php include '../../includes/footer.php'; ?>