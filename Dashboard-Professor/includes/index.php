<?php
session_start();
// Check if the user is authenticated as an professor
if (!isset($_SESSION['reg_id']) || $_SESSION['role'] !== 'professor') {
  // Redirect to the login page or another appropriate page
  header("Location: ../../login.php");
  exit();
}
?>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Dashboard - Professor</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="../css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    .projectlist {
      margin-top: 40px;
    }

    .table,
    .groupid {
      margin-top: 30px;
    }
  </style>
</head>

<?php include('header.php');
?>

<div class="container-fluid px-4 mt-5">
  <h1 class="mt-4">Overview</h1>

  <h4 class="projectlist">All Project's</h4>

  <table class="table">
    <?php 

    ?>
    <h5 class="groupid">Group ID - </h5>
    <h5 class="groupid">Project Name - </h5>
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Student's Name</th>
        <th scope="col">Email</th>
        <th scope="col">Progress </th>
      </tr>
    </thead>
    <tbody class="table-danger">
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
      </tr>
    </tbody>
  </table>

</div>

<?php


include('footer.php');
include('scripts.php');

?>