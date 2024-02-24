<?php

// Start the session
session_start();

include('includes/header.php');
include('includes/navbar.php');
include('dbcon.php');

// Establish a connection to the database
$con = mysqli_connect($host, $reg_id, $password, $database);

// Logic for the login page verification.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form has been submitted
    // Retrieve user input from the form
    $reg_id = $_POST['reg_id'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Get the selected role

    // Create a prepared statement
    $stmt = mysqli_prepare($con, "SELECT * FROM users WHERE reg_id = ? AND password = ? AND role = ?");
    mysqli_stmt_bind_param($stmt, "sss", $reg_id, $password, $role);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Check if a matching user was found
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Check if the user's record_status is 1 (active)
        if ($user['record_status'] == 1) {
            // Store user information in session variables
            $_SESSION['reg_id'] = $user['reg_id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on the user's role
            switch ($user['role']) {
                case 'student':
                    header("Location: Dashboard-Student/includes/index.php");
                    exit();

                case 'professor':
                    header("Location: Dashboard-Professor/includes/index.php");
                    $_SESSION['reg_id'] = $reg_id;
                    exit();

                case 'admin':
                    header("Location: Dashboard-Admin/includes/index.php");
                    $_SESSION['reg_id'] = $reg_id;
                    exit();

                default:
                    // Handle unknown role or provide a default redirect
                    header("Location: default-dashboard/index.php");
                    exit();
            }
        } else {
            // User is blocked
            $_SESSION['message'] = "Your Account is On Hold.";
            header("Location: login.php?error=2");
            exit();
        }
    } else {
        // Login failed
        $_SESSION['message'] = "Login Credentials Incorrect";
        header("Location: login.php?error=1");
        exit();
    }
}

?>
<style>
    /* Importing fonts from Google */
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        background: #ecf0f3;
    }

    .wrapper {
        max-width: 400px;
        min-height: 500px;
        margin: 80px auto;
        padding: 40px 30px 30px 30px;
        background-color: #ecf0f3;
        border-radius: 15px;
        box-shadow: 3px 3px 3px #6b0101, -3px -3px 3px #fff;
    }

    .logo {
        width: 80px;
        margin: auto;
    }

    .logo img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0px 0px 3px brown, 0px 0px 0px 5px #ecf0f3,
            8px 8px 15px #a7aaa7, -8px -8px 15px #fff;
    }

    .wrapper .name {
        font-weight: 600;
        font-size: 1.4rem;
        letter-spacing: 1.3px;
        padding-left: 10px;
        color: #555;
    }

    .wrapper .form-field input {
        width: 100%;
        display: block;
        border: none;
        outline: none;
        background: none;
        font-size: 1.2rem;
        color: #666;
        padding: 10px 15px 10px 10px;
        /* border: 1px solid red; */
    }

    .wrapper .form-field {
        padding-left: 10px;
        margin-bottom: 20px;
        border-radius: 20px;
        box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
    }

    .wrapper .form-field .fas {
        color: #555;
    }

    .wrapper .btn {
        box-shadow: none;
        width: 100%;
        height: 40px;
        background-color: brown;
        color: black;
        font-weight: bolder;
        border-radius: 25px;
        box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
        letter-spacing: 1.3px;
    }

    .wrapper .btn:hover {
        background-color: black;
        color: white;
    }

    .wrapper a {
        padding-left: 15px;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: bolder;
        color: brown;
    }

    .wrapper a:hover {
        color: black;
    }

    .select-wrapper {
        position: relative;
    }

    .arrow-icon {
        position: absolute;
        top: 50%;
        right: 10px;
        /* Adjust the value as needed */
        transform: translateY(-50%);
    }


    @media (max-width: 380px) {
        .wrapper {
            margin: 30px 20px;
            padding: 40px 15px 15px 15px;
        }
    }
</style>


<div id="error-container" class="error-container">
    <p id="error-message" class="error-message"></p>
</div>


<div class="wrapper py-5">
    <div class="logo">
        <img src="assets/Images/GITAM-logo.jpg" alt="" />
    </div>

    <div class="text-center mt-4 name">GITAM PMS</div>
    <br>

    <!-- ----------------- Reg ID ---------------------- -->
    <form method="POST" action="">

        <form class="p-3 mt-3">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="reg-id" name="reg_id" placeholder="Enter Reg. ID" />
            </div>

            <!-- ----------------- password ---------------------- -->

            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" placeholder="Enter Password" />
            </div>

            <!-- ----------------- Role ---------------------- -->

            <div class="form-group mb-3">
                <label for="role" class="d-flex align-items-center">
                    Role
                </label>
                <div class="select-wrapper">
                    <select name="role" id="role" class="form-control">
                        <option value="student">Student</option>
                        <option value="professor">Professor</option>
                        <option value="admin">Admin</option>
                    </select>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up arrow-icon" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                </div>
            </div>

            <button class="btn mt-3">LOGIN</button>
        </form>
        <br>

        <div class="text-center fs-6">
            <a href="Forgot-ps.php">Forget password?</a>
        </div>
</div>
</form>

<?php
include('includes/footer.php');
?>