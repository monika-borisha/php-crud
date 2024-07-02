<?php

include 'connection.php';

if (isset($_GET['id']) && isset($_GET['new_value'])) {
    $id = $_GET['id'];
    $new_value = $_GET['new_value'];

    $stmt = $conn->prepare("UPDATE user SET  WHERE id = ?");
    $stmt->bind_param("si", $new_value, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: index.php");
    exit();
}   
?>