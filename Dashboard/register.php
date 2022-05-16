<?php
include_once "partial/DB_CONNECTION.php";
$errors = [];
$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    if (empty($name)) {
        $errors['name_error'] = "name is required, please fill it";
    }
    if (empty($email)) {
        $errors['email_error'] = "email is required, please fill it";
    }
    if (empty($password)) {
        $errors['password_error'] = "password is required, please fill it";
    }


    if (count($errors) > 0) {
        $errors['general_error'] = "Please Fix All Errors";
    } else {
        $query = "INSERT INTO user (name,email,password)
        VALUES('$name','$email','$password')";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $errors = [];
            $success = true;
            header('Location:login.php');
        } else {
            $errors['general_error'] = "please fix all errors";
        }
    }
}

?>









<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php
include "partial/header.php";

?>

<body class="vertical-layout vertical-menu-modern 1-column   menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <div class="p-1">
                                            <img src="app-assets/images/logo/logo-dark.png" alt="branding logo">
                                        </div>
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span>Sign up with Modern</span>
                                    </h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <?php
                                        if (!empty($errors['general_error'])) {
                                            echo "<div class='alert alert-danger'>" . $errors["general_error"] . "</div>";
                                        } elseif ($success) {
                                            echo "<div class='alert alert-success'>Admin Added Succesfully</div>";
                                        }
                                        ?>
                                        <form method="POST" class="form-horizontal form-simple" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                                <input type="text" class="form-control form-control-lg input-lg" name='name' id="user-name" placeholder="Your Name" required>
                                                <?php
                                                if (!empty($errors['name_error'])) {
                                                    echo "<span class='text-danger'>" . $errors["name_error"] . "</span>";
                                                }
                                                ?>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                                <input type="email" class="form-control form-control-lg input-lg" name='email' id="user-name" placeholder="Your Username" required>
                                                <?php
                                                if (!empty($errors['email_error'])) {
                                                    echo "<span class='text-danger'>" . $errors["email_error"] . "</span>";
                                                }
                                                ?>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" name='password' class="form-control form-control-lg input-lg" id="user-password" placeholder="Enter Password" required>
                                                <?php
                                                if (!empty($errors['password_error'])) {
                                                    echo "<span class='text-danger'>" . $errors["password_error"] . "</span>";
                                                }
                                                ?>
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                            </fieldset>

                                            <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Sign Up</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="">
                                        <p class="float-sm-right text-center m-0">Have An Account? <a href="login.php" class="card-link">Login</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php
    include_once "partial/footer.php";
    ?>
</body>

</html>