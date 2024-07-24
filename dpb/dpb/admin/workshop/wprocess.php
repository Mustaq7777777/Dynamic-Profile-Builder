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

  $workshop_name = mysqli_real_escape_string($conn, $_POST["w_name"]);
  $workshop_place = mysqli_real_escape_string($conn, $_POST["w_place"]);
  $duration = mysqli_real_escape_string($conn, $_POST["w_duration"]);
  $date = mysqli_real_escape_string($conn, $_POST["w_date"]);
  $details = mysqli_real_escape_string($conn, $_POST["w_details"]);

  // Construct SQL insert query for workshops table
  $sqlInsert = "INSERT INTO workshop (w_name, w_place, w_duration, w_date, w_details, user_id) VALUES ('$workshop_name', '$workshop_place', '$duration', '$date', '$details','$logged_in_user_id')";

  if (mysqli_query($conn, $sqlInsert)) {
    session_start();
    $_SESSION["create"] = "Workshop added successfully!";
    header("Location: workshop.php");  // Redirect to workshop page
  } else {
    die("Error creating workshop: " . mysqli_error($conn));
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
  // Escape user input
  $workshop_name = mysqli_real_escape_string($conn, $_POST["workshop_name"]);
  $workshop_place = mysqli_real_escape_string($conn, $_POST["workshop_place"]);
  $duration = mysqli_real_escape_string($conn, $_POST["duration"]);
  $date = mysqli_real_escape_string($conn, $_POST["date"]);
  $details = mysqli_real_escape_string($conn, $_POST["details"]);
  $id = mysqli_real_escape_string($conn, $_POST["id"]);  // Assuming you have a hidden field for workshop ID

  // Construct SQL update query
  $sqlUpdate = "UPDATE workshop SET w_name = '$workshop_name', w_place = '$workshop_place', w_duration = '$duration', w_date = '$date', w_details = '$details' 
                  WHERE id = $id AND user_id = $logged_in_user_id";

  if (mysqli_query($conn, $sqlUpdate)) {
    $_SESSION["update"] = "Workshop updated successfully!";
    header("Location: windex.php");  // Redirect to workshop page
  } else {
    // Handle potential errors (e.g., no rows affected)
    if (mysqli_affected_rows($conn) === 0) {
      die("Error: No Workshop found to update or insufficient permissions!");
    } else {
      die("Error updating workshop: " . mysqli_error($conn)); // Display error message with details for debugging
    }
  }

  mysqli_close($conn);  // Close database connection
}
?>
