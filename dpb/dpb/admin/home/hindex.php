
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
        // Check for successful creation, update, or deletion messages from session variables
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

<h2>Faculty Information</h2>

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

  // Fetch faculty information for the logged-in user (replace 'faculty' with your table name if different)
  $sqlSelect = "SELECT * FROM home WHERE user_id = $logged_in_user_id";
  $result = mysqli_query($conn, $sqlSelect);

  // Check if data is fetched successfully
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $facultyName = $row['faculty_name'];
      $facultyBio = $row['faculty_bio'];
      $facultyResume = $row['faculty_resume']; // Assuming faculty resume URL is stored

      ?>

      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title"><?php echo $facultyName; ?></h5>
          <?php
                    // Check if there's a faculty image stored
                    if (!empty($row['faculty_image'])) {
                      // Replace with the path to your image display logic (assuming base64 encoded data)
                      echo '<img src="data:image/jpg;base64,' . base64_encode($row['faculty_image']) . '" alt="Faculty Image" class="img-thumbnail mb-3">';
                    }
            ?>
          <p class="card-text"><?php echo $facultyBio; ?></p>
          <p><a href="<?php echo $facultyResume; ?>" target="_blank">Faculty Resume</a></p>
        </div>
        <div class="card-footer">
          <a class="btn btn-info" href="view_home.php?id=<?php echo $row['id']; ?>">View</a>
          <a class="btn btn-warning" href="edit_home.php?id=<?php echo $row['id']; ?>">Edit</a>
          <a class="btn btn-danger" href="delete_home.php?id=<?php echo $row['id']; ?>">Delete</a>
        </div>
      </div>

      <?php
    }
  } else {
          echo '<div class="alert alert-info">No faculty information found for this user.</div>';
        }

        // Close database connection
        mysqli_close($conn);
      ?>

    </div>

  </div>
</body>
</html>
