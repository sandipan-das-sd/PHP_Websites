<?php
$con = new mysqli('localhost', 'root', '', 'curd');
if ($con) {
    echo "Connection Successful"; // Add the missing semicolon here
} else {
    die(mysqli_error($con));
}
?>
