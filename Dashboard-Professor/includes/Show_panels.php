<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
  header("Location: ../../login.php"); // Redirect to the login page
  exit();
}

include("../../dbcon.php");

// Fetch data from the panels_list table
$sql = "SELECT panel_id, professor_name, phone_number, professor_email FROM panels_list";
$result = mysqli_query($con, $sql);

// // Fetch data from the panels_list table
// $sql = "SELECT DISTINCT panel_id FROM panels_list";
// $result = mysqli_query($con, $sql);
?>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>ShowPanels - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="#" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<?php
include('header.php');
?>

<style>
  .table {
    margin-top: 60px;
    margin-left: 10px;
    text-align: center;
    border: black;
    background-color: beige;
  }

  .series,
  .panelid,
  .facultynames,
  .phonenums,
  .facultyemails,
  .timings,
  .room,
  .addgroup {
    list-style-type: none;
    margin: 0;
    padding: 0;
    vertical-align: middle;
  }
</style>


<table class="table table-hover table-bordered">
  <!-- table-bordered -->
  <thead>
    <tr>
      <th scope="col1">#</th>
      <th scope="col2">Panel ID</th>
      <th scope="col3">Names of Faculty</th>
      <th scope="col4">Contact No.</th>
      <th scope="col5">Email ID.</th>
      <th scope="col6">Schedule</th>
      <th scope="col7">Room No.</th>
      <th scope="col7">Groups ID's</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $count = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td scope='row'>" . $count . "</td>";
      echo "<td class='panelid'>" . $row['panel_id'] . "</td>";
      echo "<td class='facultynames'>" . $row['professor_name'] . "</td>";
      echo "<td class='phonenums'>" . $row['phone_number'] . "</td>";
      echo "<td class='facultyemails'>" . $row['professor_email'] . "</td>";
      echo "<td class='timings'>8:00 AM - 10:00 AM</td>";
      echo "<td class='room'>Room 101</td>";
      echo "<td class='addgroup'><i class='fas fa-plus'></i></td>";
      echo "</tr>";
      $count++;
    }
    ?>
  </tbody>

  <!-- <tbody>
    <?php
    $count = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td scope='row'>" . $count . "</td>";
      echo "<td class='panelid'>" . $row['panel_id'] . "</td>";
      
      // Fetch and display faculty names, phone numbers, and emails for this panel ID
      $panel_id = $row['panel_id'];
      $faculty_sql = "SELECT professor_name, phone_number, professor_email FROM panels_list WHERE panel_id='$panel_id'";
      $faculty_result = mysqli_query($conn, $faculty_sql);
      
      echo "<td class='facultynames'><ul>";
      while ($faculty_row = mysqli_fetch_assoc($faculty_result)) {
        echo "<li>" . $faculty_row['professor_name'] . "</li>";
      }
      echo "</ul></td>";
      
      echo "<td class='phonenums'><ul>";
      mysqli_data_seek($faculty_result, 0); // Reset result pointer to first row
      while ($faculty_row = mysqli_fetch_assoc($faculty_result)) {
        echo "<li>" . $faculty_row['phone_number'] . "</li>";
      }
      echo "</ul></td>";
      
      echo "<td class='facultyemails'><ul>";
      mysqli_data_seek($faculty_result, 0); // Reset result pointer to first row
      while ($faculty_row = mysqli_fetch_assoc($faculty_result)) {
        echo "<li>" . $faculty_row['professor_email'] . "</li>";
      }
      echo "</ul></td>";
      
      echo "<td class='timings'>8:00 AM - 10:00 AM</td>"; // Dummy schedule
      echo "<td class='room'>Room 101</td>"; // Dummy room
      echo "<td class='addgroup'><i class='fas fa-plus'></i></td>"; // Dummy groups IDs
      echo "</tr>";
      $count++;
    }
    ?>
  </tbody> -->
</table>



<?php
include('scripts.php');
?>