<?php
// Include the necessary database connection and session start
include('../../dbcon.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['reg_id'])) {
    $reg_id = $_SESSION['reg_id'];
    $recent_password = $_POST['recent_password'];
    $new_password = $_POST['new_password'];
    $reenter_new_password = $_POST['reenter_new_password'];

    // Check if the recent password matches the user's current password
    // Assuming passwords are stored as plain text in the database
    $check_query = "SELECT password FROM users WHERE reg_id=?";
    $stmt = mysqli_prepare($con, $check_query);
    mysqli_stmt_bind_param($stmt, "s", $reg_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $current_password);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($recent_password === $current_password) {
        // Recent password is correct, now check if new passwords match
        if ($new_password === $reenter_new_password) {

            // Update the user's password in the users table
            $update_query = "UPDATE users SET password=? WHERE reg_id=?";
            $stmt = mysqli_prepare($con, $update_query);
            mysqli_stmt_bind_param($stmt, "ss", $new_password, $reg_id);

            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($result) {
                // Password updated successfully
                $_SESSION['message'] = "Password updated successfully.";
                header("Location: index.php");
                exit();
            } else {
                // Error occurred while updating the password
                $_SESSION['message'] = "Error updating password.";
                header("Location: Edit-profile.php");
                exit();
            }
        } else {
            // New passwords do not match
            $_SESSION['message'] = "New passwords do not match.";

            header("Location: Edit-profile.php");
            exit();
        }
    } else {
        // Recent password is incorrect
        $_SESSION['message'] = "Recent password is incorrect.";

        header("Location: Edit-profile.php");
        exit();
    }
} else {
    // Redirect to an error page or take appropriate action for missing reg_id or invalid request
    header("Location: error.php");
    exit();
}
