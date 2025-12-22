<?php
include 'db.php';
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';

if ($category_filter) {
    $sql = "SELECT * FROM books WHERE category = '$category_filter' ORDER BY book_id DESC";
} elseif ($search_query) {
    $sql = "SELECT * FROM books WHERE title LIKE '%$search_query%' OR author LIKE '%$search_query%' ORDER BY book_id DESC";
} else {
    $sql = "SELECT * FROM books ORDER BY book_id DESC";
}
$result = mysqli_query($conn, $sql);
$categories_sql = "SELECT DISTINCT category FROM books ORDER BY category";
$categories_result = mysqli_query($conn, $categories_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Header -->
        <header class="text-center mb-16">
            <h1 class="text-5xl md:text-6xl font-bold bg-gradient-to-r from-blue-600 to-black bg-clip-text text-transparent mb-2">
            Library
            </h1>
            <p class="text-xl text-gray-500 font-light">Management System</p>
        </header>

        <section class="bg-white rounded-xl shadow-sm p-8 mb-6">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Add New Book</h2>
            <form action="add_book.php" method="post" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <input type="text" name="title" placeholder="Book Title" required
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>
                <div>
                    <input type="text" name="author" placeholder="Author Name" required
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>
                <div>
                    <input type="text" name="category" placeholder="Category" required
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>
                <div>
                    <input type="number" name="quantity" placeholder="Quantity" min="1" required
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>
                <button type="submit" 
                        class="md:col-span-2 lg:col-span-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition transform hover:scale-[1.02] active:scale-[0.98]">
                    Add Book
                </button>
            </form>
        </section>

        <section class="mb-6">
            <form method="get" class="flex flex-col sm:flex-row gap-3 mb-4">
                <input type="text" name="search" placeholder="Search by title or author..." 
                       value="<?php echo htmlspecialchars($search_query); ?>"
                       class="flex-1 px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm">
                <button type="submit" 
                        class="bg-gray-900 hover:bg-black text-white font-semibold py-3 px-6 rounded-lg transition transform hover:scale-[1.02]">
                    Search
                </button>
            </form>
            
            <div class="flex flex-wrap gap-2">
                <a href="index.php" 
                   class="px-5 py-2 rounded-full text-sm font-medium transition <?php echo !$category_filter ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 border border-gray-300 hover:border-blue-600 hover:text-blue-600'; ?>">
                    All
                </a>
                <?php while ($cat = mysqli_fetch_assoc($categories_result)): ?>
                    <a href="?category=<?php echo urlencode($cat['category']); ?>" 
                       class="px-5 py-2 rounded-full text-sm font-medium transition <?php echo $category_filter === $cat['category'] ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 border border-gray-300 hover:border-blue-600 hover:text-blue-600'; ?>">
                        <?php echo htmlspecialchars($cat['category']); ?>
                    </a>
                <?php endwhile; ?>
            </div>
        </section>

        <section class="bg-white rounded-xl shadow-sm p-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Book Collection</h2>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 hover:shadow-lg hover:border-blue-500 transition transform hover:-translate-y-1">
                            <div class="flex justify-between items-start mb-3 gap-3">
                                <h3 class="text-lg font-semibold text-gray-900 leading-tight">
                                    <?php echo htmlspecialchars($row['title']); ?>
                                </h3>
                                <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full whitespace-nowrap">
                                    <?php echo htmlspecialchars($row['category']); ?>
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">by <?php echo htmlspecialchars($row['author']); ?></p>
                            <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                                <span class="text-gray-900 font-semibold text-sm">Qty: <?php echo $row['quantity']; ?></span>
                                <a href="delete_book.php?id=<?php echo $row['book_id']; ?>" 
                                   onclick="return confirm('Are you sure you want to delete this book?');"
                                   class="bg-red-500 hover:bg-red-600 text-white text-sm font-medium py-2 px-4 rounded-lg transition transform hover:scale-105">
                                    Delete
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-gray-500 py-16 text-lg">No books found. Add your first book above.</p>
            <?php endif; ?>
        </section>

        <footer class="text-center mt-16 pt-8 border-t border-gray-200">
            <p class="text-gray-500 text-sm">© 2025 Library Management System</p>
        </footer>
    </div>
</body>
</html>
