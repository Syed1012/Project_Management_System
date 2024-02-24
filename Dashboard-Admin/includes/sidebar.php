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
            <div class="nav" style="padding-top: 10px; font-size:larger;">

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
                        <a class="nav-link" href="Panels.php">Panels</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Students
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Project Progress
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">Project Assigned</a>
                                <a class="nav-link" href="404.html">Project Review 1</a>
                                <a class="nav-link" href="500.html">Project Review 2</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="Discussions.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-message"></i></div>
                    Discussions
                </a>
                <a class="nav-link" href="UserManagement.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    User-Management
                </a>
                <a class="nav-link" href="ProjectManagement.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Manage Projects
                </a>
            </div>
        </div>

        <div class="sb-sidenav-foote">
            <div class="sb-loged">Logged in as:</div>
            <div class="sb-user">
                Admin
            </div>
        </div>

    </nav>
</div>