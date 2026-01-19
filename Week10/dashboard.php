<?php

require 'session.php';
require 'db.php';

$user_email = '';
$isAuthenticated = false;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        header('Location: login.php');
        exit;
    }

    if (isset($_SESSION['user_id'])) {
        $isAuthenticated = true;
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT email FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $user_id]);
        $user = $stmt->fetch();
        if ($user) {
            $user_email = $user['email'];
        }
    }

} catch (Exception $e) {
    $isAuthenticated = false;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Welcome to my site</h1>
<?php if ($user_email): ?>
    <p>Logged In User : <?php echo htmlspecialchars($user_email, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>

<?php if ($isAuthenticated): ?>
    <form method="POST">
        <button type="submit" name="logout" value="1">Logout</button>
    </form>
<?php else: ?>
    <a href="login.php">
        <button type="button">Login</button>
    </a>
<?php endif; ?>

</body>
</html>
