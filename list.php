<?php include 'header.php';
if (!isset($_SESSION['loggedIn'])){
    header("Location: index.php");
}

include_once  "app/Classes.php";

$sort = 0;
if(isset($_GET["sort"])){
    $sort = $_GET["sort"];
}

$tasks = \App\Task::all($sort);
?>
<div class="actions mb-3">
    <form action="" method="get">
        <label for="sort">Sort</label>
        <select name="sort" id="sort">
            <option value="0"  <?php if($sort == 0) { echo "selected"; } ?>>End date ASC</option>
            <option value="1"  <?php if($sort == 1) { echo "selected"; } ?>>Title ASC</option>
            <option value="2"  <?php if($sort == 2) { echo "selected"; } ?>>Title DESC</option>
            <option value="3"  <?php if($sort == 3) { echo "selected"; } ?>>End date DESC</option>
        </select>
        <button type="submit">Sort</button>
    </form>
    <a href="add-task.php" class="btn btn-success" >Add task</a>
    <a href="javascript:void(0)" id="btnRemoveMore" data-state="0" class="btn btn-danger float-right" >Remove more</a>
    <a href="javascript:void(0)" id="selectAll" data-state="0" class="btn btn-primary mr-2 float-right" style="display: none;" >Select All</a>
</div>


<table class="table">
    <thead>
    <tr>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">End date</th>
        <th scope="col">Last edit</th>
        <th scope="col">Actions</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task){ ?>
    <tr class="<?php if ($task->complete == 1) { echo "table-active"; }; if($task->end_date < date('Y-m-d')){echo "bg-danger";};?>">
        <td><?php echo implode(' ', array_slice(explode(' ', $task->title), 0, 3)) ?></td>
        <td><?php echo implode(' ', array_slice(explode(' ', $task->content), 0, 5));?></td>
        <td><?php echo date("d-m-Y", strtotime($task->end_date)); ?></td>
        <td><?php echo date("d-m-Y", strtotime($task->updated_at)); ?></td>
        <td class="">
            <a href="task-detail.php?id=<?php echo $task->id; ?>" class="btn btn-info" >Detail</a>
            <?php if ($task->complete == 0) {?>
            <a href="app/controllers/TasksController.php/complete?id=<?php echo $task->id; ?>" class="btn btn-primary" >Completed</a>
            <a href="edit-task.php?id=<?php echo $task->id; ?>" class="btn btn-warning" >Edit</a>
            <?php } ?>
            <a href="app/controllers/TasksController.php/delete?id=<?php echo $task->id; ?>" class="btn btn-danger" >Remove</a>
        </td>
        <td>
            <input type="checkbox" name="deleteMore" class="checkbox" data-id="<?php echo $task->id; ?>" style="display: none;s">
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>


<script>

    $(document).on("click", "#btnRemoveMore", function () {
        var state = $(this).data("state");
        if (state === 0){
            stateOne(this);
        } else if (state === 1){
            stateTwo(this);
        }
    });

    var bSelected;
    $(document).on("click", "#selectAll", function () {
        $(".checkbox").prop('checked', !bSelected);
        bSelected = !bSelected;
    });
    
    function stateOne(btn) {
        $(btn).data("state", 1).html("Remove selected");
        $(".checkbox").show();
        $("#selectAll").show();
    }


    var count = 0;
    function stateTwo(btn) {

        var l = $(".checkbox:checked").length;
        $(".checkbox").hide();
        $(".checkbox:checked").each(function () {
            $.ajax({
                type: "GET",
                url: "app/controllers/TasksController.php/delete?id=" + $(this).data("id"),
                success: function () {
                    count++;
                    if (count === l) {
                        location.reload();
                    }
                }
            });
        });
    }
</script>

<?php include 'footer.php'; ?>
