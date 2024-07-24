

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
                    <a href="workshop.php" class="text-light text-decoration-none"><strong>Workshops</strong></a>
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
  <form action="wprocess.php" method="post">
    <h3 class="mb-4">Enter Workshop Details</h3>
    <div class="form-field mb-4">
      <label for="workshop_name">Workshop Name:</label>
      <input type="text" class="form-control" name="w_name" id="workshop_name" placeholder="Enter Workshop Name" required>
    </div>
    <div class="form-field mb-4">
      <label for="workshop_place">Workshop Place:</label>
      <input type="text" class="form-control" name="w_place" id="workshop_place" placeholder="Enter Workshop Location" required>
    </div>
    <div class="form-field mb-4">
      <label for="duration">Duration:</label>
      <input type="text" class="form-control" name="w_duration" id="duration" placeholder="Enter Duration (e.g., 2 hours, 1 day)" required>
    </div>
    <div class="form-field mb-4">
      <label for="date">Date:</label>
      <input type="date" class="form-control" name="w_date" id="date" required>
    </div>
    <div class="form-field mb-4">
      <label for="details">Workshop Details:</label>
      <textarea name="w_details" class="form-control" id="details" rows="5" placeholder="Provide details about the workshop (topic, target audience, etc.)" required></textarea>
    </div>
    <div class="form-field">
      <input type="submit" class="btn btn-primary" value="Submit" name="create">
    </div>
  </form>
</div>

<div class="text-center mt-3  " >
  <a href="windex.php" class="btn btn-info ">Manage</a>
</div>





</div>
</body>
</html>