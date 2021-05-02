<?php
// Include config file
require_once "New2UTech-Config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $user_type = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

$user_type = trim($_POST['user_type']);

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT UserID FROM User WHERE Username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO User (Username, Password, UserRole) VALUES (?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_user_type);

            // Set parameters
            $param_username = $username;
            $param_password = $password;
            $param_user_type = $user_type;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: New2UTech-login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
      <h2 style="text-align:center" style="font-size:20px">Sign Up</h2>
        <p style="text-align: center"> Please submit this form to create an account.</p>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="register-form">
        <table><tr><td>
          <div class="container">
            <label for="user_type"><b>User Type</b></label></td><td>
            <!-- <input type="text" placeholder="Enter Username" name="uname" required> -->
            <select id="user_type" name="user_type" value="<?php echo $user_type;?>" required>
              <option value "" disabled selected hidden> Must select user type</option><option value="Donor">Donor</option><option value="Non-Profit">Non-Profit</option></select>
              </td></tr>
          </div>

          <tr><td>
          <div class="container <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label for="username"><b>Username</b></label></td><td>
            <!-- <input type="text" placeholder="Enter Username" name="uname" required> -->
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span></td></tr><br>
          </div>

          <tr><td>
          <div class="container <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label for="password"><b>Password</b></label></td><td>
            <input type="password" name="password" class="form-control"  value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span></td></tr><br>
          </div>

          <tr><td>
          <div class="container <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label for="confirm_password"><b>Confirm Password</b></label></td><td>
            <input type="password" name="confirm_password" class="form-control"  value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span></td></tr><br>
          </div>

          <tr><td>
          <div class="container">
            <input type="reset" class="btn btn-default" value="Reset"></td><td>
            <input type="submit" class="btn btn-primary" value="Submit"></td></tr><br>
          </div>
        </table>
          <p style="text-align: center"> Already have an account? <a href="New2UTech-login.php">Login here</a>.</p>
      </form>
    <br>
  </main>

  <footer>
    <div class="homepage-footer">
      <a href="New2UTech-Homepage.php">New2UTech</a>
    </div>
  </footer>
  </body>
</html>
