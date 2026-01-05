

<?php $__env->startSection('title', 'Add New Student'); ?>
<?php $__env->startSection('subtitle', 'Create a new student record.'); ?>

<?php $__env->startSection('content'); ?>
    <form action="index.php?action=store" method="POST" class="grid gap-4 max-w-xl mx-auto">
        <div class="grid gap-1">
            <label for="name" class="text-sm font-medium text-slate-700">Name</label>
            <input type="text" id="name" name="name" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100">
        </div>
        
        <div class="grid gap-1">
            <label for="email" class="text-sm font-medium text-slate-700">Email</label>
            <input type="email" id="email" name="email" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100">
        </div>
        
        <div class="grid gap-1">
            <label for="course" class="text-sm font-medium text-slate-700">Course</label>
            <input type="text" id="course" name="course" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100">
        </div>
        
        <div class="flex justify-end gap-2 pt-2">
            <a href="index.php?action=index" class="inline-flex items-center rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Cancel</a>
            <button type="submit" class="inline-flex items-center rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">Add Student</button>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Program Files\Xampp\htdocs\tutorial-8\app\views/students/create.blade.php ENDPATH**/ ?>