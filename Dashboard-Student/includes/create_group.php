<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page if not logged in
    exit();
}

include('../../dbcon.php');

// Initialize the base group ID
$base_group_id = "G2027";

// Generate the next group number
$query = "SELECT MAX(CAST(SUBSTRING(group_id, 6) AS UNSIGNED)) AS max_number FROM student_groups WHERE group_id LIKE '$base_group_id%'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$max_number = $row['max_number'];
$new_group_number = $max_number + 1;

// Create the new group ID by appending the new group number to the base group ID
$group_id = $base_group_id . $new_group_number;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission

    // Get student details from the form
    $student1_name = mysqli_real_escape_string($con, $_POST['student1_name']);
    $student1_id = mysqli_real_escape_string($con, $_POST['student1_id']);
    $student2_name = mysqli_real_escape_string($con, $_POST['student2_name']);
    $student2_id = mysqli_real_escape_string($con, $_POST['student2_id']);
    $student3_name = mysqli_real_escape_string($con, $_POST['student3_name']);
    $student3_id = mysqli_real_escape_string($con, $_POST['student3_id']);
    $student4_name = mysqli_real_escape_string($con, $_POST['student4_name']);
    $student4_id = mysqli_real_escape_string($con, $_POST['student4_id']);

    // Check if all student IDs already exist in the users table
    $existing_student_ids = array($student1_id, $student2_id, $student3_id, $student4_id);
    foreach ($existing_student_ids as $student_id) {
        $check_query = "SELECT COUNT(*) AS count FROM users WHERE reg_id = '$student_id'";
        $check_result = mysqli_query($con, $check_query);
        $check_row = mysqli_fetch_assoc($check_result);

        // If the student ID does not exist in users table, redirect with an error message
        if ($check_row['count'] == 0) {
            header("Location: Group.php?error=user_not_found");
            exit();
        }
    }

    // Check if any of the student IDs already exist in student_groups
    foreach ($existing_student_ids as $student_id) {
        $check_query = "SELECT COUNT(*) AS count FROM student_groups WHERE student1_id = '$student_id' OR student2_id = '$student_id' OR student3_id = '$student_id' OR student4_id = '$student_id'";
        $check_result = mysqli_query($con, $check_query);
        $check_row = mysqli_fetch_assoc($check_result);

        // If the student ID exists in any group, redirect with an error message
        if ($check_row['count'] > 0) {
            header("Location: Group.php?error=already_in_group");
            exit();
        }
    }

    // Set created_by as the reg_id of the user creating the group
    $created_by = $_SESSION['reg_id'];

    // Insert the group and student details into the database, including the created_by field
    $insert_query = "INSERT INTO student_groups (group_id, student1_name, student1_id, student2_name, student2_id, student3_name, student3_id, student4_name, student4_id, created_by) VALUES ('$group_id', '$student1_name', '$student1_id', '$student2_name', '$student2_id', '$student3_name', '$student3_id', '$student4_name', '$student4_id', '$created_by')";

    if (mysqli_query($con, $insert_query)) {
        // Redirect to the index.php page after successful insertion
        header("Location: index.php");
        exit();
    } else {
        // Handle insertion error
        echo "Error: " . mysqli_error($con);
    }
}
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Create Group</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<style>
    body {
        background-color: #f4f4f4;
    }

    .container {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
    }

    .table {
        width: 80%;
        margin: 0 auto;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        font-size: x-large;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .button-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    input[type="submit"] {
        padding: 10px 20px;
        background-color: brown;
        color: black;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: x-large;
        font-weight: bold;
    }

    input[type="submit"]:hover {
        background-color: black;
        color: brown;
    }
</style>

<?php
include('header.php');
?>

<div class="container mt-5">
    <h2>Group ID: <?php echo $group_id; ?></h2>

    <!-- Create a form for user input within the table -->
    <form method="POST" action="">
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Group ID</th>
                    <th>Student Name</th>
                    <th>Student ID</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="4"><?php echo $group_id; ?></td>
                    
                    <td><input type="text" name="student1_name" id="student1_name"required > </td>
                    <td><input type="text" name="student1_id" id="student1_id" required></td>
                </tr>
                <tr>
                    <td><input type="text" name="student2_name" id="student2_name" required></td>
                    <td><input type="text" name="student2_id" id="student2_id" required></td>
                </tr>
                <tr>
                    <td><input type="text" name="student3_name" id="student3_name" required></td>
                    <td><input type="text" name="student3_id" id="student3_id" required></td>
                </tr>
                <tr>
                    <td><input type="text" name="student4_name" id="student4_name" required></td>
                    <td><input type="text" name="student4_id" id="student4_id" required></td>
                </tr>
            </tbody>
        </table>

        <div class="button-container">
        <input type="submit" class="ml-3" value="Create Group">
        </div>
    </form>
</div>

<?php
include('scripts.php');
?>