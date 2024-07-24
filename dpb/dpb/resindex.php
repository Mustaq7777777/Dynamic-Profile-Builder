<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Research Projects</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    .research-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 50px;
    }

    .research-table th,
    .research-table td {
      border: 1px solid #ddd;
      padding: 10px;
    }

    .research-table th {
      text-align: left;
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <header class="p-4 bg-dark text-center">
    <h1><a href="resindex.php" class="text-light text-decoration-none">Research Projects</a></h1>
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
      // Include connection file
      include("connect.php");

      // Check for id parameter
      $userId = null;
      if (isset($_GET["id"])) {
        $userId = $_GET["id"];
      }

      // Error handling for database connection
      if (!$conn) {
        echo "<p class='text-center text-danger'>Error connecting to database: " . mysqli_connect_error() . "</p>";
        exit; // Stop script execution
      }

      // Modify SQL query
      $sqlSelect = "SELECT * FROM research WHERE user_id = " . ($userId ? $userId : "NULL") . "";

      $result = mysqli_query($conn, $sqlSelect);

      if (mysqli_num_rows($result) > 0) {
        echo "<table class='research-table'>
                <thead>
                  <tr>
                    <th>Project Name</th>
                    <th>Sanctioned By</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>";
          while ($data = mysqli_fetch_array($result)) {
            // Check for missing data (optional)
            if (!isset($data["title"]) || !isset($data["sanctioned_by"])) {
              echo "<tr><td colspan='5'>Missing project data</td></tr>"; // Handle missing data gracefully
            } else {
              echo "<tr>
                      <td>" . $data["title"] . "</td>
                      <td>" . $data["sanctioned_by"] . "</td>
                      <td>" . $data["total_amount"] . "</td>
                      <td>" . $data["type"] . "</td>
                      <td>" . $data["status"] . "</td>
                    </tr>";
            }
          }
          echo "</tbody>
                </table>";
        } else {
          if (isset($_GET["id"])) {
            echo "<p class='text-center'>No research projects found for this user!</p>";
          } else {
            echo "<p class='text-center'>No research projects found!</p>";
          }
        }
  
        mysqli_close($conn); // Close the connection (optional)
        ?>
      </div>
  
   
  </body>
  </html>
  
