<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Registration</title>

    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="logo.png" />
                            </a>
                        </div>
                        <div class="login-form">
                            <?php
                            include('config.php');
                            include('functions.php');
                            $msg = "";

                            if (isset($_POST['register'])) {
                                $username = get_safe_value($_POST['username']);
                                $password = get_safe_value($_POST['password']);

                                $check_username_query = "SELECT * FROM users WHERE username='$username'";
                                $check_username_result = mysqli_query($con, $check_username_query);

                                if (mysqli_num_rows($check_username_result) > 0) {
                                    $msg = '<div style="color: red;">Username already exists. Please choose a different username.</div>';
                                } else {
                                    $insert_user_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
                                    mysqli_query($con, $insert_user_query);

                                    // Redirect to index.php after successful registration
                                    header("Location: index.php");
                                    exit();
                                }
                            }
                            ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" required>
                                </div>

                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="register">Register</button>
                            </form>
                            <p>Already have an account? <a href="index.php">Login here</a></p>
                            <?php echo $msg; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
</body>

</html>
