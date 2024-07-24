<?php
session_start();

// Check if user is logged in, redirect to login if not
if (!isset($_SESSION['user_id'])) {
  header("Location: ../authentication/login.php"); // Replace with your login page path
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="dashboard d-flex justify-content-between">
        <div class="sidebar bg-dark vh-100">
            <h1 class="bg-primary p-4"><a href="../authentication/dashboard.php" class="text-light text-decoration-none">Dashboard</a></h1>
            <div class="menues p-4 mt-5">
                <div class="menu">
                    <a href="../home/home.php" class="text-light text-decoration-none"><strong>Home </strong></a>
                </div>
                <div class="menu mt-5">
                    <a href="research.php" class="text-light text-decoration-none"><strong>Research </strong></a>
                </div>
                <div class="menu mt-5">
                    <a href="../workshop/workshop.php" class="text-light text-decoration-none"><strong>Workshops</strong></a>
                </div>
                <div class="menu mt-5">
                    <a href="../teaching/teaching.php" class="text-light text-decoration-none"><strong>Teaching</strong></a>
                </div>

                <div class="menu mt-5">
                    <a href="../view/index.php" class="text-light text-decoration-none"><strong>View Website</strong></a>
                </div>
                <div class="menu mt-5">
                    <a href="../authentication/logout.php" class="btn btn-info">Logout</a>
                </div>
                
            </div>
        </div>

<div class="research-details w-100 bg-light p-5">

  <?php
  // Get research project ID from URL parameter
  $id = $_GET["id"];

  if ($id) {
    // Include database connection
    include('../../connect.php');

    // Create SQL query to fetch research project details
    $sqlSelectProject = "SELECT * FROM research WHERE id = $id";
    $result = mysqli_query($conn, $sqlSelectProject);

    // Check if research project is found
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    
      // Check if project belongs to logged-in user (assuming a 'user_id' field in the table)
      if ( !$_SESSION['user_id']) {
        echo "Unauthorized access! You cannot view details of this research project.";
        exit;
      }

      // Display research project details
      echo '<h1>' . $row['title'] . '</h1>';
      echo '<p><b>Sanctioned By:</b> ' . $row['sanctioned_by'] . '</p>';
      echo '<p><b>Total Amount:</b> ₹' . number_format($row['total_amount']) . '</p>';
      echo '<p><b>Status:</b> ' . $row['status'] . '</p>';
      echo '<p><b>Type:</b> ' . $row['type'] . '</p>';
    } else {
      echo "Research project not found!";
    }

    // Close database connection
    mysqli_close($conn);
  } else {
    echo "Invalid research project ID.";
  }
  ?>

</div>

</div>
</body>
</html>