<?php 
    require_once './helpers/header.php';
    require_once './db/dbConn.php';
    require_once './helpers/functions.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = CleanInputs($_POST['name']);
        $email = CleanInputs($_POST['email']);
        $password = CleanInputs($_POST['password']);
        $errors = [];
        //validate name ...
        if (!validate($name, 'emptyVal')) {
            $errors['name'] = 'name is required !';
        }
        elseif (!validate($name, 'nameVal')) {
            $errors['name'] = 'name: You have to enter only alphabets and spaces';
        }
        //validate email ...
        if (!validate($email, 'emptyVal')) {
            $errors['email'] = 'email is required !';
        }
        elseif (!validate($email, 'emailVal')) {
            $errors['email'] = 'Invalid email';
        }
        //validate password ...
        if (!validate($password, 'emptyVal')) {
            $errors['password'] = 'password is required !';
        }
        elseif (!validate($password, 'passVal')) {
            $errors['password'] = 'password is at least 6 charaters !';
        }

        if (count($errors) == 0) {
            $hashpassword = md5($password);
                $_SESSION['user'] = [
                                    'name' => $name,
                                    'email'=> $email,
                                    'password'=> $password,
                ];
                $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashpassword')";
                $op = mysqli_query($conn, $sql);
                header("Location: index.php");
        }

    }
?>


    <div class="container">
        <h1 class="text-center text-primary">Register</h1>
        <span class="text-danger">* required</span>
        <form method="POST" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> enctype ="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span> Name</label>
                <input type="text" class="form-control" name="name" value='<?php if (!empty($name)) {echo $name;}?>' id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php
                    if (isset($errors['name'])) {
                        echo '<div class=" container alert alert-danger" role="alert">'.$errors['name'].'</div>';
                    }
                ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span> Email address</label>
                <input type="email" class="form-control" name="email" value='<?php if (!empty($email)) {echo $email;}?>' id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php
                    if (isset($errors['email'])) {
                        echo '<div class=" container alert alert-danger" role="alert">'.$errors['email'].'</div>';
                    }
                ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"><span class="text-danger">*</span> Password</label>
                <input type="password" class="form-control" name="password" value='<?php if (!empty($password)) {echo $password;}?>' id="exampleInputPassword1">
                <?php
                    if (isset($errors['password'])) {
                        echo '<div class=" container alert alert-danger" role="alert">'.$errors['password'].'</div>';
                    }
                ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?php require_once './helpers/footer.php';?>