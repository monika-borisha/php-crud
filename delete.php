<?php

    include 'connection.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        // Prepare the DELETE statement
        $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
        if ($stmt) {
            // Bind the parameter
            $stmt->bind_param("i", $id);
    
            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>alert('Record deleted successfully'); window.open('index.php', '_self');</script>";
            } else {
                echo "<script>alert('Error deleting record'); window.open('index.php', '_self');</script>";
            }
    
            // Close the statement
            $stmt->close();
        } else {
            echo "<script>alert('Error preparing statement'); window.open('index.php', '_self');</script>";
        }
    } else {
        echo "<script>alert('ID not provided'); window.open('index.php', '_self');</script>";
    }
    
    // Close the connection
    $conn->close();
    ?>
    