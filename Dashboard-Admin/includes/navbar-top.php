<nav class="sb-topnav navbar navbar-expand navbar-dark">
    <div class="container-fluid"> <!-- Wrap the content in a container -->

        <!-- Sidebar Toggle (on the left) with increased size -->
        <button class="btn btn-link btn-lg order-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars fa-1x text-white"></i>
        </button>

        <!-- Navbar Brand (centered) -->
        <a class="navbar-brand mx-auto text-white" href="index.php">GITAM PMS</a>

        <!-- Notification Icon -->
        <button class="btn btn-link btn-lg order-0 me-4 me-lg-0 mt-1 mr-2" id="notificationIcon" href="#!">
            <i class="fas fa-bell fa-1x text-white"></i>
            <!-- You can customize the icon class and appearance as needed -->
        </button>

        <!-- Navbar (on the right) -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw text-white"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" style="padding: 0px;" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="Edit-profile.php"><i class="fas fa-edit"></i>Edit-profile</a></li>
                    <li><a class="dropdown-item" href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                    <!-- <li><a class="dropdown-item" href="#!"><i class="fas fa-history"></i> Activity Log</a></li> -->
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<!-- Additional HTML for the Notification Dropdown -->
<div class="notification-dropdown mt-4" id="notificationDropdown">
    <div class="notification-header">
        <strong>Notifications</strong>
    </div>
    <hr class="dropdown-divider" />
    <!-- Add your notifications here -->
    <div class="notification-item">Your Notification Text</div>
</div>


<style>
    /* Increase the height of the navbar */
    .navbar {
        height: 80px;
        background-color: brown;
    }

    /* Change the font size and style of "GITAM PMS" */
    .navbar-brand {
        font-size: 40px;
        font-weight: bolder;
    }

    .dropdown-item {
        font-size: large;
    }

    /* Center the dropdown items horizontally */
    .dropdown-menu {
        text-align: center;
        max-height: 200px;
        overflow-y: auto;
    }

    /* Style the dropdown items */
    .dropdown-item {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
    }

    /* Style the icons */
    .dropdown-item i {
        margin-right: 10px;
    }

    /* Style the divider */
    .dropdown-divider {
        border-top: 2px solid #ccc;
        margin: 5px 0;
    }

    /* Ensure the dropdown stays within the window boundaries */
    .dropdown-menu-end {
        right: 0;
        left: auto;
    }

    /* Add a 3D effect */
    .navbar {
        position: relative;
        box-shadow: 3px 3px 3px #6b0101, -3px -3px 3px #fff;
    }

    /* Additional styles for the notification dropdown */
    .notification-dropdown {
        position: absolute;
        top: 60px;
        /* Adjust the distance from the top as needed */
        right: 20px;
        /* Adjust the distance from the right as needed */
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: none;
        min-width: 300px;
    }

    .notification-header {
        padding: 10px;
        background-color: #f8f9fa;
        font-weight: bold;
        border-top-left-radius: 10px; /* Adjust the border-radius as needed */
        border-top-right-radius: 10px; /* Adjust the border-radius as needed */
    }

    .notification-item {
        padding: 10px;
        cursor: pointer;
    }

    /* Show the notification dropdown when the button is clicked */
    #notificationDropdown.show {
        display: block;
    }

    /* Media query for smaller screens (adjust the max-width as needed) */
    @media (max-width: 768px) {
        .navbar {
            height: auto;
        }
    }
</style>


<script>
    // JavaScript to toggle the notification dropdown
    document.getElementById('notificationIcon').addEventListener('click', function (event) {
        var dropdown = document.getElementById('notificationDropdown');
        dropdown.classList.toggle('show');
        event.stopPropagation(); // Prevent the event from reaching the window.onclick
    });

    // Close the dropdown if the user clicks outside of it
    window.onclick = function (event) {
        var dropdown = document.getElementById('notificationDropdown');
        if (dropdown.classList.contains('show') && !event.target.matches('#notificationIcon')) {
            dropdown.classList.remove('show');
        }
    };
</script>
