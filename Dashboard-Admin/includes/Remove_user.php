<?php
// Include database connection
include('../../dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user ID from the form
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

    // Check if the user ID is not empty
    if (!empty($user_id)) {
        // Sanitize the user ID (to prevent SQL injection)
        $user_id = mysqli_real_escape_string($con, $user_id);

        // Check if the user exists in the database
        $check_query = "SELECT * FROM users WHERE reg_id = '$user_id'";
        $check_result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // User found, proceed with the removal
            $remove_query = "DELETE FROM users WHERE reg_id = '$user_id'";
            $remove_result = mysqli_query($con, $remove_query);

            if ($remove_result) {
                // User removed successfully, redirect back to UserManagement.php
                header("Location: UserManagement.php");
                exit();
            } else {
                // Error in the removal process
                echo "Error: Unable to remove user. Please try again.";
            }
        } else {
            // User not found in the database, redirect to index.php
            header("Location: index.php");
            exit();
        }
    } else {
        // User ID is empty, redirect to index.php
        header("Location: index.php");
        exit();
    }
} else {
    // If the request method is not POST, redirect to index.php
    header("Location: index.php");
    exit();
}

// Close the database connection
mysqli_close($con);
?>
