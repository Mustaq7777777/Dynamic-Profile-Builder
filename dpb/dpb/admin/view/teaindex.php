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
  <title>Courses</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    .course-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 50px;
    }
    .course-table th, .course-table td {
      border: 1px solid #ddd;
      padding: 10px;
    }
    .course-table th {
      text-align: left;
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <header class="p-4 bg-dark text-center">
    <h1><a href="teaindex.php" class="text-light text-decoration-none">Courses</a></h1>
  </header>
  <div class="dashboard d-flex justify-content-between">
    <div class="sidebar bg-dark vh-100">
      <div class="menues p-4 mt-5">
       
        <div class="menu">
          <a href="index.php<?php echo (isset($_GET["id"])) ? "?id=" . $_GET["id"] : ""; ?>" class="text-light text-decoration-none"><strong>Home</strong></a>
        </div>
        <div class="menu mt-5">
          <a href="resindex.php<?php echo (isset($_GET["id"])) ? "?id=" . $_GET["id"] : ""; ?>" class="text-light text-decoration-none"><strong>Research</strong></a>
        </div>
        <div class="menu mt-5">
          <a href="worindex.php<?php echo (isset($_GET["id"])) ? "?id=" . $_GET["id"] : ""; ?>" class="text-light text-decoration-none"><strong>Workshops</strong></a>
        </div>
        <div class="menu mt-5">
          <a href="teaindex.php<?php echo (isset($_GET["id"])) ? "?id=" . $_GET["id"] : ""; ?>" class="text-light text-decoration-none"><strong>Teaching</strong></a>
        </div>
        <div class="menu mt-5">
          <a href="../authentication/login.php" class="text-light text-decoration-none"><strong>Edit</strong></a>
         </div>
      </div>
    </div>


  <div class="container mt-5">
  <?php
  // Get research project ID from URL parameter
  
    if ( isset($_SESSION['user_id'])) {
      // Include database connection
      include('../../connect.php');

      // Create SQL query to fetch research project details (optional optimization)
      $sqlSelectProject = "SELECT * FROM teaching WHERE  user_id = " . $_SESSION['user_id'];
    $result = mysqli_query($conn, $sqlSelectProject);

      if (mysqli_num_rows($result) > 0) {
        echo "<table class='course-table'>
                <thead>
                  <tr>
                    <th>Course Title</th>
                    <th>Level</th>
                    <th>Year</th>
                  </tr>
                </thead>
                <tbody>";
        while ($data = mysqli_fetch_array($result)) {
          echo "<tr>
                  <td>" . $data["course_title"] . "</td>
                  <td>" . $data["course_level"] . "</td>
                  <td>" . $data["course_year"] . "</td>
                </tr>";
        }
        echo "</tbody>
              </table>";
      } else {
        if (isset($_GET["id"])) {
          echo "<p class='text-center'>No courses found for this instructor!</p>";
        } else {
          echo "<p class='text-center'>No courses found!</p>";
        }
      }

      mysqli_close($conn);
    } else {
        echo "Invalid Teaching  ID.";
      } // Close the connection (optional)
    ?>
  </div>

 
</body>
</html>
