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
    <title>ProjectManagement - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .table-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ecf0f3;
            border-radius: 15px;
            box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
        }

        .table-container table {
            width: 100%;
            background-color: #ecf0f3;
            border-collapse: collapse;
            border-radius: 15px;
        }

        .table-container th,
        .table-container td {
            padding: 10px;
            text-align: left;
            background-color: #ecf0f3;
            border-bottom: 1px solid #ddd;
        }

        .table-container th {
            background-color: #555;
            color: white;
        }

        .table-container a.btn {
            display: inline-block;
            margin-right: 10px;
            margin-top: 5px;
            text-decoration: none;
            padding: 5px 10px;
            background-color: brown;
            color: black;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .table-container a.btn:hover {
            background-color: black;
            color: white;
        }
    </style>
</head>

<?php
include('header.php');
include('../../dbcon.php');

$sql = "SELECT * FROM Projects";
$result = mysqli_query($con, $sql);
?>

<div class="container mt-5 table-container">
    <h1>Edit Projects</h1>

    <table>
        <thead>
            <tr>
                <th>Project ID</th>
                <th>Project Name</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['project_id'] . "</td>";
                    echo "<td>" . $row['project_name'] . "</td>";
                    echo "<td>";
                    echo '<a href="Edit_project.php?project_id=' . $row['project_id'] . '" class="btn btn-primary">Edit Project</a>';
                    echo '&nbsp;';
                    echo '<a href="remove_project.php?project_id=' . $row['project_id'] . '" class="btn btn-danger">Remove Project</a>';
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No projects found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include('footer.php');
include('scripts.php');
?>
