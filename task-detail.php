<?php include 'header.php';
if (!isset($_SESSION['loggedIn'])){
    header("Location: index.php");
}

include_once  "app/Classes.php";
$task = \App\Task::find($_GET["id"]);
?>
<div class="col-md-12">
    <h2><?php echo $task->title; ?></h2>
    <hr>
    <p><?php echo $task->content; ?></p>
    <hr>
    <p><b>Start date: </b><?php echo $task->start_date;?></p>
    <p><b>End date: </b><?php echo $task->end_date;?></p>
    <a href="list.php" class="btn btn-warning btn-block ">Go back</a>
</div>

<?php include 'footer.php'; ?>
