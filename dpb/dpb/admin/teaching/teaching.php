
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
                    <a href="../research/research.php" class="text-light text-decoration-none"><strong>Research </strong></a>
                </div>
                <div class="menu mt-5">
                    <a href="../workshop/workshop.php" class="text-light text-decoration-none"><strong>Workshops</strong></a>
                </div>
                <div class="menu mt-5">
                    <a href="teaching.php" class="text-light text-decoration-none"><strong>Teaching</strong></a>
                </div>

                <div class="menu mt-5">
                    <a href="../view/index.php" class="text-light text-decoration-none"><strong>View Website</strong></a>
                </div>
                <div class="menu mt-5">
                    <a href="../authentication/logout.php" class="btn btn-info">Logout</a>
                </div>
                
            </div>
        </div>

<div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
  <form action="tprocess.php" method="post">
    <h3 class="mb-4">Courses</h3>
    <div class="form-field mb-4">
      <label for="course_title">Title of Course:</label>
      <input type="text" class="form-control" name="course_title" id="course_title" placeholder="Enter Course Title" required>
    </div>
    <div class="form-field mb-4">
      <label for="course_level">Level:</label>
      <select name="course_level" id="course_level" class="form-control" required>
        <option value="">Select Level</option>
        <option value="UG">UG</option>
        <option value="PG">PG</option>
        </select>
    </div>
    <div class="form-field mb-4">
      <label for="course_year">Year:</label>
      <input type="number" class="form-control" name="course_year" id="course_year" min="2000" placeholder="Enter Year (e.g., 2024)" required>
    </div>
    <div class="form-field">
      <input type="submit" class="btn btn-primary" value="Submit" name="create">
    </div>
  </form>
</div>


<div class="text-center mt-3  " >
  <a href="tindex.php" class="btn btn-info ">Manage</a>
</div>


</div>
</body>
</html>