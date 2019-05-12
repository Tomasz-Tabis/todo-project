<?php include 'header.php';
if (!isset($_SESSION['loggedIn'])){
    header("Location: index.php");
}
include_once  "app/Classes.php";
$users = \App\User::all();
?>

<div class="d-flex justify-content-center">
    <form action="app/controllers/TasksController.php/create" method="POST" class="login col-md-6 col-sm-12 flex-column">
        <div class="text-center mt-1 mb-2">
            Create a new task.
        </div>
        <div class="form-group">
            <label for="task-title">Task title</label>
            <input type="text" class="form-control" id="task-title" placeholder="A task title" name="task-title" required>
        </div>
        <div class="form-group">
            <label for="task-content">Task content</label>
            <textarea name="task-content" id="task-content" cols="30" rows="10" class="form-control" placeholder="A task description"></textarea>
        </div>
        <div class="form-group">
            <label for="task-start-date">Task start date</label>
            <input type="date" class="form-control" id="task-start-date" name="task-start-date" required>
        </div>
        <div class="form-group">
            <label for="task-start-end">Task end date</label>
            <input type="date" class="form-control" id="task-start-end" name="task-start-end" required>
        </div>
        <div class="form-group">
            <label for="task-author">Choose author</label>
            <select name="task-author" id="task-author" class="form-control">
                <?php foreach ($users as $user) {?>
                <option value="<?php echo $user->id?>"><?php echo $user->email ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Create task</button>
    </form>
</div>

<?php include 'footer.php'; ?>
