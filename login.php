<?php 
    require_once './helpers/header.php';
    require_once './db/dbConn.php';
    require_once './helpers/functions.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = CleanInputs($_POST['email']);
        $password = CleanInputs($_POST['password']);
        $errors = [];
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
        $hashpassword = md5($password);
        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$hashpassword'";
        $op = mysqli_query($conn, $sql);
        if (count($errors) == 0) {
            if (mysqli_num_rows($op) == 1) {

                $_SESSION['user'] = [
                    'email'=> $email,
                    'password'=> $password,
                ];
                header("Location: index.php");
            }else{
                $errors['log'] = 'your account is not exist, try again!';
            }
        }

    }
?>


    <div class="container">
        <h1 class="text-center text-primary">Log In</h1>
        <?php
            if (isset($errors['log'])) {
                echo '<div class=" container alert alert-danger" role="alert">'.$errors['log'].'</div>';
            }
        ?>
        <span class="text-danger">* required</span>
        <form method="POST" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> enctype ="multipart/form-data">
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
            <div class="text-center">
                <button type="submit" class="mt-3 btn btn-primary">Submit</button>
                <h6 class="text-primary mt-3">if your don't have an account ,you can create one </h6>
                <a href="form.php" class="mt-3 btn btn-primary">Sign IN</a>
            </div>
        </form>
    </div>
<?php require_once './helpers/footer.php';?>