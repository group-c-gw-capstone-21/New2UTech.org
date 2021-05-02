<?php
  // Include config file
  require_once "New2UTech-Config.php";

  // Define variables and initialize with empty values
  $username = $zip = "";
  $username_err = $zip_err = "";

  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){

      // Check if username is empty
      if(empty(trim($_POST["username"]))){
          $username_err = "Please enter username.";
      } else{
          $username = trim($_POST["username"]);
      }

      // Check if ZIP is empty
      if(empty(trim($_POST["zip"]))){
          $zip_err = "Please enter the 5-digit ZIP code accociated with the account.";
      } else{
          $zip = trim($_POST["zip"]);
      }

      // Validate credentials
      if(empty($username_err) && empty($zip_err)){

          // Prepare a select statement
          $sql = "SELECT UserID, Username, UserZipCode FROM User WHERE Username = ?";

          if($stmt = mysqli_prepare($link, $sql)){
              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "s", $param_username);

              // Set parameters
              $param_username = $username;

              // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                  // Store result
                  mysqli_stmt_store_result($stmt);

                  // Check if username exists, if yes then verify password
                  if(mysqli_stmt_num_rows($stmt) == 1){
                      // Bind result variables
                      mysqli_stmt_bind_result($stmt, $id, $username, $zip);
                      if(mysqli_stmt_fetch($stmt)){
                          if($_POST["zip"] == $zip){
                              // Password is correct, start a new session
                              session_start();

                              // Store data in session variables
                              $_SESSION["loggedin"] = true;
                              $_SESSION["id"] = $id;
                              $_SESSION["username"] = $username;

                              // Redirect user to welcome page
                              header("location: New2UTech-reset-password.php");
                          } else{
                              // Display an error message if password is not valid
                              $zip_err = "The ZIP Code you entered was not valid.";
                          }
                      }
                  } else{
                      // Display an error message if username doesn't exist
                      $username_err = "No account found with that username.";
                  }
              } else{
                  echo "Oops! Something went wrong. Please try again later.";
              }

              // Close statement
              mysqli_stmt_close($stmt);
          }
        }
        // Close connection
        mysqli_close($link);
        }
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>New2UTech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="New2UTech-Format.v1.css" />
  </head>

  <body>
    <header>
      <div class="topHeaderRow">
      </div>
        <!-- end topHeaderRow -->
        <nav class="navbar-default ">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="New2UTech-Homepage.php"><br><span> &#160; New2UTech</a>
            </div>
            <br>
            <div id="menu-outer">
              <div class="table">
                <ul id="horizontal-list">
                  <li><a class="nav-links" href="New2UTech-Homepage.php">Home</a></li>
                  <li<span>&#160;<span> &#160;<span> &#160;<span> &#160;<a class="nav-links" href="New2UTech-AboutUs.php">About Us</a></li>
                  <li<span>&#160;<span> &#160;<span> &#160;<span> &#160;<a class="nav-links" href="New2UTech-Donate.php">Donate</a></li>
                  <li<span>&#160;<span> &#160;<span> &#160;<span> &#160;<a class="nav-links" href="New2UTech-login.php">Log In</a></li>
                </ul>
              </div>
            </div>
          </div>
        </nav>
    </header>
    <!-- Page Content -->
    <main>
      <h2 style="text-align:center" style="font-size:20px">Forgot Password</h2>
      <h3>If you do not have an account. Click <a href ="New2UTech-register.php" class="new-account-link">here</a> to create a new account.</h3>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="register-form">

      <table><tr><br></tr>
      <div class="container <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>"><tr><td>
        <label for="username"><b>Username</b></label></td><td>
        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
        <span class="help-block"><?php echo $username_err; ?></span></td></tr>
      </div>

      <div class="container <?php echo (!empty($zip_err)) ? 'has-error' : ''; ?>"><tr><td>
        <label for="zip"><b>Enter 5-digit ZIP Code</b></label></td><td>
        <input type="zip" name="zip" class="form-control">
        <span class="help-block"><?php echo $zip_err; ?></span></td></tr><tr><br></tr>
      </div>
    </table>

      <div class="container">
        <button name="submit" class="btn btn-primary" type="submit">Submit Credentials</button>
      </div>
      <table><tr>
        <td>Don't have an account? <a href="New2UTech-register.php">Sign up now</a>.</td></tr><tr>
        <td>Forgot password? <a href="New2UTech-ForgotPassword.php">Click here</a>.</td></tr>
    </table>
  </form>
<br>
</main>
<div class="separator"></div>
<footer>
<div class="homepage-footer">
  <a href="New2UTech-Homepage.php">New2UTech</a>
</div>
</footer>
</body>
</html>
