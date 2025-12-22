<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $quantity = (int)$_POST['quantity'];
    
    $sql = "INSERT INTO books (title, author, category, quantity) 
            VALUES ('$title', '$author', '$category', $quantity)";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
