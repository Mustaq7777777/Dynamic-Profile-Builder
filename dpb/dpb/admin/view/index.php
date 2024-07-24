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
  <title>Faculty</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    
    .faculty-header p {
      font-size: 1.1rem; /* Adjust font size as desired */
      line-height: 1.5; /* Adjust line spacing for better readability */
      margin-bottom: 1.5rem; /* Add some space between bio and other elements */
      padding: 40px 5px 5px 5px;
    }
    .faculty-header img{
      margin-top: 1.5rem;
    }
   

  </style>
</head>
<body>
  <div class="dashboard bg-dark d-flex justify-content-between">
    <div class="sidebar  vh-100">
      <div class="menues p-4 mt-5">
        <div class="menu">
          <a href="index.php" class="text-light text-decoration-none"><strong>Home </strong></a>
        </div>
        <div class="menu mt-5">
          <a href="resindex.php" class="text-light text-decoration-none"><strong>Research </strong></a>
        </div>
        <div class="menu mt-5">
          <a href="worindex.php" class="text-light text-decoration-none"><strong>Workshops</strong></a>
        </div>
        <div class="menu mt-5">
          <a href="teaindex.php" class="text-light text-decoration-none"><strong>Teaching</strong></a>
        </div>
      </div>
    </div>

    <div class="content w-100 p-4">
      <?php
         if ( isset($_SESSION['user_id'])) {
          // Include database connection
          include('../../connect.php');
    
          // Create SQL query to fetch research project details (optional optimization)
          $sqlSelectProject = "SELECT * FROM home WHERE  user_id = " . $_SESSION['user_id'];
        $result = mysqli_query($conn, $sqlSelectProject);


        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);

          // Display faculty details in a header section
          echo '<div class="faculty-header bg-light p-4 mb-4">
          <header class="p-4 bg-dark text-center">
          <h1><a href="resindex.php" class="text-light text-decoration-none">'.$row['faculty_name'].'</a></h1>
        </header>';
         // Check if there's a faculty image stored
         if (!empty($row['faculty_image'])) {
          // Replace with the path to your image display logic (assuming base64 encoded data)
          echo '<img src="data:image/jpg;base64,' . base64_encode($row['faculty_image']) . '" alt="Faculty Image" class="img-thumbnail mb-3 mx-auto d-block"  style="width: 350px; height: 350px;">';
        }
          echo    '<p>'.$row['faculty_bio'].'</p>';
         
          if (!empty($row['faculty_resume'])) {
            echo '<a href="'.$row['faculty_resume'].'" target="_blank" class="btn btn-primary mt-2">View Resume</a>';
          }
          echo '</div>';
        } else {
          echo '<div class="alert alert-warning">No faculty information found.</div>';
        }
        
    // Close database connection
    mysqli_close($conn);
  } else {
    echo "Invalid Faculty ID.";
  }
  ?>

  </div>
</body>
</html>

