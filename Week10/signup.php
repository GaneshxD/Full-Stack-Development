<?php

require 'session.php';
require 'db.php';

$message = '';

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        if (!$email) {
            $message = "Please enter a valid email.";
        } elseif ($password === '' || strlen($password) < 8) {
            $message = "Password must be at least 8 characters.";
        } else {
            $sql = "SELECT id FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            if ($stmt->fetch()) {
                $message = "Email already registered.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
                $stmt->execute();

                $message = "User signed up successfully";
                header('refresh: 2; url=login.php');
            }
        }
    }

} catch (Exception $e) {
    $message = "Something went wrong.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>

<h2>Signup</h2>

<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" minlength="8" required><br><br>

    <button type="submit">Signup</button>
</form>

<br>
<a href="login.php">Go to Login</a>

</body>
</html>
