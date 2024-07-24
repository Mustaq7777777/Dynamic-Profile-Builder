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
    <?php
    // Get research project ID from URL parameter
    $id = $_GET['id'];

    // Session Start
    session_start();

    if ($id && isset($_SESSION['user_id'])) {
      // Include database connection
      include('../../connect.php');

      // Create SQL query to fetch research project details (optional optimization)
      $sqlCheckProject = "SELECT * FROM home WHERE id = $id AND user_id = " . $_SESSION['user_id'];
      $result = mysqli_query($conn, $sqlCheckProject);
      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $facultyName = $row['faculty_name'];
        $facultyBio = $row['faculty_bio'];
        $facultyResume = $row['faculty_resume'];  
        ?>

    <div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
      <h2>Edit Faculty Information</h2>

      <form action="hprocess.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="faculty_id" value="<?php echo $facultyId; ?>">
        <div class="form-field mb-4">
          <label for="faculty_name">Faculty Name:</label>
          <input type="text" class="form-control" name="faculty_name" id="faculty_name" value="<?php echo $facultyName; ?>" required>
        </div>
        <div class="form-field mb-4">
          <label for="faculty_image">Faculty Image:</label>
          <?php
                    // Check if there's a faculty image stored
                if (!empty($row['faculty_image'])) {
                      // Replace with the path to your image display logic (assuming base64 encoded data)
                      echo '<img src="data:image/jpg;base64,' . base64_encode($row['faculty_image']) . '" alt="Faculty Image" class="img-thumbnail mb-3">';
                    }
                  ?>
          <input type="file" class="form-control" name="faculty_image" id="faculty_image">
         
        </div>
        <div class="form-field mb-4">
          <label for="faculty_bio">Faculty Bio:</label>
          <textarea class="form-control" name="faculty_bio" id="faculty_bio" rows="5" required><?php echo $facultyBio; ?></textarea>
        </div>
        <div class="form-field mb-4">
          <label for="faculty_resume">Faculty Resume (Google Drive Link):</label>
          <input type="url" class="form-control" name="faculty_resume" id="faculty_resume" value="<?php echo $facultyResume; ?>" placeholder="Paste Google Drive Link Here">
        </div>
        <div class="form-field">
      <input type="submit" class="btn btn-primary" value="Update" name="update">
    </div>
      </form>

    </div>
            <?php
          } else {
            echo "Faculty information not found or unauthorized access.";
          }
          // Close database connection
          mysqli_close($conn);
        } else {
          echo "You are not logged in! Please login to edit your information.";
        }
      ?>

    </div>

  </div>
</body>
</html>

                
