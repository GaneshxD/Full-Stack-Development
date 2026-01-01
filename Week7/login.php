<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_student_id = $_POST['student_id'];
    $entered_plain_password = $_POST['password'];
    
    $find_student_query = $database_connection->prepare("SELECT * FROM students WHERE student_id = ?");
    $find_student_query->execute([$entered_student_id]);
    $found_student_record = $find_student_query->fetch(PDO::FETCH_ASSOC);
    
    if ($found_student_record && password_verify($entered_plain_password, $found_student_record['password'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['student_id'] = $found_student_record['student_id'];
        $_SESSION['name'] = $found_student_record['name'];
        header('Location: dashboard.php');
        exit();
    } else {
        $login_error_message = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Student Login</h2>
    <?php if (isset($login_error_message)): ?>
        <p style="color: red;"><?php echo $login_error_message; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Student ID:</label>
        <input type="text" name="student_id" required><br><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
