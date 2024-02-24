<?php
include('../../dbcon.php'); // Include your database connection code
$reg_id = $_SESSION['reg_id'];
?>


<style>
    /* Sidebar styles */
    #layoutSidenav_nav {
        background-color: brown;
        /* Background color */
        box-shadow: 3px 3px 3px #821b1b, -3px -3px 3px #fff;
    }

    .sb-sidenav {
        background-color: #701515;
    }

    .sb-sidenav-menu-heading {
        color: white;
        /* Heading text color */
    }

    .sb-sidenav .nav-link {
        color: white;
        /* Link text color */
    }

    .sb-sidenav-foote {
        background-color: #701515;
    }

    .sb-loged {
        padding: 10px;
        font-size: large;
        font-weight: bold;
        color: white;
    }

    .sb-user {
        padding: 15px;
        font-size: large;
        font-weight: bold;
        color: white;
    }

    .sb-sidenav-menu-heading:nth-child(1),
    .sb-sidenav-menu-heading:nth-child(4) {
        color: white;
    }
</style>



<div id="layoutSidenav_nav">
    <nav class="sb-sidenav" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav" style="padding-top: 10px; font-size: larger;">

                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Navigate</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Professors
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Project's-Progress</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Review's</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Students
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="Attendance.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Attendance
                        </a>

                        <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Project Progress
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">Project Assigned</a>
                                <a class="nav-link" href="404.html">Project Review 1</a>
                                <a class="nav-link" href="500.html">Project Review 2</a>
                            </nav>
                        </div> -->
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Managing part</div>
                <a class="nav-link" href="ProjectManagement.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Manage Projects
                </a>
                <a class="nav-link" href="Groups.php">
                    <div class="sb-nav-link-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                    Groups
                </a>
            </div>
        </div>

        <div class="sb-sidenav-foote">
            <div class="sb-loged"> <i class="fa fa-sign-in" aria-hidden="true"></i> Logged in as:</div>
            <div class="sb-user"> <i class="fa fa-user" aria-hidden="true"></i>
                <?php
                // Check if $user_name is set before displaying it
                if (isset($user_name)) {
                    echo htmlspecialchars($user_name);
                } else {
                    // If $user_name is not set, fetch it from the database using the logged-in user's reg_id

                    // Fetch the user_name from the users table
                    $fetch_username_query = "SELECT user_name FROM users WHERE reg_id=?";
                    $stmt = mysqli_prepare($con, $fetch_username_query);
                    mysqli_stmt_bind_param($stmt, "s", $reg_id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $user_name);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_close($stmt);

                    mysqli_close($con);

                    // Display the fetched user_name or a default value if not found
                    echo htmlspecialchars($user_name ? $user_name : "Unknown");
                }
                ?>
            </div>
        </div>
    </nav>
</div>