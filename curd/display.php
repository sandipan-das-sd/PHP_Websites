<?php
include 'connect.php';

// Debug: Check table structure
$debug = mysqli_query($con, "DESCRIBE curd");
if($debug) {
    echo "<!-- Table structure:\n";
    while($row = mysqli_fetch_assoc($debug)) {
        echo $row['Field'] . " - " . $row['Type'] . "\n";
    }
    echo "-->";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>User Data</h1>
            <a href="user.php" class="btn btn-primary">Add User</a>
        </div>

        <?php if(isset($_GET['update_status']) && $_GET['update_status'] == 'success'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                User updated successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Debug: Print actual query
                $sql = "SELECT id, name, email, mobile FROM curd";
                $result = mysqli_query($con, $sql);
                
                if($result) {
                    while($row = mysqli_fetch_assoc($result)) {
                        // Debug: Print row data
                        echo "<!-- Row data: " . print_r($row, true) . " -->";
                        
                        // Make sure to check if each field exists
                        $id = isset($row['id']) ? $row['id'] : 'N/A';
                        $name = isset($row['name']) ? htmlspecialchars($row['name']) : 'N/A';
                        $email = isset($row['email']) ? htmlspecialchars($row['email']) : 'N/A';
                        $mobile = isset($row['mobile']) ? htmlspecialchars($row['mobile']) : 'N/A';
                        
                        echo "<tr>
                                <td>{$id}</td>
                                <td>{$name}</td>
                                <td>{$email}</td>
                                <td>{$mobile}</td>
                                <td>
                                    <a href='update.php?updateid={$id}' class='btn btn-warning btn-sm'>Update</a>
                                    <a href='delete.php?deleteid={$id}' class='btn btn-danger btn-sm'
                                       onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<!-- Query error: " . mysqli_error($con) . " -->";
                }
                ?>
            </tbody>
        </table>

        <?php
        if(!$result || mysqli_num_rows($result) == 0) {
            echo '<div class="alert alert-info text-center">
                    No users found in the database.
                  </div>';
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>