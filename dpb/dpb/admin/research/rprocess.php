<?php
session_start();

// Check if user is logged in, redirect to login if not
if (!isset($_SESSION['user_id'])) {
  header("Location: ../authentication/login.php"); // Replace with your login page path
  exit;
}

$logged_in_user_id = $_SESSION['user_id']; // Get the logged-in user ID

if (isset($_POST["create"])) {
  include('../../connect.php');

  // Escape user input to prevent SQL injection
  $title = mysqli_real_escape_string($conn, $_POST["title"]);
  $sanctioned_by = mysqli_real_escape_string($conn, $_POST["sanctioned_by"]);
  $total_amount = mysqli_real_escape_string($conn, $_POST["total_amount"]);
  $status = mysqli_real_escape_string($conn, $_POST["status"]);
  $type = mysqli_real_escape_string($conn, $_POST["type"]); // Assuming "type" field exists in the form

  // Construct the SQL insert query (consider adding logged-in user ID)
  $sqlInsert = "INSERT INTO research (title, sanctioned_by, total_amount, status, type, user_id) 
                 VALUES ('$title', '$sanctioned_by', '$total_amount', '$status', '$type', '$logged_in_user_id ')";

  if (mysqli_query($conn, $sqlInsert)) {
    $_SESSION["create"] = "Research project added successfully!";
    header("Location: research.php"); // Redirect to a success page (e.g., index.php)
  } else {
    die("Error: Data insertion failed! " . mysqli_error($conn)); // Display error message with details for debugging
  }
}

// Similar logic for update section with user_id inclusion...
?>


<?php
session_start();

// Check if user is logged in, redirect to login if not
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php"); // Replace with your login page path
  exit;
}

$logged_in_user_id = $_SESSION['user_id']; // Get the logged-in user ID

if (isset($_POST["update"])) {
  include('../../connect.php');

  // Escape user input to prevent SQL injection
  $title = mysqli_real_escape_string($conn, $_POST["title"]);
  $sanctioned_by = mysqli_real_escape_string($conn, $_POST["sanctioned_by"]);
  $total_amount = mysqli_real_escape_string($conn, $_POST["total_amount"]);
  $status = mysqli_real_escape_string($conn, $_POST["status"]);
  $type = mysqli_real_escape_string($conn, $_POST["type"]);
  $id = mysqli_real_escape_string($conn, $_POST["id"]);

  // Construct the SQL update query (include user_id for access control)
  $sqlUpdate = "UPDATE research SET title = '$title', sanctioned_by = '$sanctioned_by', total_amount = '$total_amount', status = '$status', type = '$type' 
                WHERE id = $id AND user_id = $logged_in_user_id";

  if (mysqli_query($conn, $sqlUpdate)) {
    // Update successful, set session variable and redirect
    $_SESSION["update"] = "Research project updated successfully!";
    header("Location: rindex.php"); // Redirect to research project list page (replace if needed)
  } else {
    // Handle potential errors (e.g., no rows affected)
    if (mysqli_affected_rows($conn) === 0) {
      die("Error: No research project found to update or insufficient permissions!");
    } else {
      die("Error updating research project: " . mysqli_error($conn)); // Display error message with details for debugging
    }
  }

  // Close database connection (not strictly necessary here, but good practice)
  mysqli_close($conn);
}
?>
