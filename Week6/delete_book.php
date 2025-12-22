<?php
include 'db.php';

if (isset($_GET['id'])) {
    $book_id = (int)$_GET['id'];
    
    $sql = "DELETE FROM books WHERE book_id = $book_id";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: index.php');
    exit();
}
?>
