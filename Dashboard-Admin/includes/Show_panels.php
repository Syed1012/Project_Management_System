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
    <title>ProjectManagement - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="#" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<?php
include('header.php');
?>

<style>
    .table{
        margin-top: 60px;
        margin-left: 10px;
        text-align: center;
        border: red;
        background-color:beige;
        
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
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>



<?php
include('scripts.php');
?>

</html>