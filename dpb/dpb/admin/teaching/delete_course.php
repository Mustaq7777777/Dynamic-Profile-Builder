<?php
// Get research project ID from URL parameter
$id = $_GET["id"];

// Session Start
session_start();

if ($id && isset($_SESSION['user_id'])) {
  // Include database connection
  include('../../connect.php');

  // Create SQL query to delete research project with user check
  $sqlDelete = "DELETE FROM teaching WHERE id = $id AND user_id = " . $_SESSION['user_id'];
  if (mysqli_query($conn, $sqlDelete)) {
    // Delete successful, set session variable and redirect

    $_SESSION["delete"] = "Course deleted successfully!";
    header("Location: tindex.php"); // Redirect to teaching page (replace if needed)
  } else {
   // Check if delete failed due to non-existent project or permission issue
   if (mysqli_affected_rows($conn) == 0) {
    echo "You are not authorized to delete this course.";
  } else {
    die("Error deleting course: " . mysqli_error($conn)); // Display other errors
  } // Display error message with details
  }

  // Close database connection (not strictly necessary here, but good practice)
  mysqli_close($conn);
} else {
  echo "Invalid course ID.";
}
?>
