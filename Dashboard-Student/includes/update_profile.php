<?php
session_start();
include('../../dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['reg_id'])) {
    $reg_id = $_SESSION['reg_id'];
    $user_name = $_POST['inputUsername']; 
    $first_name = $_POST['inputFirstName'];
    $last_name = $_POST['inputLastName'];
    $email = $_POST['inputEmail'];
    $phone_number = $_POST['inputPhone'];

    // Check if the user exists in the user_details table
    $check_query = "SELECT COUNT(*) FROM user_details WHERE reg_id=?";
    $stmt = mysqli_prepare($con, $check_query);
    mysqli_stmt_bind_param($stmt, "s", $reg_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($user_count > 0) {
        // User profile already exists, update the existing data
        $update_query = "UPDATE user_details SET user_name=?, first_name=?, last_name=?, email=?, phone_number=? WHERE reg_id=?";
        $stmt = mysqli_prepare($con, $update_query);
        mysqli_stmt_bind_param($stmt, "ssssss", $user_name, $first_name, $last_name, $email, $phone_number, $reg_id);
    } else {
        // User profile does not exist, insert a new profile
        $insert_query = "INSERT INTO user_details (reg_id, user_name, first_name, last_name, email, phone_number) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $insert_query);
        mysqli_stmt_bind_param($stmt, "ssssss", $reg_id, $user_name, $first_name, $last_name, $email, $phone_number);
    }

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // User details updated or inserted successfully
        $_SESSION['message'] = "User details updated successfully.";
        header("Location: index.php");
        exit();
    } else {
        // Error occurred while updating or inserting
        $_SESSION['message'] = "Error updating user details.";
        header("Location: Edit-profile.php");
        exit();
    }
} else {
    // Redirect to an error page or take appropriate action for missing reg_id or invalid request
    header("Location: error.php");
    exit();
}

?>
