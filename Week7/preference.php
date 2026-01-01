<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selected_theme_preference = $_POST['theme'];
    setcookie('theme', $selected_theme_preference, time() + 86400 * 30);
    $_COOKIE['theme'] = $selected_theme_preference;
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
    <title>Theme Preference</title>
    <style>
        body {
            background-color: <?php echo $page_background_color; ?>;
            color: <?php echo $page_text_color; ?>;
        }
    </style>
</head>
<body>
    <h2>Theme Preference</h2>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="preference.php">Theme Preference</a> |
        <a href="logout.php">Logout</a>
    </nav>
    <form method="POST">
        <label>Select Theme:</label>
        <select name="theme">
            <option value="light" <?php echo $current_user_theme == 'light' ? 'selected' : ''; ?>>Light Mode</option>
            <option value="dark" <?php echo $current_user_theme == 'dark' ? 'selected' : ''; ?>>Dark Mode</option>
        </select><br><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>
