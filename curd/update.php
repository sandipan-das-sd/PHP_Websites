<?php
include 'connect.php';

$id = isset($_GET['updateid']) ? mysqli_real_escape_string($con, $_GET['updateid']) : null;
if (!$id) {
    header("Location: display.php");
    exit();
}

// Debug query execution
$fetch_sql = "SELECT * FROM curd WHERE id = ?";
$stmt = mysqli_prepare($con, $fetch_sql);

if ($stmt === false) {
    die("Error preparing statement: " . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$userData = mysqli_fetch_assoc($result);

// Debug: Print user data
echo "<!-- User data: " . print_r($userData, true) . " -->";

if (!$userData) {
    header("Location: display.php");
    exit();
}

if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    }
    else if (!preg_match("/^[0-9]{10}$/", $mobile)) {
        $error = "Invalid mobile number format";
    }
    else {
        $sql = "UPDATE curd SET name=?, email=?, mobile=? WHERE id=?";
        $stmt = mysqli_prepare($con, $sql);
        
        if ($stmt === false) {
            $error = "Error preparing statement: " . mysqli_error($con);
        } else {
            mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $mobile, $id);
            
            if(mysqli_stmt_execute($stmt)) {
                header("Location: display.php?update_status=success");
                exit();
            } else {
                $error = "Error updating record: " . mysqli_stmt_error($stmt);
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
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Update User</h1>
            <a href="display.php" class="btn btn-secondary">Back to List</a>
        </div>
        
        <?php if(isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" 
                       placeholder="Enter your name" required 
                       value="<?php echo htmlspecialchars($userData['name'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       placeholder="Enter your email" required
                       value="<?php echo htmlspecialchars($userData['email'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" 
                       placeholder="Enter your mobile number" required
                       value="<?php echo htmlspecialchars($userData['mobile'] ?? ''); ?>">
                <div class="form-text">Please enter a 10-digit mobile number</div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>