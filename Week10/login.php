<?php

require 'session.php';
require 'db.php';

$error = '';

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $csrfToken = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

        if (!$email || $password === '') {
            $error = "Invalid email or password";
        } elseif (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $csrfToken)) {
            $error = "Invalid email or password";
        } else {
            $sql = "SELECT id, password FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                unset($_SESSION['csrf_token']);
                header('Location: dashboard.php');
                exit;
            } else {
                $error = "Invalid email or password";
            }
        }
    }

    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

} catch (Exception $e) {
    $error = "Invalid email or password";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<?php if ($error): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" minlength="1" required><br><br>

    <button type="submit">Login</button>
</form>
<br>
<a href="signup.php">Go to Signup</a>
</body>
</html>
