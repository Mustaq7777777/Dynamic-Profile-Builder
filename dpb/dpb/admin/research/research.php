
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
                    <a href="research.php" class="text-light text-decoration-none"><strong>Research </strong></a>
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

        <!-- kakha -->
<div class="container mt-5">  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header">
          <h3 class="card-title">Enter Research Details</h3>
        </div>
        <div class="card-body">
          <form action="rprocess.php" method="post">
            <div class="form-group mb-3">  <label for="title">Name of Research Project:</label>
              <input type="text" class="form-control" name="title" id="title" cols="30" rows="2" placeholder="Enter Research Project Name" required>
            </div>
            <div class="form-group mb-3">
              <label for="sanctioned_by">Sanctioned By (e.g., DST/UGC/AICTE):</label>
              <textarea name="sanctioned_by" class="form-control" id="sanctioned_by" placeholder="Enter Sanctioning Body" required></textarea>
            </div>
            <div class="form-group mb-3">
              <label for="total_amount">Total Sanctioned Amount:</label>
              <input type="number" class="form-control" name="total_amount" id="total_amount" placeholder="Enter Total Amount" min="0" required>
            </div>
            <div class="form-group mb-3">
              <label for="type">Publication Type:</label>
              <select name="type" id="type" class="form-control" required>
                <option value="">Select Type</option>
                <option value="journal">Journal Article</option>
                <option value="conference">Conference Paper</option>
                <option value="chapter">Book Chapter</option>
                <option value="book">Book</option>
                <option value="thesis">Thesis/Dissertation</option>
                <option value="patent">Patent</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="status">Status:</label>
              <input type="text" class="form-control" name="status" id="status" placeholder="Enter Project Status (e.g., Ongoing, Completed)" required>
            </div>
            <div class="form-group text-right">  <input type="submit" class="btn btn-primary" value="Submit" name="create">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="text-center mt-3  " >
  <a href="rindex.php" class="btn btn-info ">Manage</a>
</div>

</div>
</body>
</html>