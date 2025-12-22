<?php 
require 'header.php';
?>

<h2 class="text-2xl font-semibold text-gray-900 mb-6">View Students</h2>

<?php
if (file_exists('students.txt')) {
    $students = file('students.txt', FILE_IGNORE_NEW_LINES);
    
    if (count($students) > 0) {
        echo "<div class='overflow-x-auto'>";
        echo "<table class='w-full'>";
        echo "<thead><tr class='border-b border-gray-200'><th class='text-left py-4 px-4 font-semibold text-gray-700'>Name</th><th class='text-left py-4 px-4 font-semibold text-gray-700'>Email</th><th class='text-left py-4 px-4 font-semibold text-gray-700'>Skills</th></tr></thead>";
        echo "<tbody>";
        
        foreach ($students as $student) {
            $data = explode('|', $student);
            if (count($data) === 3) {
                $name = htmlspecialchars($data[0]);
                $email = htmlspecialchars($data[1]);
                $skills = explode(',', $data[2]);
                
                echo "<tr class='border-b border-gray-100 hover:bg-gray-50 transition'>";
                echo "<td class='py-4 px-4 text-gray-900'>$name</td>";
                echo "<td class='py-4 px-4 text-gray-600'>$email</td>";
                echo "<td class='py-4 px-4'><div class='flex flex-wrap gap-2'>";
                foreach ($skills as $skill) {
                    echo "<span class='px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-sm'>" . htmlspecialchars(trim($skill)) . "</span>";
                }
                echo "</div></td>";
                echo "</tr>";
            }
        }
        
        echo "</tbody></table></div>";
    } else {
        echo "<div class='text-center py-12'><div class='text-5xl mb-4'>📋</div><p class='text-gray-500'>No students found.</p></div>";
    }
} else {
    echo "<div class='text-center py-12'><div class='text-5xl mb-4'>📋</div><p class='text-gray-500'>No students file found.</p></div>";
}
?>

<?php include 'footer.php'; ?>
