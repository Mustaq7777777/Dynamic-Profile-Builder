

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
  $title = mysqli_real_escape_string($conn, $_POST["course_title"]);
  $level = mysqli_real_escape_string($conn, $_POST["course_level"]); // Assuming "level" field exists in the form
  $year = mysqli_real_escape_string($conn, $_POST["course_year"]); // Assuming "year" field exists in the form

  // Construct the SQL insert query (consider adding logged-in user ID)
  $sqlInsert = "INSERT INTO teaching (course_title, course_level, course_year, user_id)
                 VALUES ('$title', '$level', '$year', '$logged_in_user_id')";

  if (mysqli_query($conn, $sqlInsert)) {
    $_SESSION["create"] = "Course added successfully!";
    header("Location: teaching.php"); // Redirect to a success page (e.g., index.php)
  } else {
    die("Error: Data insertion failed! " . mysqli_error($conn)); // Display error message with details for debugging
  }
}
?>


<?php
session_start();

// Check if user is logged in, redirect to login if not
if (!isset($_SESSION['user_id'])) {
  header("Location:  ../authentication/login.php"); // Replace with your login page path
  exit;
}

$logged_in_user_id = $_SESSION['user_id']; // Get the logged-in user ID

if (isset($_POST["update"])) {
  include('../../connect.php');

  // Escape user input to prevent SQL injection
  $title = mysqli_real_escape_string($conn, $_POST["title"]);
  $level = mysqli_real_escape_string($conn, $_POST["level"]);
  $year = mysqli_real_escape_string($conn, $_POST["year"]);
  $id = mysqli_real_escape_string($conn, $_POST["id"]);

  // Construct the SQL update query (include user_id for access control)
  $sqlUpdate = "UPDATE teaching SET course_title = '$title', course_level = '$level', course_year = '$year'
                WHERE id = $id AND user_id = $logged_in_user_id";

  if (mysqli_query($conn, $sqlUpdate)) {
    // Update successful, set session variable and redirect
    $_SESSION["update"] = "Course updated successfully!";
    header("Location: teaching.php"); // Redirect to course list page (replace if needed)
  } else {
    // Handle potential errors (e.g., no rows affected)
    if (mysqli_affected_rows($conn) === 0) {
      die("Error: No course found to update or insufficient permissions!");
    } else {
      die("Error updating course: " . mysqli_error($conn)); // Display error message with details for debugging
    }
  }

  // Close database connection (not strictly necessary here, but good practice)
  mysqli_close($conn);
}
?>

