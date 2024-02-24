<?php
session_start();

include('../../dbcon.php'); // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_student'])) {
    // Check if the required parameters are set
    if (isset($_POST['project_id'], $_POST['student_id'])) {
        $reg_id = $_POST['project_id'];
        $entered_reg_id = $_POST['student_id'];

        // Step 1: Check if the entered reg_id exists in the users table
        $check_user_query = "SELECT * FROM user_details WHERE reg_id = '$entered_reg_id'";
        $user_result = mysqli_query($con, $check_user_query);

        if (mysqli_num_rows($user_result) > 0) {
            // Step 2: Check if the user is already in the group_management table
            $check_existing_query = "SELECT * FROM group_management WHERE reg_id = '$entered_reg_id' AND project_id = '$reg_id'";
            $existing_result = mysqli_query($con, $check_existing_query);

            if (mysqli_num_rows($existing_result) > 0) {
                // User is already in the group, redirect back to settings.php
                header("Location: settings.php?error=existing_user");
                exit();
            } else {
                // Step 3: Fetch user details and insert into group_management
                $user_details_query = "SELECT user_name FROM user_details WHERE reg_id = '$entered_reg_id'";
                $user_details_result = mysqli_query($con, $user_details_query);

                if ($user_details_row = mysqli_fetch_assoc($user_details_result)) {
                    $user_name = $user_details_row['user_name'];

                    // Insert user details into group_management
                    $insert_query = "INSERT INTO group_management (project_id, reg_id, user_name) VALUES ('$reg_id', '$entered_reg_id', '$user_name')";
                    mysqli_query($con, $insert_query);

                    // Redirect back to group.php
                    header("Location: group.php");
                    exit();
                } else {
                    // Unable to fetch user details, redirect back to settings.php
                    header("Location: settings.php?error=user_not_found");
                    exit();
                }
            }
        } else {
            // User with the entered reg_id does not exist, redirect back to settings.php
            header("Location: settings.php?error=user_not_found");
            exit();
        }
    } else {
        // Redirect back to settings.php if required parameters are not set
        header("Location: settings.php");
        exit();
    }
} else {
    // Redirect back to settings.php if the form is not submitted
    header("Location: settings.php");
    exit();
}
?>
