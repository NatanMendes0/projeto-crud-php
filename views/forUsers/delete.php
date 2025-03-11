<?php
include '../config/db.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: index.php");
exit();
?>
