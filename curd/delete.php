<?php
include 'connect.php';

if(isset($_GET['deleteid'])) {
    $id = mysqli_real_escape_string($con, $_GET['deleteid']);
    
    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM `curd` WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    
    if($stmt === false) {
        die("Error preparing statement: " . mysqli_error($con));
    }
    
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if(mysqli_stmt_execute($stmt)) {
        echo "Deleted Successfully";
        header("Location: display.php?delete_status=success");
    } else {
        die("Error deleting record: " . mysqli_error($con));
    }
    
    mysqli_stmt_close($stmt);
} else {
    header("Location: display.php");
}

mysqli_close($con);
?>