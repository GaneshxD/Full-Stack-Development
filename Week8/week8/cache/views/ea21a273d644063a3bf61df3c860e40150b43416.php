<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="min-h-screen bg-slate-50 text-slate-900">
        <div class="max-w-5xl mx-auto px-4 py-10">
            <header class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight"><?php echo $__env->yieldContent('title'); ?></h1>
                    <?php if (! empty(trim($__env->yieldContent('subtitle')))): ?>
                        <p class="text-sm text-slate-500"><?php echo $__env->yieldContent('subtitle'); ?></p>
                    <?php endif; ?>
                </div>
                <div class="flex gap-2"><?php echo $__env->yieldContent('header-actions'); ?></div>
            </header>

            <section class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                <?php echo $__env->yieldContent('content'); ?>
            </section>
        </div>
    </main>
</body>
</html><?php /**PATH D:\Program Files\Xampp\htdocs\tutorial-8\app\views/layouts/master.blade.php ENDPATH**/ ?>