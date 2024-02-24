<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page if not logged in
    exit();
}

// Include the database connection file
include('../../dbcon.php');

// Get the user's reg_id from the session
$reg_id = $_SESSION['reg_id'];

// Query to check if the user is in a group
$check_query = "SELECT * FROM student_groups WHERE student1_id = '$reg_id' OR student2_id = '$reg_id' OR student3_id = '$reg_id' OR student4_id = '$reg_id'";
$check_result = mysqli_query($con, $check_query);
$user_in_group = mysqli_num_rows($check_result) > 0;

// Check if the user has created the group
$created_group_query = "SELECT * FROM student_groups WHERE created_by = '$reg_id'";
$created_group_result = mysqli_query($con, $created_group_query);
$user_created_group = mysqli_num_rows($created_group_result) > 0;
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Show Group</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>


    <style>
        /* Add your custom styles here */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ecf0f3;
            border-radius: 15px;
            box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
        }

        .table {
            width: 100%;
            background-color: #ecf0f3;
            border-collapse: collapse;
            border-radius: 15px;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
            background-color: #ecf0f3;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #555;
            color: black;
        }

        .btn {
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

        .btn:hover {
            background-color: black;
            color: white;
        }
    </style>
    
</head>

<?php include('header.php'); ?>

<div class="container mt-5">
    <?php if ($user_in_group) : ?>
        <!-- User is in a group, display the group information -->
        <h2>Your Group:</h2>

        <?php
        while ($row = mysqli_fetch_assoc($check_result)) {
            $group_id = $row['group_id'];
            $student1_name = $row['student1_name'];
            $student1_reg_id = $row['student1_id'];
            $student2_name = $row['student2_name'];
            $student2_reg_id = $row['student2_id'];
            $student3_name = $row['student3_name'];
            $student3_reg_id = $row['student3_id'];
            $student4_name = $row['student4_name'];
            $student4_reg_id = $row['student4_id'];
        }
        ?>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Group ID</th>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <?php if ($user_created_group) : ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>

                <!-- ---------------------------------- Table row 1 --------------------------------------- -->
                <tr>
                    <td><?php echo $group_id; ?></td>

                    <td>
                        <?php if (empty($student1_reg_id)) : ?>
                            <form method="POST" action="add_friend.php">
                                <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                                <input type="hidden" name="student_slot" value="student1">
                                <input type="text" name="new_student_name" placeholder="Enter Student Name"> <!-- Separate input for student name -->
                                <input type="text" name="new_student_id" placeholder="Enter Student ID">
                                <input type="submit" name="submit_button" value="Add Friend">
                            </form>
                        <?php else : ?>
                            <?php echo $student1_name; ?>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php echo $student1_reg_id; ?>
                    </td>

                    <?php if ($user_created_group) : ?>
                        <td>
                            <?php if (empty($student1_reg_id)) : ?>
                                <button type="button" class="btn btn-sm btn-success" onclick="addFriend(this, '<?php echo $group_id; ?>', 'student1')">Add Friend</button>
                            <?php else : ?>
                                <span class="text-muted">Slot filled</span>
                            <?php endif; ?>
                            <form method="POST" action="remove_student_group.php">
                                <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                                <input type="hidden" name="remove_student_id" value="<?php echo $student1_reg_id; ?>">
                                <button type="submit" class="btn btn-sm btn-danger mt-2" name="remove_user">Remove</button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>


                <!-- -------------------------------- Table row 2 --------------------------------------- -->
                <tr>
                    <td><?php echo $group_id; ?></td>

                    <td>
                        <?php if (empty($student2_reg_id)) : ?>
                            <form method="POST" action="add_friend.php">
                                <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                                <input type="hidden" name="student_slot" value="student2">
                                <input type="text" name="new_student_name" placeholder="Enter Student Name"> <!-- Separate input for student name -->
                                <input type="text" name="new_student_id" placeholder="Enter Student ID">
                                <input type="submit" name="submit_button" value="Add Friend">
                            </form>
                        <?php else : ?>
                            <?php echo $student2_name; ?>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php echo $student2_reg_id; ?>
                    </td>

                    <?php if ($user_created_group) : ?>
                        <td>
                            <?php if (empty($student2_reg_id)) : ?>
                                <button type="button" class="btn btn-sm btn-success" onclick="addFriend(this, '<?php echo $group_id; ?>', 'student2')">Add Friend</button>
                            <?php else : ?>
                                <span class="text-muted">Slot filled</span>
                            <?php endif; ?>
                            <form method="POST" action="remove_student_group.php">
                                <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                                <input type="hidden" name="remove_student_id" value="<?php echo $student2_reg_id; ?>">
                                <button type="submit" class="btn btn-sm btn-danger mt-2" name="remove_user">Remove</button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>


                <!-- -------------------------------- Table row 3 --------------------------------------- -->
                <tr>
                    <td><?php echo $group_id; ?></td>

                    <td>
                        <?php if (empty($student3_reg_id)) : ?>
                            <form method="POST" action="add_friend.php">
                                <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                                <input type="hidden" name="student_slot" value="student3">
                                <input type="text" name="new_student_name" placeholder="Enter Student Name"> <!-- Separate input for student name -->
                                <input type="text" name="new_student_id" placeholder="Enter Student ID">
                                <input type="submit" name="submit_button" value="Add Friend">
                            </form>
                        <?php else : ?>
                            <?php echo $student3_name; ?>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php echo $student3_reg_id; ?>
                    </td>

                    <?php if ($user_created_group) : ?>
                        <td>
                            <?php if (empty($student3_reg_id)) : ?>
                                <button type="button" class="btn btn-sm btn-success" onclick="addFriend(this, '<?php echo $group_id; ?>', 'student3')">Add Friend</button>
                            <?php else : ?>
                                <span class="text-muted">Slot filled</span>
                            <?php endif; ?>
                            <form method="POST" action="remove_student_group.php">
                                <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                                <input type="hidden" name="remove_student_id" value="<?php echo $student3_reg_id; ?>">
                                <button type="submit" class="btn btn-sm btn-danger mt-2" name="remove_user">Remove</button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>


                <!-- -------------------------------- Table row 4 --------------------------------------- -->
                <tr>
                    <td><?php echo $group_id; ?></td>

                    <td>
                        <?php if (empty($student4_reg_id)) : ?>
                            <form method="POST" action="add_friend.php">
                                <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                                <input type="hidden" name="student_slot" value="student4">
                                <input type="text" name="new_student_name" placeholder="Enter Student Name"> <!-- Separate input for student name -->
                                <input type="text" name="new_student_id" placeholder="Enter Student ID">
                                <input type="submit" name="submit_button" value="Add Friend">
                            </form>
                        <?php else : ?>
                            <?php echo $student4_name; ?>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php echo $student4_reg_id; ?>
                    </td>

                    <?php if ($user_created_group) : ?>
                        <td>
                            <?php if (empty($student4_reg_id)) : ?>
                                <button type="button" class="btn btn-sm btn-success" onclick="addFriend(this, '<?php echo $group_id; ?>', 'student4')">Add Friend</button>
                            <?php else : ?>
                                <span class="text-muted">Slot filled</span>
                            <?php endif; ?>
                            <form method="POST" action="remove_student_group.php">
                                <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                                <input type="hidden" name="remove_student_id" value="<?php echo $student4_reg_id; ?>">
                                <button type="submit" class="btn btn-sm btn-danger mt-2" name="remove_user">Remove</button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>


            </tbody>
        </table>


    <?php else : ?>
        <!-- User is not in a group, display a message -->
        <h2>You Are Not in a Group</h2>
        <p>Join or create a group to collaborate with other students on projects.</p>
    <?php endif; ?>
</div>
<?php include('scripts.php'); ?>