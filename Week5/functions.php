<?php

function formatName($name) {
    return ucwords(strtolower(trim($name)));
}

function validateEmail($email) {
    return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(',', $string);
    return array_map('trim', $skills);
}

function saveStudent($name, $email, $skillsArray) {
    $data = $name . '|' . $email . '|' . implode(',', $skillsArray) . "\n";
    file_put_contents('students.txt', $data, FILE_APPEND);
}

function uploadPortfolioFile($file) {
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
    $allowedExts = ['pdf', 'jpg', 'jpeg', 'png'];
    $maxSize = 2 * 1024 * 1024; // 2MB
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Upload error occurred");
    }
    
    if ($file['size'] > $maxSize) {
        throw new Exception("File size exceeds 2MB");
    }
    
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception("Invalid file type. Only PDF, JPG, PNG allowed");
    }
    
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExts)) {
        throw new Exception("Invalid file extension");
    }
    
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }
    
    $newName = 'portfolio_' . time() . '_' . str_replace(' ', '_', $file['name']);
    $destination = 'uploads/' . $newName;
    
    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new Exception("Failed to move uploaded file");
    }
    
    return $newName;
}

?>
