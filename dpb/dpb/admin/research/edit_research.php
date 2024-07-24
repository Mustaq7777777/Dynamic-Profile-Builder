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

    <?php
    // Get research project ID from URL parameter
    $id = $_GET['id'];

    // Session Start
    session_start();

    if ($id && isset($_SESSION['user_id'])) {
      // Include database connection
      include('../../connect.php');

      // Create SQL query to fetch research project details (optional optimization)
      $sqlCheckProject = "SELECT * FROM research WHERE id = $id AND user_id = " . $_SESSION['user_id'];
      $result = mysqli_query($conn, $sqlCheckProject);

      if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        ?>

        <div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
          <form action="rprocess.php" method="post">
            <div class="form-field mb-4">
              <input type="text" class="form-control" name="title" id="" placeholder="Enter Title:" value="<?php echo $data['title']; ?>">
            </div>
            <div class="form-field mb-4">
              <input type="text" class="form-control" name="sanctioned_by" id="" placeholder="Sanctioned By:" value="<?php echo $data['sanctioned_by']; ?>">
            </div>
            <div class="form-field mb-4">
              <input type="number" class="form-control" name="total_amount" id="" placeholder="Total Amount:" value="<?php echo $data['total_amount']; ?>">
            </div>
            <div class="form-field mb-4">
              <input type="text" class="form-control" name="status" id="" placeholder="Status:" value="<?php echo $data['status']; ?>">
            </div>
            <div class="form-field mb-4">
              <input type="text" class="form-control" name="type" id="" placeholder="Type:" value="<?php echo $data['type']; ?>">
            </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-field">
              <input type="submit" class="btn btn-primary" value="Update" name="update">
            </div>

          </form>
        </div>

        <?php
      } else {
        echo "You are not authorized to edit this research project.";
      }

      mysqli_close($conn);
    } else {
      echo "Invalid research project ID or unauthorized access.";
    }
    ?>

  </div>
</body>
</html>
