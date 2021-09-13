<?php
    require_once './helpers/header.php';
    require_once './db/dbConn.php';
    require_once './helpers/functions.php';


    $sql = "SELECT * FROM tasks";
    $op = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($op);
    if (!isset($_SESSION['user'])) {
        header('location: login.php');
    }
    else{

?>
<div class="container">
    <h1 class="text-center text-primary">TASKS</h1>
    <a href="create.php" class="btn btn-success">Create a new task</a>
    <?php
        if (isset($_SESSION['message'])) {
            echo '<div class=" container alert alert-danger" role="alert">'.$_SESSION['message'].'</div>';
            unset($_SESSION['message']);
        }
    ?>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">title</th>
        <th scope="col">description</th>
        <th scope="col">startdate</th>
        <th scope="col">enddate</th>
        <th scope="col">Action</th>

        </tr>
    </thead>
    <tbody>
<?php while ($data = mysqli_fetch_assoc($op)) {?>
        <tr>
            <th scope="row"><?php echo $data['id']?></th>
            <td><?php echo $data['title']?></td>
            <td><?php echo $data['description']?></td>
            <td><?php echo $data['startdate']?></td>
            <td><?php echo $data['enddate']?></td>
            <td>
                <a href="delete.php?id=<?php echo $data['id']?>" onclick="return confirm('Are you sure to delete this task?')" class="btn btn-danger">Delete</a>
            </td>
        </tr>
<?php } ?>
    </tbody>
    </table>
    <a href="logOut.php" class="btn btn-info">Log Out</a>
</div>
<?php
 } require_once './helpers/footer.php';
?>