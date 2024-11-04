<?php
include('header.php');

if(isset($_POST['register'])) {
    $username = get_safe_value($_POST['username']);
    $password = get_safe_value($_POST['password']);
    // You might want to add more fields for registration, such as email, name, etc.
    
    // Check if the username already exists in the database
    $check_username_query = "SELECT * FROM users WHERE username='$username'";
    $check_username_result = mysqli_query($con, $check_username_query);
    
    if(mysqli_num_rows($check_username_result) > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        // Insert the new user into the database
        $insert_user_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        mysqli_query($con, $insert_user_query);
        
        // Redirect to index.php after successful registration
        header("Location: index.php");
        exit(); // Make sure to exit after redirection
    }
}
?>

<h2>Register</h2>
<form method="post">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="register" value="Register"></td>
        </tr>
        <tr>
            <td></td>
            <td>If you have an account <a href="index.php"> Login here</a></td>
        </tr>
    </table>
</form>

<?php
include('footer.php');
?>
