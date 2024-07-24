<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Workshops</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    .workshop-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 50px;
    }
    .workshop-table th, .workshop-table td {
      border: 1px solid #ddd;
      padding: 5px;
    }
    .workshop-table th {
      text-align: left;
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <header class="p-4 bg-dark text-center">
    <h1><a href="worindex.php" class="text-light text-decoration-none">Workshops</a></h1>
  </header>

  <div class="dashboard d-flex justify-content-between">
    <div class="sidebar bg-dark vh-100">
      <div class="menues p-4 mt-5">
        <?php
          // Check for user_id parameter
          $userId = null;
          if (isset($_GET["user_id"])) {
            $userId = $_GET["id"];
          }

          // Display user information if available (replace with your function)
          if ($userId) {
            $userInfo = getUserInfo($userId); // Assuming you have this function
            if ($userInfo) {
              echo "<p class='text-light'>Welcome, " . $userInfo["username"] . "!</p>";
            }
          }
        ?>
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
          <a href="admin/authentication/login.php" class="text-light text-decoration-none"><strong>Edit</strong></a>
         </div>
      </div>
    </div>

  <div class="container mt-5">
    <?php
      include("connect.php"); // Assuming your connection file

      // Check for id parameter
      $userId = null;
      if (isset($_GET["id"])) {
        $userId = $_GET["id"];
      }


      if ($userId) {
        $sqlSelectWorkshops = "SELECT * FROM workshop WHERE user_id = $userId"; // Filter by instructor ID
      }

      $result = mysqli_query($conn, $sqlSelectWorkshops);

      if (mysqli_num_rows($result) > 0) {
        echo "<table class='workshop-table'>
                <thead>
                  <tr>
                    <th>Workshop Name</th>
                    <th>Place</th>
                    <th>Duration</th>
                    <th>Date</th>
                    <th>Details</th>
                  </tr>
                </thead>
                <tbody>";
        while ($data = mysqli_fetch_array($result)) {
          echo "<tr>
                  <td>" . $data["w_name"] . "</td>
                  <td>" . $data["w_place"] . "</td>
                  <td>" . $data["w_duration"] . "</td>
                  <td>" . $data["w_date"] . "</td>
                  <td>" . $data["w_details"] . "</td>
                </tr>";
        }
        echo "</tbody>
              </table>";
      } else {
        if (isset($_GET["id"])) {
          echo "<p class='text-center'>No workshops found organized by this user!</p>";
        } else {
          echo "<p class='text-center'>No workshops found!</p>";
        }
      }

      mysqli_close($conn); // Close the connection (optional)
    ?>
  </div>

 
</body>
</html>
