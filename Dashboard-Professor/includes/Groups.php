<?php
session_start();
include('../../dbcon.php');

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php");
    exit();
}

if (isset($_POST['add_student'])) {
    $student_id = $_POST['student_id'];

    $query = "SELECT users.reg_id, user_details.user_name 
              FROM users 
              JOIN user_details ON users.reg_id = user_details.reg_id 
              WHERE users.reg_id = :student_id";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $student_reg_id = $row['reg_id'];
        $student_name = $row['user_name'];

        // Add the student to the group (You need to implement this part)
        // Example: Insert a new record in the 'groups' table
        $insert_query = "INSERT INTO groups (student_id, project_status_percentage) 
                         VALUES (:student_id, 0)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bindParam(':student_id', $student_reg_id, PDO::PARAM_STR);
        $insert_stmt->execute();

        // You can also return a success message or redirect to the same page
        echo "Student $student_name ($student_reg_id) added to the group successfully.";
    } else {
        echo "Student not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>


<style>
    .table-container {
        max-width: 800px;
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

    .progress {
        background-color: #692833;
        /* Background color of the entire progress bar */
    }

    .progress-bar {
        height: 20px;
    }

    .bg-success {
        background-color: #28a745;
        /* Color for completed reviews */
    }

    .bg-danger {
        background-color: #dc3545;
        /* Color for incomplete reviews */
    }
</style>

<?php
include('header.php');
?>


<body>

    <div class="container mt-5 table-container">
        <h1>Groups Management</h1>

        <!-------------------------------- GROUP 1 PROJECT ----------------------------------------->
        <br>
        <!-- Project Details 1-->
        <div class="project-details">
            <div class="names">
                <h2>Project ID 1</h2>
                <h4>Project Name</h4>
            </div>
        </div>

        <br>
        <!-- Students Table 1-->
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Project Status</th>
                    <th>Edit Status</th>
                    <th>
                        <form method="POST" action="add_student.php">
                            <input type="hidden" name="project_id" value="<?php echo $reg_id; ?>">
                            <input type="text" name="student_id" required>
                            <button type="submit" name="add_student" class="bt mt-2">Add Group</button>
                        </form>
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>

            <tbody>

                <!-- -------------------- Table row  1 data ---------------------- -->

                <tr>
                    <td>
                        <?php
                        if (isset($student1_id) && $student1_id !== null) {
                            echo $student1_id;
                        } else {
                            echo "1"; // Default student id
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($student1_name) && $student1_name !== null) {
                            echo $student1_name;
                        } else {
                            echo "Student 1"; // Default student name
                        }
                        ?>
                    </td>

                    <td>
                        <!-- Separate divs for progress bar and completion percentage -->
                        <div class="progress">
                            <div class="progress-bar bg-success bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Edit Status
                            </button>
                            <ul class="dropdown-menu" style="min-width: 200px; font-weight:bold; ">
                                <li>
                                    <a class="dropdown-item" href="#" data-progress="25">Review 1</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 2</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 3</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 4</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger">Remove Student</button>
                    </td>
                </tr>

                <!-- -------------------- Table row  2 data ---------------------- -->

                <tr>
                    <td>
                        <?php
                        if (isset($student2_id) && $student2_id !== null) {
                            echo $student2_id;
                        } else {
                            echo "2"; // Default student id
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($student2_name) && $student2_name !== null) {
                            echo $student2_name;
                        } else {
                            echo "Student 2"; // Default student name
                        }
                        ?>
                    </td>

                    <td>
                        <!-- Separate divs for progress bar and completion percentage -->
                        <div class="progress">
                            <div class="progress-bar bg-success bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Edit Status
                            </button>
                            <ul class="dropdown-menu" style="min-width: 200px; font-weight:bold; ">
                                <li>
                                    <a class="dropdown-item" href="#" data-progress="25">Review 1</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 2</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 3</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 4</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                            </ul>
                        </div>
                    </td>

                    <td>
                        <button type="button" class="btn btn-sm btn-danger">Remove Student</button>
                    </td>
                </tr>


                <!-- -------------------- Table row  3 data ---------------------- -->
                <tr>
                    <td>
                        <?php
                        if (isset($student3_id) && $student3_id !== null) {
                            echo $student3_id;
                        } else {
                            echo "3"; // Default student id
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($student3_name) && $student3_name !== null) {
                            echo $student3_name;
                        } else {
                            echo "Student 3"; // Default student name
                        }
                        ?>
                    </td>

                    <td>
                        <!-- Separate divs for progress bar and completion percentage -->
                        <div class="progress">
                            <div class="progress-bar bg-success bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Edit Status
                            </button>
                            <ul class="dropdown-menu" style="min-width: 200px; font-weight:bold; ">
                                <li>
                                    <a class="dropdown-item" href="#" data-progress="25">Review 1</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 2</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 3</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 4</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                            </ul>
                        </div>
                    </td>

                    <td>
                        <button type="button" class="btn btn-sm btn-danger">Remove Student</button>
                    </td>
                </tr>

                <!-- -------------------- Table row  4 data ---------------------- -->
                <tr>
                    <td>
                        <?php
                        if (isset($student4_id) && $student4_id !== null) {
                            echo $student4_id;
                        } else {
                            echo "4"; // Default student id
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($student4_name) && $student4_name !== null) {
                            echo $student4_name;
                        } else {
                            echo "Student 4"; // Default student name
                        }
                        ?>
                    </td>

                    <td>
                        <!-- Separate divs for progress bar and completion percentage -->
                        <div class="progress">
                            <div class="progress-bar bg-success bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Edit Status
                            </button>
                            <ul class="dropdown-menu" style="min-width: 200px; font-weight:bold; ">
                                <li>
                                    <a class="dropdown-item" href="#" data-progress="25">Review 1</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 2</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 3</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 4</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                            </ul>
                        </div>
                    </td>

                    <td>
                        <button type="button" class="btn btn-sm btn-danger">Remove Student</button>
                    </td>
                </tr>

            </tbody>
        </table>

        <!-------------------------------- GROUP 2 PROJECT ----------------------------------------->
        <br>
        <!-- Project Details 2-->
        <div class="project-details">
            <h2>Project ID 2</h2>
            <h4>Project Name</h4>
        </div>

        <br>
        <!-- Students Table 2-->
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Project Status</th>
                    <th>Edit Status</th>
                    <th>
                        <form method="POST" action="add_student.php">
                            <input type="hidden" name="project_id" value="<?php echo $reg_id; ?>">
                            <input type="text" name="student_id" required>
                            <button type="submit" name="add_student" class="bt mt-2">Add Group</button>
                        </form>
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>

            <tbody>

                <!-- -------------------- Table row  1 data ---------------------- -->

                <tr>
                    <td>
                        <?php
                        if (isset($student1_id) && $student1_id !== null) {
                            echo $student1_id;
                        } else {
                            echo "1"; // Default student id
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($student1_name) && $student1_name !== null) {
                            echo $student1_name;
                        } else {
                            echo "Student 1"; // Default student name
                        }
                        ?>
                    </td>

                    <td>
                        <!-- Separate divs for progress bar and completion percentage -->
                        <div class="progress">
                            <div class="progress-bar bg-success bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Edit Status
                            </button>
                            <ul class="dropdown-menu" style="min-width: 200px; font-weight:bold; ">
                                <li>
                                    <a class="dropdown-item" href="#" data-progress="25">Review 1</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 2</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 3</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 4</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger">Remove Student</button>
                    </td>
                </tr>

                <!-- -------------------- Table row  2 data ---------------------- -->

                <tr>
                    <td>
                        <?php
                        if (isset($student2_id) && $student2_id !== null) {
                            echo $student2_id;
                        } else {
                            echo "2"; // Default student id
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($student2_name) && $student2_name !== null) {
                            echo $student2_name;
                        } else {
                            echo "Student 2"; // Default student name
                        }
                        ?>
                    </td>

                    <td>
                        <!-- Separate divs for progress bar and completion percentage -->
                        <div class="progress">
                            <div class="progress-bar bg-success bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Edit Status
                            </button>
                            <ul class="dropdown-menu" style="min-width: 200px; font-weight:bold; ">
                                <li>
                                    <a class="dropdown-item" href="#" data-progress="25">Review 1</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 2</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 3</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 4</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                            </ul>
                        </div>
                    </td>

                    <td>
                        <button type="button" class="btn btn-sm btn-danger">Remove Student</button>
                    </td>
                </tr>


                <!-- -------------------- Table row  3 data ---------------------- -->
                <tr>
                    <td>
                        <?php
                        if (isset($student3_id) && $student3_id !== null) {
                            echo $student3_id;
                        } else {
                            echo "3"; // Default student id
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($student3_name) && $student3_name !== null) {
                            echo $student3_name;
                        } else {
                            echo "Student 3"; // Default student name
                        }
                        ?>
                    </td>

                    <td>
                        <!-- Separate divs for progress bar and completion percentage -->
                        <div class="progress">
                            <div class="progress-bar bg-success bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Edit Status
                            </button>
                            <ul class="dropdown-menu" style="min-width: 200px; font-weight:bold; ">
                                <li>
                                    <a class="dropdown-item" href="#" data-progress="25">Review 1</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 2</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 3</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 4</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                            </ul>
                        </div>
                    </td>

                    <td>
                        <button type="button" class="btn btn-sm btn-danger">Remove Student</button>
                    </td>
                </tr>

                <!-- -------------------- Table row  4 data ---------------------- -->
                <tr>
                    <td>
                        <?php
                        if (isset($student4_id) && $student4_id !== null) {
                            echo $student4_id;
                        } else {
                            echo "4"; // Default student id
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($student4_name) && $student4_name !== null) {
                            echo $student4_name;
                        } else {
                            echo "Student 4"; // Default student name
                        }
                        ?>
                    </td>

                    <td>
                        <!-- Separate divs for progress bar and completion percentage -->
                        <div class="progress">
                            <div class="progress-bar bg-success bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Edit Status
                            </button>
                            <ul class="dropdown-menu" style="min-width: 200px; font-weight:bold; ">
                                <li>
                                    <a class="dropdown-item" href="#" data-progress="25">Review 1</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 2</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 3</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 4</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                            </ul>
                        </div>
                    </td>

                    <td>
                        <button type="button" class="btn btn-sm btn-danger">Remove Student</button>
                    </td>
                </tr>

            </tbody>
        </table>


        <!-------------------------------- GROUP 3 PROJECT ----------------------------------------->

        <br>
        <!-- Project Details 3-->
        <div class="project-details">
            <h2>Project ID 3</h2>
            <h4>Project Name</h4>
        </div>

        <br>
        <!-- Students Table 3-->
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Project Status</th>
                    <th>Edit Status</th>
                    <th>
                        <form method="POST" action="add_student.php">
                            <input type="hidden" name="project_id" value="<?php echo $reg_id; ?>">
                            <input type="text" name="student_id" required>
                            <button type="submit" name="add_student" class="bt mt-2">Add Group</button>
                        </form>
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>

            <tbody>

                <!-- -------------------- Table row  1 data ---------------------- -->

                <tr>
                    <td>
                        <?php
                        if (isset($student1_id) && $student1_id !== null) {
                            echo $student1_id;
                        } else {
                            echo "1"; // Default student id
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($student1_name) && $student1_name !== null) {
                            echo $student1_name;
                        } else {
                            echo "Student 1"; // Default student name
                        }
                        ?>
                    </td>

                    <td>
                        <!-- Separate divs for progress bar and completion percentage -->
                        <div class="progress">
                            <div class="progress-bar bg-success bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Edit Status
                            </button>
                            <ul class="dropdown-menu" style="min-width: 200px; font-weight:bold; ">
                                <li>
                                    <a class="dropdown-item" href="#" data-progress="25">Review 1</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 2</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 3</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 4</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger">Remove Student</button>
                    </td>
                </tr>

                <!-- -------------------- Table row  2 data ---------------------- -->

                <tr>
                    <td>
                        <?php
                        if (isset($student2_id) && $student2_id !== null) {
                            echo $student2_id;
                        } else {
                            echo "2"; // Default student id
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($student2_name) && $student2_name !== null) {
                            echo $student2_name;
                        } else {
                            echo "Student 2"; // Default student name
                        }
                        ?>
                    </td>

                    <td>
                        <!-- Separate divs for progress bar and completion percentage -->
                        <div class="progress">
                            <div class="progress-bar bg-success bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Edit Status
                            </button>
                            <ul class="dropdown-menu" style="min-width: 200px; font-weight:bold; ">
                                <li>
                                    <a class="dropdown-item" href="#" data-progress="25">Review 1</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 2</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 3</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 4</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                            </ul>
                        </div>
                    </td>

                    <td>
                        <button type="button" class="btn btn-sm btn-danger">Remove Student</button>
                    </td>
                </tr>


                <!-- -------------------- Table row  3 data ---------------------- -->
                <tr>
                    <td>
                        <?php
                        if (isset($student3_id) && $student3_id !== null) {
                            echo $student3_id;
                        } else {
                            echo "3"; // Default student id
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($student3_name) && $student3_name !== null) {
                            echo $student3_name;
                        } else {
                            echo "Student 3"; // Default student name
                        }
                        ?>
                    </td>

                    <td>
                        <!-- Separate divs for progress bar and completion percentage -->
                        <div class="progress">
                            <div class="progress-bar bg-success bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Edit Status
                            </button>
                            <ul class="dropdown-menu" style="min-width: 200px; font-weight:bold; ">
                                <li>
                                    <a class="dropdown-item" href="#" data-progress="25">Review 1</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 2</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 3</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 4</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                            </ul>
                        </div>
                    </td>

                    <td>
                        <button type="button" class="btn btn-sm btn-danger">Remove Student</button>
                    </td>
                </tr>

                <!-- -------------------- Table row  4 data ---------------------- -->
                <tr>
                    <td>
                        <?php
                        if (isset($student4_id) && $student4_id !== null) {
                            echo $student4_id;
                        } else {
                            echo "4"; // Default student id
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($student1_name) && $student1_name !== null) {
                            echo $student1_name;
                        } else {
                            echo "Student 4"; // Default student name
                        }
                        ?>
                    </td>

                    <td>
                        <!-- Separate divs for progress bar and completion percentage -->
                        <div class="progress">
                            <div class="progress-bar bg-success bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Edit Status
                            </button>
                            <ul class="dropdown-menu" style="min-width: 200px; font-weight:bold; ">
                                <li>
                                    <a class="dropdown-item" href="#" data-progress="25">Review 1</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 2</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 3</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                                <li>
                                    <a class="dropdown-item mt-2" href="#" data-progress="25">Review 4</a>
                                    <button type="button" class="btn btn-sm btn-success">Completed</button>
                                    <button type="button" class="btn btn-sm btn-danger">Incomplete</button>
                                </li>
                            </ul>
                        </div>
                    </td>

                    <td>
                        <button type="button" class="btn btn-sm btn-danger">Remove Student</button>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownButtons = document.querySelectorAll(".btn");

            dropdownButtons.forEach((button) => {
                button.addEventListener("click", function(e) {
                    e.preventDefault();
                    const isCompleted = button.classList.contains("btn-success");
                    const isIncomplete = button.classList.contains("btn-danger");

                    const progressBar = button.closest("tr").querySelector(".progress-bar");
                    let currentPercentage = parseInt(progressBar.style.width);

                    const progressElement = button.parentElement.querySelector("[data-progress]");

                    if (progressElement) {
                        const progress = parseInt(progressElement.getAttribute("data-progress"));

                        if (isCompleted) {
                            currentPercentage += progress;
                        } else if (isIncomplete && currentPercentage > 0) {
                            currentPercentage -= progress;
                        }

                        currentPercentage = Math.min(Math.max(currentPercentage, 0), 100);

                        updateProgressBar(progressBar, currentPercentage);
                        const studentId = button.closest("tr").querySelector("td:first-child").textContent;
                        updateProgressInDatabase(studentId, currentPercentage);
                    }
                });
            });

            const addStudentButton = document.querySelector("[name='add_student']");
            addStudentButton.addEventListener("click", function(e) {
                e.preventDefault();
                const studentIdInput = document.querySelector("[name='student_id']");
                const studentId = studentIdInput.value;

                if (studentId.trim() === "") {
                    alert("Please enter a valid student ID.");
                    return;
                }

                const xhr = new XMLHttpRequest();
                const url = "add_student.php";
                const params = `add_student=1&student_id=${studentId}`;

                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            // Handle the success response
                            alert(xhr.responseText);
                        } else {
                            // Handle the error response
                            alert("An error occurred while processing your request.");
                        }
                    }
                };

                xhr.send(params);
            });
            // Function to update the progress bar
            function updateProgressBar(progressBar, percentage) {
                progressBar.style.width = percentage + "%";
                progressBar.textContent = percentage + "%";
                progressBar.classList.remove("bg-danger");
                progressBar.classList.add("bg-success");
            }

            // Function to send an AJAX request to update progress in the database
            function updateProgressInDatabase(studentId, percentage) {
                const xhr = new XMLHttpRequest();
                const url = "update_progress.php"; // Create a PHP script to handle the update
                const params = `student_id=${studentId}&percentage=${percentage}`;

                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Handle the response from the PHP script (if needed)
                        console.log(xhr.responseText);
                    }
                };

                xhr.send(params);
            }
        });
    </script>


    <?php
    include('scripts.php');
    ?>

</body>

</html>