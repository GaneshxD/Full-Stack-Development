<?php 
require 'header.php';
require 'functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!isset($_FILES['portfolio']) || $_FILES['portfolio']['error'] === UPLOAD_ERR_NO_FILE) {
            throw new Exception("No file selected");
        }
        
        $fileName = uploadPortfolioFile($_FILES['portfolio']);
        
        $message = "<div class='bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl mb-6'>✓ File uploaded successfully: <strong>$fileName</strong></div>";
        
    } catch (Exception $e) {
        $message = "<div class='bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl mb-6'>⚠ Error: " . $e->getMessage() . "</div>";
    }
}
?>

<h2 class="text-2xl font-semibold text-gray-900 mb-6">Upload Portfolio File</h2>

<?php echo $message; ?>

<form method="POST" enctype="multipart/form-data" class="space-y-6 max-w-lg">
    <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-blue-400 transition">
        <div class="text-5xl mb-4">📤</div>
        <label class="block text-sm font-medium text-gray-700 mb-4">Select File (PDF, JPG, PNG - Max 2MB)</label>
        <input type="file" name="portfolio" accept=".pdf,.jpg,.jpeg,.png" required class="block w-full text-sm text-gray-600 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:cursor-pointer cursor-pointer">
    </div>
    <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3.5 rounded-xl hover:bg-blue-700 transition-all font-medium shadow-lg shadow-blue-500/30">Upload File</button>
</form>

<?php include 'footer.php'; ?>
