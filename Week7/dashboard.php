<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

$current_user_theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';

if ($current_user_theme == 'dark') {
    $page_background_color = '#333';
    $page_text_color = '#fff';
} else {
    $page_background_color = '#fff';
    $page_text_color = '#000';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            background-color: <?php echo $page_background_color; ?>;
            color: <?php echo $page_text_color; ?>;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="preference.php">Theme Preference</a> |
        <a href="logout.php">Logout</a>
    </nav>
    <p>Student ID: <?php echo htmlspecialchars($_SESSION['student_id']); ?></p>
    <p>Current Theme: <?php echo htmlspecialchars($current_user_theme); ?></p>
</body>
</html>
