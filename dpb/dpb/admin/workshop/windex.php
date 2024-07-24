
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
                <a href="home.php" class="text-light text-decoration-none"><strong>Home </strong></a>
              </div>
              <div class="menu mt-5">
               <a href="../research/research.php" class="text-light text-decoration-none"><strong>Research </strong></a>
              </div>
                <div class="menu mt-5">
                    <a href="workshop.php" class="text-light text-decoration-none"><strong>Workshops</strong></a>
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

<div class="posts-list w-100 p-5">

<?php
// Check for success messages (unchanged)
if (isset($_SESSION["create"])) {
  echo '<div class="alert alert-success">' . $_SESSION["create"] . '</div>';
  unset($_SESSION["create"]);
} elseif (isset($_SESSION["update"])) {
  echo '<div class="alert alert-success">' . $_SESSION["update"] . '</div>';
  unset($_SESSION["update"]);
} elseif (isset($_SESSION["delete"])) {
  echo '<div class="alert alert-success">' . $_SESSION["delete"] . '</div>';
  unset($_SESSION["delete"]);
}
?>

<table class="table table-bordered">
  <thead>
  <tr>
    <th style="width:30%;">Workshop Name</th>
    <th style="width:20%;">Place</th>
    <th style="width:15%;">Duration</th>
    <th style="width:15%;">Date</th>
    <th style="width:15%;">Details</th>
    <th style="width:20%;">Action</th>
  </tr>
  </thead>
  <tbody>

      <?php
      // Include database connection
      include('../../connect.php');

      // Check if user is logged in, redirect to login if not
      session_start();
      if (!isset($_SESSION['user_id'])) {
        header("Location: ../authentication/login.php"); // Replace with your login page path
        exit;
      }
 
      $logged_in_user_id = $_SESSION['user_id'];
 
      // Fetch research projects from the database for the logged-in user
      $sqlSelect = "SELECT * FROM workshop WHERE user_id = $logged_in_user_id";
      $result = mysqli_query($conn, $sqlSelect);
 
      // Check if data is fetched successfully
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          ?>

                <tr>
                    <td><?php echo $row['w_name']; ?></td>
                    <td><?php echo $row['w_place']; ?></td>
                    <td><?php echo $row['w_duration']; ?></td>
                    <td><?php echo $row['w_date']; ?></td>
                    <td><?php echo $row['w_details']; ?></td>
                <td>
                    <a class="btn btn-info" href="view_workshop.php?id=<?php echo $row['id']; ?>">View</a>
                    <a class="btn btn-warning" href="edit_workshop.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a class="btn btn-danger" href="delete_workshop.php?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>


          <?php
        }
      } else {
        echo '<tr><td colspan="4">No workshops found in the database.</td></tr>';
      }

      // Close database connection
      mysqli_close($conn);
      ?>

  </tbody>
</table>
</div>


</div>
</body>
</html>