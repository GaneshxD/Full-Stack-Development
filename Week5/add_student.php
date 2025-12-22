<?php 
require 'header.php';
require 'functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $skills = $_POST['skills'] ?? '';
        
        if (empty($name) || empty($email) || empty($skills)) {
            throw new Exception("All fields are required");
        }
        
        if (!validateEmail($email)) {
            throw new Exception("Invalid email format");
        }
        
        $formattedName = formatName($name);
        $skillsArray = cleanSkills($skills);
        
        saveStudent($formattedName, $email, $skillsArray);
        
        $message = "<div class='bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl mb-6'>✓ Student added successfully!</div>";
        
    } catch (Exception $e) {
        $message = "<div class='bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl mb-6'>⚠ Error: " . $e->getMessage() . "</div>";
    }
}
?>

<h2 class="text-2xl font-semibold text-gray-900 mb-6">Add Student Info</h2>

<?php echo $message; ?>

<form method="POST" class="space-y-6 max-w-lg">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
        <input type="text" name="name" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
        <input type="email" name="email" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Skills (comma-separated)</label>
        <input type="text" name="skills" placeholder="PHP, JavaScript, HTML" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
    </div>
    <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3.5 rounded-xl hover:bg-blue-700 transition-all font-medium shadow-lg shadow-blue-500/30">Add Student</button>
</form>

<?php include 'footer.php'; ?>
