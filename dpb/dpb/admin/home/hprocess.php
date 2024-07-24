<?php
session_start();

// Check if user is logged in, redirect to login if not
if (!isset($_SESSION['user_id'])) {
  header("Location: ../authentication/login.php"); // Replace with your login page path
  exit;
}

$logged_in_user_id = $_SESSION['user_id']; // Get the logged-in user ID

// Validate form data (consider adding more validations as needed)
$facultyNameError = "";
$facultyBioError = "";
$facultyResumeError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include('../../connect.php');
  // Validate faculty name
  if (empty($_POST["faculty_name"])) {
    $facultyNameError = "Faculty name is required";
  } else {
    $facultyName = mysqli_real_escape_string($conn, $_POST["faculty_name"]);
  }
  // validate faculty image
  if (empty($_FILES["faculty_image"]["name"])) {
    $facultyImageError = "Faculty image is required.";
  } else {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileName = $_FILES["faculty_image"]["name"];
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

    if (!in_array(strtolower($fileType), $allowedExtensions)) {
      $facultyImageError = "Only JPG, JPEG, PNG, and GIF files are allowed.";
    } else {
      // Assuming validation passes, store image data for later processing
      $facultyImage = addslashes(file_get_contents($_FILES["faculty_image"]["tmp_name"]));
    }
  }

  // Validate faculty bio
  if (empty($_POST["faculty_bio"])) {
    $facultyBioError = "Faculty bio is required";
  } else {
    $facultyBio = mysqli_real_escape_string($conn, $_POST["faculty_bio"]);
  }

  // Validate faculty resume URL
  if (empty($_POST["faculty_resume"])) {
    $facultyResumeError = "Faculty resume link is required";
  } else {
    // Basic URL validation (can be improved with more robust checks)
    if (!filter_var($_POST["faculty_resume"], FILTER_VALIDATE_URL)) {
      $facultyResumeError = "Invalid resume link format. Please enter a valid Google Drive URL.";
    } else {
      $facultyResume = $_POST["faculty_resume"];
    }
  }

  // Check for validation errors before proceeding
  if (empty($facultyNameError) && empty($facultyBioError) && empty($facultyResumeError) && empty($facultyImageError)) {
    include('../../connect.php');  // Assuming your database connection file is named 'connect.php' and resides one directory above

    // Construct the SQL insert query (consider additional fields as needed)
    $sqlInsert = "INSERT INTO home (faculty_name, faculty_image ,faculty_bio, faculty_resume, user_id)
                   VALUES ('$facultyName','$facultyImage' , '$facultyBio', '$facultyResume', '$logged_in_user_id')";

    if (mysqli_query($conn, $sqlInsert)) {
      $_SESSION["create"] = "Faculty information added successfully!";
      header("Location: home.php"); // Redirect to a success page (e.g., index.php)
    } else {
      die("Error: Data insertion failed! " . mysqli_error($conn)); // Display error message for debugging purposes (consider user-friendly error display)
    }
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
  $facultyName = mysqli_real_escape_string($conn, $_POST["faculty_name"]);
  $facultyBio = mysqli_real_escape_string($conn, $_POST["faculty_bio"]);
  if (empty($_POST["faculty_resume"])) {
    $facultyResumeError = "Faculty resume link is required";
  } else {
    // Basic URL validation (can be improved with more robust checks)
    if (!filter_var($_POST["faculty_resume"], FILTER_VALIDATE_URL)) {
      $facultyResumeError = "Invalid resume link format. Please enter a valid Google Drive URL.";
    } else {
      $facultyResume = $_POST["faculty_resume"];
    }
  }
  
  // Validate faculty image (if uploaded)
  $facultyImage = null; // Initialize as null to handle no image update
  $facultyImageError = "";
  if (!empty($_FILES["faculty_image"]["name"])) {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileName = $_FILES["faculty_image"]["name"];
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

    if (!in_array(strtolower($fileType), $allowedExtensions)) {
      $facultyImageError = "Only JPG, JPEG, PNG, and GIF files are allowed.";
    } else {
      $facultyImage = addslashes(file_get_contents($_FILES["faculty_image"]["tmp_name"]));
    }
  }
  $id = mysqli_real_escape_string($conn, $_POST["id"]);  // Assuming you have a hidden field for workshop ID

       // Construct the SQL update query (include user_id for access control)
       $sqlUpdate = "UPDATE home SET faculty_name = '$facultyName', faculty_image = '$facultyImage', faculty_bio = '$facultyBio', faculty_resume = '$facultyResume' 
       WHERE id = $facultyId AND user_id = $logged_in_user_id " ;

  if (mysqli_query($conn, $sqlUpdate)) {
    $_SESSION["update"] = "Faculty info updated successfully!";
    header("Location: hindex.php");  // Redirect to workshop page
  } else {
    // Handle potential errors (e.g., no rows affected)
    if (mysqli_affected_rows($conn) === 0) {
      die("Error: No Factuly found to update or insufficient permissions!");
    } else {
      die("Error updating faculty info: " . mysqli_error($conn)); // Display error message with details for debugging
    }
  }

  mysqli_close($conn);  // Close database connection
}
?>


