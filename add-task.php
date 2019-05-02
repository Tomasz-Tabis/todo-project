<?php include 'header.php';
if (!isset($_SESSION['loggedIn'])){
    header("Location: index.php");
}
?>

<div class="d-flex justify-content-center">
    <form action="" method="POST" class="login col-md-6 col-sm-12 flex-column">
        <div class="text-center mt-1 mb-2">
            Create a new task.
        </div>
        <div class="form-group">
            <label for="task-title">Task title</label>
            <input type="text" class="form-control" id="task-title" placeholder="A task title" name="task-title" required>
        </div>
        <div class="form-group">
            <label for="task-content">Task title</label>
            <input type="text" class="form-control" id="task-content" placeholder="A task description" name="task-content" required>
        </div>
        <div class="form-group">
            <label for="task-start-date">Task start date</label>
            <input type="datetime-local" class="form-control" id="task-start-date" name="task-start-date" required>
        </div>
        <div class="form-group">
            <label for="task-start-end">Task end date</label>
            <input type="datetime-local" class="form-control" id="task-start-end" name="task-start-end" required>
        </div>
        <div class="form-group">
            <label for="task-author">Choose author</label>
            <select name="task-author" id="task-author" class="form-control">
                <option value="">Jelenie jaja</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Create task</button>
    </form>
</div>

<?php include 'footer.php'; ?>
