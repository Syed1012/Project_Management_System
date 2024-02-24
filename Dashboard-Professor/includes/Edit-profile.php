<?php
include('../../dbcon.php');
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php");
    exit();
}

$reg_id = $_SESSION['reg_id'];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['reg_id'])) {
    $reg_id = $_SESSION['reg_id'];

    $check_query = "SELECT COUNT(*) FROM users WHERE reg_id=?";
    $stmt = mysqli_prepare($con, $check_query);
    mysqli_stmt_bind_param($stmt, "s", $reg_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($user_count > 0) {
        $fetch_query = "SELECT user_name, first_name, last_name, email, phone_number FROM users WHERE reg_id=?";
        $stmt = mysqli_prepare($con, $fetch_query);
        mysqli_stmt_bind_param($stmt, "s", $reg_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $user_name, $first_name, $last_name, $email, $phone_number);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    } else {
        $user_name = "";
        $first_name = "";
        $last_name = "";
        $email = "";
        $phone_number = "";
    }
} else {
    header("Location: error.php");
    exit();
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Project Management - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>


    <style>
        body {
            margin-top: 20px;
            background-color: #f2f6fc;
            color: #69707a;
        }

        .card {
            box-shadow: 3px 3px 3px #cbced1, -3px -3px 3px #d3d8de;
        }

        .card .card-header {
            font-weight: 500;
        }

        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0;
        }

        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
            font-size: larger;
        }

        .form-control,
        .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .nav-borders .nav-link.active {
            color: #0061f2;
            border-bottom-color: #0061f2;
        }

        .nav-borders .nav-link {
            color: #69707a;
            border-bottom-width: 0.125rem;
            border-bottom-style: solid;
            border-bottom-color: transparent;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0;
            padding-right: 0;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        /* Update button colors */
        .btn-primar {
            background-color: brown;
            color: white;
            font-weight: bold;
            margin-left: 350px;
        }



        /* Update button shadow */
        .bt {
            box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
            border-radius: 7px;
        }

        .btn-primarys {
            background-color: brown;
            color: white;
            font-weight: bold;
        }

        .btns {
            box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
            border-radius: 7px;
        }
    </style>

    <?php include('header.php'); ?>

    <div class="container-xl px-4 mt-4">
        <hr class="mt-0 mb-4">
        <div class="row justify-content-center">
            <!-- Account details card-->
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form method="POST" action="update_profile.php">
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                <input class="form-control" id="inputUsername" name="inputUsername" type="text" placeholder="Enter your username" value="<?php echo htmlspecialchars($user_name); ?>">
                            </div>

                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">First name</label>
                                    <input class="form-control" id="inputFirstName" name="inputFirstName" type="text" placeholder="Enter your first name" value="<?php echo htmlspecialchars($first_name); ?>">
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Last name</label>
                                    <input class="form-control" id="inputLastName" name="inputLastName" type="text" placeholder="Enter your last name" value="<?php echo htmlspecialchars($last_name); ?>">
                                </div>
                            </div>


                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">

                                <!-- Form Group (Email ID)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmail">Email Address</label>
                                    <input class="form-control" id="inputEmail" name="inputEmail" type="text" placeholder="Enter your Email" value="<?php echo htmlspecialchars($email); ?>">
                                </div>
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" id="inputPhone" name="inputPhone" type="tel" placeholder="Enter your phone number" value="<?php echo htmlspecialchars($phone_number); ?>">
                                </div>
                            </div>
                            <button class="bt btn-primar mt-4" type="submit" name="update_profile">Save changes</button>
                            <br>
                        </form>
                        <!-- Change Password Form -->
                        <h4>Change Password</h4>
                        <form method="POST" action="change_password.php">
                            <!-- Recent Password -->
                            <div class="form-group">
                                <label for="RecentPassword">Recent Password</label>
                                <input class="form-control" name="recent_password" type="password" placeholder="Enter your Old Password">
                            </div>
                            <br>

                            <!-- New Password -->
                            <div class="form-group">
                                <label for="NewPassword">New Password</label>
                                <input class="form-control" name="new_password" type="password" placeholder="Enter your New Password">
                            </div>
                            <br>

                            <!-- Re-Enter New Password -->
                            <div class="form-group">
                                <label for="ReEnterNewPassword">Re-Enter New Password</label>
                                <input class="form-control" name="reenter_new_password" type="password" placeholder="Re-Enter New Password">
                            </div>
                            <br>

                            <button class="btns btn-primarys" type="submit" name="change_password">Change Password</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php include('scripts.php'); ?>