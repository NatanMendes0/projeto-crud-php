<?php 
$host = "localhost";
$user = "root"; //Usuario padrao do mysql
$pass = ""; //Senha padrao do mysql
$dbname = "crud_php"; //Nome do banco de dados

// Conectando com o banco de dados
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Verificando se a conexão foi bem sucedida
if(!$conn){
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}
?>