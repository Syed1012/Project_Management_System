<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php");
    exit();
}

// Include the database connection file
include('../../dbcon.php');

// Get the group_id and remove_student_id from the form
$group_id = mysqli_real_escape_string($con, $_POST['group_id']);
$remove_student_id = mysqli_real_escape_string($con, $_POST['remove_student_id']);

// Check if the user is authorized to remove the friend (e.g., is the group creator)
$reg_id = $_SESSION['reg_id'];
$check_auth_query = "SELECT * FROM student_groups WHERE created_by = '$reg_id' AND group_id = '$group_id'";
$check_auth_result = mysqli_query($con, $check_auth_query);

if (mysqli_num_rows($check_auth_result) > 0) {
    // User is authorized to remove the friend

    // Determine which student to remove from the group
    $remove_field = ''; // Initialize a variable to store the field to remove

    // Check which student's ID matches the one to be removed
    $group_query = "SELECT * FROM student_groups WHERE group_id = '$group_id'";
    $group_result = mysqli_query($con, $group_query);
    
    if (mysqli_num_rows($group_result) > 0) {
        $group_data = mysqli_fetch_assoc($group_result);
        
        // Check each student field for a match
        if ($group_data['student1_id'] == $remove_student_id) {
            $remove_field = 'student1';
        } elseif ($group_data['student2_id'] == $remove_student_id) {
            $remove_field = 'student2';
        } elseif ($group_data['student3_id'] == $remove_student_id) {
            $remove_field = 'student3';
        } elseif ($group_data['student4_id'] == $remove_student_id) {
            $remove_field = 'student4';
        }
    }

    // Construct the update query to remove the selected student
    $remove_query = "UPDATE student_groups SET " . $remove_field . "_name = NULL, " . $remove_field . "_id = NULL
                    WHERE group_id = '$group_id'";

    if (mysqli_query($con, $remove_query)) {
        // Redirect back to the show group page
        header("Location: Show_group.php");
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    // User is not authorized to remove the friend
    echo "You are not authorized to remove this friend.";
}
?>