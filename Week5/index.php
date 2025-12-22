<?php require 'header.php'; ?>

<div class="text-center py-12">
    <h2 class="text-3xl font-semibold text-gray-900 mb-4">Welcome</h2>
    <p class="text-xl text-gray-600 mb-12">Manage student information and portfolio files.</p>
    
    <div class="grid md:grid-cols-2 gap-6 max-w-2xl mx-auto">
        <a href="add_student.php" class="block p-8 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl hover:shadow-xl transition-all transform hover:-translate-y-1">
            <div class="text-5xl mb-4">👤</div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Add Student Info</h3>
            <p class="text-gray-600">Register new student details</p>
        </a>
        <a href="upload.php" class="block p-8 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl hover:shadow-xl transition-all transform hover:-translate-y-1">
            <div class="text-5xl mb-4">📁</div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Upload Portfolio File</h3>
            <p class="text-gray-600">Share student portfolios</p>
        </a>
    </div>
</div>

<?php include 'footer.php'; ?>
