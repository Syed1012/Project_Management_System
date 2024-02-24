<?php
// Include your database connection code
include('../../dbcon.php');

// Retrieve values from the form
$user_id = $_POST['user_id'];
$status = $_POST['status'];

// Construct and execute SQL query to update status
$sql = "UPDATE users SET record_status = $status WHERE reg_id = '$user_id'";

if (mysqli_query($con, $sql)) {
    // Status update was successful, you can redirect back to the UserManagement.php page
    header("Location: UserManagement.php");
    exit();
} else {
    // Status update failed, handle the error (e.g., display an error message)
    echo "Error updating status: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>
