<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: New2UTech-login.php");
    exit;
}

// Include config file
include_once 'New2UTech-Config.php';

$stmt = $link->prepare('SELECT DonorID, UserID FROM Donor WHERE UserID = ?');
// Use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($donorID, $userID);
$stmt->fetch();
$stmt->close();

$stmt2 = $link->prepare('SELECT NPID, UserID FROM Non_Profit WHERE UserID = ?');
// Use the account ID to get the account info.
$stmt2->bind_param('i', $_SESSION['id']);
$stmt2->execute();
$stmt2->bind_result($npID, $userID);
$stmt2->fetch();
$stmt2->close();

$stmt3 = $link->prepare('SELECT UserRole, UserID FROM User WHERE UserID = ?');
// Use the account ID to get the account info.
$stmt3->bind_param('i', $_SESSION['id']);
$stmt3->execute();
$stmt3->bind_result($user_type, $userID);
$stmt3->fetch();
$stmt3->close();

//determine user type and new user goes to create profile, regular user goes to profile
if (empty($donorID)) {
  if (empty($npID)){
    if ($user_type == "Donor"){
      echo "This is a donor user and we should display create profile page.";
      header("location: New2UTech-DonorNewAccount.php");
    }
    else{
      echo "This is a non-profit user and we should display non-profit verification page";
      header("location: New2UTech-VerificationNPO.php");
    }
  }
}
if (empty($donorID)) {}
else {
  echo "Donor has a profile, display it.";
  header("location: New2UTech-DonorProfile.php");
}
if (empty($npID)) {}
else {
  echo "Non-profit has a profile, display it.";
  header("location: New2UTech-ProfileNPO.php");
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
    <div class="login-header">
        <h4>Logged in as: <?php echo($_SESSION["username"]); ?></h4>
            <a href="New2UTech-reset-password.php" >Reset Your Password</a>
              <br>
            <a href="New2UTech-logout.php" >Log Out</a>
    </div>

<footer>
  <div class="new-account-footer">
    <a href="New2UTech-Homepage.php">New2UTech</a>
  </div>
</footer>
</body>
</html>
