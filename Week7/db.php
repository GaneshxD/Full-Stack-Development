<?php
$database_host = 'localhost';
$database_name = 'stdPortal';
$database_user = 'root';
$database_password = '';

try {
    $database_connection = new PDO("mysql:host=$database_host;dbname=$database_name", $database_user, $database_password);
    $database_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $connection_error) {
    die("Connection failed: " . $connection_error->getMessage());
}
?>
