<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Projeto CRUD PHP</title>
  <!-- TailwindCSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <header class="bg-blue-600 text-white p-4 fixed top-0 w-full">
    <div class="container mx-auto">
      <h1 class="text-2xl text-center font-bold">
        Bem-vindo ao site organizador de veículos
      </h1>
      <?php if (isset($_SESSION['user'])) {?>
        <div class="absolute top-1/2 right-4 transform -translate-y-1/2">
          <a href="logout.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
        Logout
          </a>
        </div>
      <?php }?>
    </div>
  </header>
</body>
</html>