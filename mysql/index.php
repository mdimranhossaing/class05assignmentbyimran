<?php

if (file_exists(dirname(__FILE__) . '/config.php')) {
  require_once(dirname(__FILE__) . '/config.php');
}

if (isset($_POST['user-submit'])) {

  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $add_users = "INSERT INTO Users( FirstName, LastName, Email, Password ) VALUES( '$fname', '$lname', '$email', '$password' )";

  if (mysqli_query($connection, $add_users)) {
    $user_added = "New record created successfully";
  } else {
    $user_not_added = "Error: " . $add_users . "<br>" . mysqli_error($connection);
  }
}

$show_table = mysqli_query($connection, "SELECT * FROM Users");
$row = mysqli_fetch_assoc($show_table);

mysqli_close($connection);

?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MySQL | Md Imran Hossain</title>
  <link rel="stylesheet" href="./assets/fw/bootstrap-5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body class="bg-dark">
  <header class="header-section">
    <div class="container">
      <h1 style="color:lime; font-size:12px; margin-top:15px;"><?php db_connect(); ?></h1>
    </div>
  </header>
  <section class="ad-user">
    <div class="container">

      <!-- Form title -->
      <h2 class="text-light mb-3">Add User</h2>

      <!-- Form body -->
      <div class="form-body bg-white rounded">
        <form class="p-4" action="" method="POST">

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label" for="fname">First name <span class="text-danger">*</span></label>
              <input class="form-control form-control-sm" type="text" id="fname" name="fname" placeholder="Enter your firstname" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label" for="lname">Last name <span class="text-danger">*</span></label>
              <input class="form-control form-control-sm" type="text" id="lname" name="lname" placeholder="Enter your lastname" required>
            </div>

            <div class="col-12 mb-3">
              <label class="form-label" for="email">Email address <span class="text-danger">*</span></label>
              <input class="form-control form-control-sm" type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>

            <div class="col-12 mb-4">
              <label class="form-label" for="password">New password <span class="text-danger">*</span></label>
              <input class="form-control form-control-sm" type="password" name="password" id="password" placeholder="Enter a new password" required>
            </div>

            <div class="col text-end">
              <input class="btn btn-outline-danger me-2" type="reset" value="Reset Fields">
              <input class="btn btn-outline-success" type="submit" name="user-submit" value="Submit">
            </div>

          </div>
        </form>
      </div>

      <b><?php

          if (isset($user_added)) {
            echo '<span style="color:lime">' . $user_added . '</span>';
          } elseif (isset($user_not_added)) {
            echo '<span style="color:red">' . $user_not_added . '</span>';
          }

          ?></b>

    </div>
  </section>

  <section class="show-database">
    <div class="container">
      <h2 class="text-light mb-3">Show all Database items</h2>
      <?php

      if (mysqli_num_rows($show_table) > 0) { ?>
        <div class="data-table bg-white rounded">
          <div class="p-4">
            <div class="table-responsive">
              <table class="table table-striped table-light table-hover border table-sm">
                <thead class="table-header">
                  <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Password</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">

                  <?php while ($row = mysqli_fetch_assoc($show_table)) { ?>

                    <tr>
                      <td><?php echo $row['ID']; ?></td>
                      <td><?php echo $row['FirstName']; ?></td>
                      <td><?php echo $row['LastName']; ?></td>
                      <td><?php echo $row['Email']; ?></td>
                      <td><?php echo $row['Password']; ?></td>
                    </tr>

                  <?php } ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php } else {
        echo "0 results";
      }

      ?>
    </div>
  </section>
  <script src="./assets/fw//bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>