<?php
include 'connect.php';

if(isset($_POST['submit'])) {
    // Sanitize and validate input
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    }
    // Validate mobile (basic validation for numbers only)
    else if (!preg_match("/^[0-9]{10}$/", $mobile)) {
        $error = "Invalid mobile number format";
    }
    else {
        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO curd (name, email, mobile, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        
        if ($stmt === false) {
            $error = "Error preparing statement: " . mysqli_error($con);
        } else {
            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $mobile, $password);
            
            if(mysqli_stmt_execute($stmt)) {
                $success = "Data Inserted Successfully";
            } else {
                $error = "Error: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Create an Account</h1>
        
        <?php if(isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($success)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" 
                       placeholder="Enter your name" required 
                       value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       placeholder="Enter your email" required
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" 
                       placeholder="Enter your mobile number" required pattern="[0-9]{10}"
                       value="<?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : ''; ?>">
                <div class="form-text">Please enter a 10-digit mobile number</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" 
                       placeholder="Enter your password" required minlength="8">
                <div class="form-text">Password must be at least 8 characters long</div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>