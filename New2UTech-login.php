<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: New2UTech-welcome.php");
    exit;
}

// Include config file
require_once "New2UTech-Config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){

        // Prepare a select statement
        $sql = "SELECT UserID, Username, Password FROM User WHERE Username = ?";

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
                    mysqli_stmt_bind_result($stmt, $id, $username, $password);
                    if(mysqli_stmt_fetch($stmt)){
                        if($_POST["password"] == $password){
                            // Password is correct, start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: New2UTech-welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
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
      <h2 style="text-align:center" style="font-size:20px">Login</h2>
      <h3> If you do not have an account. Click <a href ="New2UTech-register.php" class="new-account-link">here</a> to create a new account.</h3>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form">
          <div class="img-container">

            <img src="images/log-in-avatar.jpg" alt="Avatar">
          </div>

          <div class="container <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label for="username"><b>Username</b></label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
          </div>

          <div class="container <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label for="password"><b>Password</b></label>
            <input type="password" name="password" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
          </div>

          <div class="container">
            <button class="btn btn-primary" type="submit">Login</button>
          </div>
          <p>Don't have an account? <a href="New2UTech-register.php">Sign up now</a>.</p>
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
