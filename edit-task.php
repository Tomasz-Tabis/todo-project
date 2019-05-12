<?php include 'header.php';
if (!isset($_SESSION['loggedIn'])){
    header("Location: index.php");
}

include_once  "app/Classes.php";
$task = \App\Task::find($_GET["id"]);
$users = \App\User::all();

?>

<div class="d-flex justify-content-center">
    <form action="app/controllers/TasksController.php/update" method="POST" class="login col-md-6 col-sm-12 flex-column">
        <div class="text-center mt-1 mb-2">
            Edit task.
        </div>
        <input type="hidden" name="task-id" value="<?php echo $task->id; ?>" required>
        <div class="form-group">
            <label for="task-title">Task title</label>
            <input type="text" class="form-control" id="task-title" placeholder="A task title" name="task-title" value="<?php echo $task->title; ?>" required>
        </div>
        <div class="form-group">
            <label for="task-content">Task content</label>
            <textarea name="task-content" id="task-content" cols="30" rows="10" class="form-control" placeholder="A task description"><?php echo $task->content; ?></textarea>
        </div>
        <div class="form-group">
            <label for="task-start-date">Task start date</label>
            <input type="date" class="form-control" id="task-start-date" name="task-start-date" value="<?php echo $task->start_date ?>" required>
        </div>
        <div class="form-group">
            <label for="task-start-end">Task end date</label>
            <input type="date" class="form-control" id="task-start-end" name="task-start-end" value="<?php echo $task->end_date ?>" required>
        </div>
        <div class="form-group">
            <label for="task-author">Choose author</label>
            <select name="task-author" id="task-author" class="form-control">
                <?php foreach ($users as $user) {?>
                    <option value="<?php echo $user->id ?>" <?php if ($task->author_id == $user->id) { echo "selected"; } ?>><?php echo $user->email ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update task</button>
        <a href="list.php" class="btn btn-warning btn-block ">Cancel edit task</a>
    </form>
</div>

<?php include 'footer.php'; ?>
