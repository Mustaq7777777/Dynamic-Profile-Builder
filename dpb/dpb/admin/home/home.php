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

    <div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
      <form action="hprocess.php" method="post" enctype="multipart/form-data">
        <h3 class="mb-4">Faculty Information</h3>
        <div class="form-field mb-4">
          <label for="faculty_name">Faculty Name:</label>
          <input type="text" class="form-control" name="faculty_name" id="faculty_name" placeholder="Enter Faculty Name" required>
        </div>
        <div class="form-field mb-4">
         <label for="faculty_image">Faculty Image:</label>
          <input type="file" name="faculty_image" id="faculty_image" placeholder="Faculty Profile photo" required>
        </div>
        <div class="form-field mb-4">
          <label for="faculty_bio">Faculty Bio:</label>
          <textarea class="form-control" name="faculty_bio" id="faculty_bio" rows="5" placeholder="Enter Faculty Bio" required></textarea>
        </div>
        <div class="form-field mb-4">
          <label for="faculty_resume">Faculty Resume (Google Drive Link):</label>
          <input type="url" class="form-control" name="faculty_resume" id="faculty_resume" placeholder="Paste Google Drive Link Here" required>
            </div>
        <div class="form-field">
          <input type="submit" class="btn btn-primary" value="Submit" name="submit">
        </div>
      </form>
    </div>

        <div class="text-center mt-3">
            <a href="hindex.php" class="btn btn-info">Manage</a>
        </div>
    </div>
</body>
</html>
