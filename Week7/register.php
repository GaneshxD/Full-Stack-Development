<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $submitted_student_id = $_POST['student_id'];
    $submitted_student_name = $_POST['name'];
    $submitted_plain_password = $_POST['password'];
    
    $encrypted_password = password_hash($submitted_plain_password, PASSWORD_BCRYPT);
    
    $insert_student_query = $database_connection->prepare("INSERT INTO students (student_id, name, password) VALUES (?, ?, ?)");
    $insert_student_query->execute([$submitted_student_id, $submitted_student_name, $encrypted_password]);
    
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Student Registration</h2>
    <form method="POST">
        <label>Student ID:</label>
        <input type="text" name="student_id" required><br><br>
        
        <label>Name:</label>
        <input type="text" name="name" required><br><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
