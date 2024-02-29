<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page
    exit();
}

// Include your database connection code here
include('../../dbcon.php');

// Query to fetch student details from users table
$sql = "SELECT user_name, reg_id, phone_number, email FROM users WHERE role = 'student'";
$result = mysqli_query($con, $sql);

mysqli_close($con);
?>


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Attendance - Professor</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="attendance.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        .container {
            text-align: center;
        }

        table,
        td,
        th {
            border: 1px solid #ddd;
            text-align: left;

        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: auto;
            margin-top: 50px;
            text-align: center;
        }

        th,
        td {
            padding: 15px;
            text-align: center;
        }

        tr>th {
            background-color: teal;
            color: white;
        }

        .studentData {
            width: 100%;
            background-color: green;
            padding: 15px;

        }

        #form1 {
            margin: auto;
            width: 80%;

        }

        #form1 input {
            padding: 10px;
            margin-right: 15px;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 5px;
        }

        #form1 input:focus {
            outline: none;
        }

        .td6 {
            display: flex;
            align-items: center;
            justify-content: center;


        }

        .td6>button {
            margin-right: 10px;
            color: white;
            border-radius: 5px;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .td6>button:nth-child(1) {
            background-color: green;
        }

        .td6>button:nth-child(2) {
            background-color: red;
        }

        #absent {
            background-color: red;
        }

        thead th {
            background-color: brown;
        }

        .submit-btn {
            margin-top: 20px;
            margin-bottom: 20px;
            background-color: brown;
            color: black;
            border-radius: 10px;
        }

        .submit-btn:hover{
            box-shadow: 10px 10px 0px brown;
            top: -5px;
            left: -5px;
            transition: 0.3s ease;
        }
    </style>

</head>

<?php
include('header.php');
?>

<div class="container">

    <table class="tab" style="width: 90%;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Reg ID</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Attendance</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['reg_id'] . "</td>";
                echo "<td>" . $row['phone_number'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td class='td6'>";
                echo "<button class='present-btn'>Present</button>";
                echo "<button class='absent-btn'>Absent</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>

    </table>
    <button class="submit-btn">Publish Attendance</button>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all the buttons with class present-btn
        var presentButtons = document.querySelectorAll(".present-btn");

        // Loop through each present button
        presentButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                // Find the sibling absent button and change its style
                var absentButton = this.nextElementSibling;
                absentButton.style.backgroundColor = "grey";
                absentButton.disabled = false; // Enable the absent button
                this.style.backgroundColor = ""; // Reset present button style
            });
        });

        // Get all the buttons with class absent-btn
        var absentButtons = document.querySelectorAll(".absent-btn");

        // Loop through each absent button
        absentButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                // Find the sibling present button and change its style
                var presentButton = this.previousElementSibling;
                presentButton.style.backgroundColor = "grey";
                presentButton.disabled = false; // Enable the present button
                this.style.backgroundColor = ""; // Reset absent button style
            });
        });
    });
</script>


<?php
include('scripts.php');
?>