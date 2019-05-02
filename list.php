<?php include 'header.php';
if (!isset($_SESSION['loggedIn'])){
    header("Location: index.php");
}
?>
<div class="actions mb-3">
    <a href="add-task.php" class="btn btn-success" >Add task</a>
    <a href="" class="btn btn-danger float-right" >Remove more</a>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">End date</th>
        <th scope="col">Last edit</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Add task</td>
        <td>Just add a new...</td>
        <td>01-05-2019 13:15</td>
        <td>02-05-2019 19:00</td>
        <td>
            <a href="" class="btn btn-primary" >Completed</a>
            <a href="" class="btn btn-info" >Detail</a>
            <a href="" class="btn btn-warning" >Edit</a>
            <a href="" class="btn btn-danger" >Remove</a>
        </td>
    </tr>
    <tr>
        <td>Add task</td>
        <td>Just add a new...</td>
        <td>01-05-2019 13:15</td>
        <td>02-05-2019 19:00</td>
        <td class="">
            <a href="" class="btn btn-primary" >Completed</a>
            <a href="" class="btn btn-info" >Detail</a>
            <a href="" class="btn btn-warning" >Edit</a>
            <a href="" class="btn btn-danger" >Remove</a>
        </td>
    </tr>
    <tr>
        <td>Add task</td>
        <td>Just add a new...</td>
        <td>01-05-2019 13:15</td>
        <td>02-05-2019 19:00</td>
        <td class="">
            <a href="" class="btn btn-primary" >Completed</a>
            <a href="" class="btn btn-info" >Detail</a>
            <a href="" class="btn btn-warning" >Edit</a>
            <a href="" class="btn btn-danger" >Remove</a>
        </td>
    </tr>
    </tbody>
</table>
<?php include 'footer.php'; ?>
