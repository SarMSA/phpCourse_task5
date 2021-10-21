<?php
    require_once './helpers/header.php';
    require_once './db/dbConn.php';
    require_once './helpers/functions.php';


    $sql = "SELECT appointment.* , users.name, roles.title from users JOIN appointment 
            on appointment.doc_id = users.id 
            join roles
            on  roles.id = users.role_id";
    $op = mysqli_query($conn, $sql);
    // var_dump($data);
    mysqli_num_rows($op) ;
    var_dump($data['doc_id']);
    if (!isset($_SESSION['user'])) {
        header('location: login.php');
    }
    else{

?>
<div class="container">
    <h1 class="text-center text-primary">appointment</h1>
    <a href="create.php?id=<?php echo $data['doc_id']?>" class="btn btn-success">Create a new appointment</a>
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
        <th scope="col">role</th>
        <th scope="col">name</th>
        <th scope="col">day</th>
        <th scope="col">start</th>
        <th scope="col">end</th>
        <th scope="col">Action</th>

        </tr>
    </thead>
    <tbody>
    <?php while ($data = mysqli_fetch_assoc($op)) {?>
        <tr>
            <th scope="row"><?php echo $data['id']?></th>
            <td><?php echo $data['title']?></td>
            <td><?php echo $data['name']?></td>
            <td><?php echo $data['day']?></td>
            <td><?php echo $data['start']?></td>
            <td><?php echo $data['end']?></td>
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