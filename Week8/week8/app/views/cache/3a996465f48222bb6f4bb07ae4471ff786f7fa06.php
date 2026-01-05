

<?php $__env->startSection('title', 'Edit Student'); ?>

<?php $__env->startSection('content'); ?>
    <h2>Edit Student</h2>
    
    <form action="index.php?action=edit&id=<?php echo e($student['id']); ?>" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo e($student['name']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo e($student['email']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="course">Course:</label>
            <input type="text" id="course" name="course" value="<?php echo e($student['course']); ?>" required>
        </div>
        
        <button type="submit" class="btn btn-success">Update Student</button>
        <a href="index.php?action=index" class="btn">Cancel</a>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tutorial-8\app\views/students/edit.blade.php ENDPATH**/ ?>