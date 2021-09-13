<?php
    require_once './helpers/header.php';
    require_once './db/dbConn.php';
    require_once './helpers/functions.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = CleanInputs($_POST['title']);
        $desc = cleanInputs($_POST['description']);
        $stDate = CleanInputs($_POST['startDate']);
        $enDate = CleanInputs($_POST['endDate']);
        $errors = [];

        //validate desc ...
        if (!validate($title, 'emptyVal')) {
            $errors['title'] = 'title is required !';
        }
        elseif (!validate($title, 'titleVal')) {
            $errors['address'] = 'title must be between 3 and 20 characters !';
        }

        //validate desc ...
        if (!validate($desc, 'emptyVal')) {
            $errors['desc'] = 'description is required !';
        }elseif (!validate($desc, 'descVal')) {
            $errors['desc'] = 'description must be between 10 and 1000 characters !';
        }

        //validate startDate ...
        if (!validate($stDate, 'emptyVal')) {
            $errors['stDate'] = 'start date is required !';
        }

        //validate endtDate ...
        if (!validate($enDate, 'emptyVal')) {
            $errors['enDate'] = 'end date is required !';
        }
        if (count($errors) == 0) {
            $sql = "INSERT INTO tasks (title , description, startdate, enddate) VALUES ('$title', '$desc', '$stDate', '$enDate')";
            $op = mysqli_query($conn, $sql);

            header('location: index.php');
        }


    }


?>
<div class="container">
    <h1 class="text-center text-primary">Create Tasks</h1>
    <form method="POST" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> enctype ="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span>Title</label>
            <input type="text" class="form-control" name="title" value='<?php if (!empty($title)) {echo $title;}?>' id="exampleInputEmail1" aria-describedby="emailHelp">
            <?php
                if (isset($errors['title'])) {
                    echo '<div class=" container alert alert-danger" role="alert">'.$errors['title'].'</div>';
                }
            ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span>Description</label>
            <input type="text" class="form-control" name="description" value='<?php if (!empty($desc)) {echo $desc;}?>' id="exampleInputEmail1" aria-describedby="emailHelp">
            <?php
                if (isset($errors['desc'])) {
                    echo '<div class=" container alert alert-danger" role="alert">'.$errors['desc'].'</div>';
                }
            ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"><span class="text-danger">*</span>Start Date</label>
            <input type="date" class="form-control" name="startDate" value='<?php if (!empty($stDate)) {echo $stDate;}?>' id="exampleInputPassword1">
            <?php
                if (isset($errors['stDate'])) {
                    echo '<div class=" container alert alert-danger" role="alert">'.$errors['stDate'].'</div>';
                }
            ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"><span class="text-danger">*</span>end Date</label>
            <input type="date" class="form-control" name="endDate" value='<?php if (!empty($enDate)) {echo $enDate;}?>' id="exampleInputPassword1">
            <?php
                if (isset($errors['enDate'])) {
                    echo '<div class=" container alert alert-danger" role="alert">'.$errors['enDate'].'</div>';
                }
            ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
 require_once './helpers/footer.php';
?>