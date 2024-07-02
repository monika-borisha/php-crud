<!-- <?php

include 'connection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $path = "image/" . $image;

    if (move_uploaded_file($tmp_name, $path)) {
        $stmt = $conn->prepare("INSERT INTO user (name, email, contact, password, gender, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $contact, $password, $gender, $image);
        
        if ($stmt->execute()) {
            echo "<script>alert('Data inserted successfully'); window.open('index.php', '_self');</script>";
        } else {
            echo "<script>alert('Data insertion failed'); window.open('index.php', '_self');</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>alert('Failed to upload image'); window.open('index.php', '_self');</script>";
    }
}

$conn->close();
?> -->
