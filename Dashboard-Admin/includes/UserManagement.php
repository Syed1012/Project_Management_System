<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page
    exit();
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
    <title>UserManagement - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
    </style>
</head>

<body>

    <?php
    include('header.php');
    include('../../dbcon.php');

    $sql = "SELECT reg_id, role, record_status FROM users";
    $result = mysqli_query($con, $sql);
    ?>

    <div class="container mt-5 table-container">
        <h1>User Management</h1>

        <br>
        <!-- Students Table -->
        <h2>Students</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    
                    <th>Role</th>
                    <th>Status</th>
                    <th>Edit Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['role'] == 'student') {
                            echo "<tr>";
                            echo "<td>" . $row['reg_id'] . "</td>";
                            echo "<td>" . $row['role'] . "</td>";
                            echo "<td>";
                            if ($row['record_status'] == 1) {
                                echo "Active";
                            } else {
                                echo "Blocked";
                            }
                            echo "</td>";
                            echo '<td>
                                    <form method="POST" action="Update_status.php">
                                        <input type="hidden" name="user_id" value="' . $row['reg_id'] . '">
                                        <select name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Blocked</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </form>
                                  </td>';
                            echo '<td>
                                    <form method="POST" action="Remove_user.php">
                                        <input type="hidden" name="user_id" value="' . $row['reg_id'] . '">
                                        <button type="submit" class="btn btn-danger btn-sm">Remove User</button>
                                    </form>
                                  </td>';
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='4'>No students found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <br>
        
        <!-- Professors Table -->
        <h2>Professors</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Edit Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Reset the result pointer to fetch data again
                mysqli_data_seek($result, 0);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['role'] == 'professor') {
                            echo "<tr>";
                            echo "<td>" . $row['reg_id'] . "</td>";
                            echo "<td>" . $row['role'] . "</td>";
                            echo "<td>";
                            if ($row['record_status'] == 1) {
                                echo "Active";
                            } else {
                                echo "Blocked";
                            }
                            echo "</td>";
                            echo '<td>
                                    <form method="POST" action="Update_status.php">
                                        <input type="hidden" name="user_id" value="' . $row['reg_id'] . '">
                                        <select name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Blocked</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </form>
                                  </td>';
                            echo '<td>
                                    <form method="POST" action="Remove_user.php">
                                        <input type="hidden" name="user_id" value="' . $row['reg_id'] . '">
                                        <button type="submit" class="btn btn-danger btn-sm">Remove User</button>
                                    </form>
                                  </td>';
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='4'>No professors found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <br>

        <!-- Admins Table -->
        <h2>Admins</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Edit Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Reset the result pointer to fetch data again
                mysqli_data_seek($result, 0);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['role'] == 'admin') {
                            echo "<tr>";
                            echo "<td>" . $row['reg_id'] . "</td>";
                            echo "<td>" . $row['role'] . "</td>";
                            echo "<td>";
                            if ($row['record_status'] == 1) {
                                echo "Active";
                            } else {
                                echo "Blocked";
                            }
                            echo "</td>";
                            echo '<td>
                                    <form method="POST" action="Update_status.php">
                                        <input type="hidden" name="user_id" value="' . $row['reg_id'] . '">
                                        <select name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Blocked</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </form>
                                  </td>';
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='4'>No admins found.</td></tr>";
                }

                mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>

    <?php
    include('footer.php');
    include('scripts.php');
    ?>

</body>

</html>
