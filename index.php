<?php
    session_start();
    include 'db.php';

    // Verificar se o usuário está logado
    if (! isset($_SESSION['user'])) {
        header('Location: login.php');
        exit();
    }

    $sql  = "SELECT * FROM veiculos WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION["id"]);
    $stmt->execute();
    $result = $stmt->get_result();

?>

<?php include 'includes/header.php'; ?>

<main class="container mx-auto p-4 text-center flex flex-col justify-center items-center min-h-screen">
    <h2 class="text-4xl font-semibold mb-4">Página Inicial de Veículos</h2>
    <p class="text-2xl text-gray-500 mb-4">Seus veículos cadastrados</p>
    <a href="views/forCars/create_vehicle.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded mb-4">Adicionar Veículo</a>
    <?php if ($result->num_rows === 0) {?>
        <p class="text-xl text-gray-500">Nenhum veículo cadastrado...</p>
    <?php } else {?>
        <div class="overflow-x-auto w-full">
            <table class="table-auto mx-auto my-4 w-full max-w-6xl">
                <thead>
                    <tr>
                        <th class="px-4 py-3">Marca</th>
                        <th class="px-4 py-3">Modelo</th>
                        <th class="px-4 py-3">Ano</th>
                        <th class="px-4 py-3">Placa</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) {?>
                        <tr class="bg-gray-100 border-b">
                            <td class="px-4 py-3 truncate max-w-xs" title="<?php echo $row['marca']; ?>"><?php echo $row['marca']; ?></td>
                            <td class="px-4 py-3 truncate max-w-xs" title="<?php echo $row['modelo']; ?>"><?php echo $row['modelo']; ?></td>
                            <td class="px-4 py-3 truncate max-w-xs" title="<?php echo $row['ano']; ?>"><?php echo $row['ano']; ?></td>
                            <td class="px-4 py-3 truncate max-w-xs" title="<?php echo $row['placa']; ?>"><?php echo $row['placa']; ?></td>
                            <td class="px-4 py-3 truncate max-w-xs" title="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></td>
                            <td class="px-4 py-3">
                                <a href="views/forCars/update_vehicle.php?id=<?php echo $row['id']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded">Editar</a>
                                <a href="views/forCars/delete_vehicle.php?id=<?php echo $row['id']; ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-4 rounded">Excluir</a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    <?php }?>
</main>

<?php include 'includes/footer.php'; ?>
