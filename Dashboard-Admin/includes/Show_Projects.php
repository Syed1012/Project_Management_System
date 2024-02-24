<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page
    exit();
}
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Show Projects - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<?php
include('header.php');
include('../../dbcon.php'); // Database connection code

// Fetch project details from the database
$sql = "SELECT * FROM projects"; 
$result = mysqli_query($con, $sql);
?>


<div class="container mt-5">
    <h1>Show Projects</h1>

    <table class="table table-bordered" id="projectTable">
        <thead>
            <tr>
                <th>Project ID</th>
                <th>Project Name</th>
                <th>Project Description</th>
                <th>Hardware Requirement</th>
                <th>Project Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['project_id'] . "</td>";
                    echo "<td>" . $row['project_name'] . "</td>";
                    echo "<td>" . $row['project_description'] . "</td>";
                    echo "<td>" . $row['hardware_requirement'] . "</td>";
                    echo "<td>" . ($row['project_status'] == 0 ? "Not Available" : "Available") . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No projects found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php

include('footer.php');
include('scripts.php');
?>