
<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: New2UTech-login.php");
    exit;
}

// Include config file
include 'New2UTech-Config.php';

$stmt2 = $link->prepare('SELECT UserFirstName, UserID FROM User WHERE UserID = ?');
$stmt2->bind_param('i', $_SESSION['id']);
$stmt2->execute();
$stmt2->bind_result($first_name, $userID);
$stmt2->fetch();
$stmt2->close();

$stmt3 = $link->prepare('SELECT UserLastName, UserID FROM User WHERE UserID = ?');
$stmt3->bind_param('i', $_SESSION['id']);
$stmt3->execute();
$stmt3->bind_result($last_name, $userID);
$stmt3->fetch();
$stmt3->close();

$stmt1 = $link->prepare('SELECT DonorCompanyName, UserID FROM Donor WHERE UserID = ?');
$stmt1->bind_param('i', $_SESSION['id']);
$stmt1->execute();
$stmt1->bind_result($don_business_name, $userID);
$stmt1->fetch();
$stmt1->close();

$stmt4 = $link->prepare('SELECT UserAddress, UserID FROM User WHERE UserID = ?');
$stmt4->bind_param('i', $_SESSION['id']);
$stmt4->execute();
$stmt4->bind_result($address1, $userID);
$stmt4->fetch();
$stmt4->close();

$stmt4 = $link->prepare('SELECT UserAddress2, UserID FROM User WHERE UserID = ?');
$stmt4->bind_param('i', $_SESSION['id']);
$stmt4->execute();
$stmt4->bind_result($address2, $userID);
$stmt4->fetch();
$stmt4->close();

$stmt5 = $link->prepare('SELECT UserCity, UserID FROM User WHERE UserID = ?');
$stmt5->bind_param('i', $_SESSION['id']);
$stmt5->execute();
$stmt5->bind_result($city, $userID);
$stmt5->fetch();
$stmt5->close();

$stmt6 = $link->prepare('SELECT UserState, UserID FROM User WHERE UserID = ?');
$stmt6->bind_param('i', $_SESSION['id']);
$stmt6->execute();
$stmt6->bind_result($state, $userID);
$stmt6->fetch();
$stmt6->close();

$stmt7 = $link->prepare('SELECT UserZipCode, UserID FROM User WHERE UserID = ?');
$stmt7->bind_param('i', $_SESSION['id']);
$stmt7->execute();
$stmt7->bind_result($zip, $userID);
$stmt7->fetch();
$stmt7->close();

$stmt18 = $link->prepare('SELECT DonorID, UserID FROM Donor WHERE UserID = ?');
$stmt18->bind_param('i', $_SESSION['id']);
$stmt18->execute();
$stmt18->bind_result($donor_id, $userID);
$stmt18->fetch();
$stmt18->close();

$_SESSION['donor_id'] = $donor_id;
$_SESSION['donor_bus_name'] = $don_business_name;

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
    <div class="login-header">
      <h4>Logged in as: <?php echo($_SESSION["username"]); ?></h4>
        <a href="New2UTech-reset-password.php" >Reset Your Password</a>
          <br>
          <a href="New2UTech-logout.php" >Log Out</a>
    </div>
    <main>
      <h2 style="text-align:center">Donor Account Profile</h2>
      <div class="new-account-form">
          <p style="text-align:justify"></p><br>
          <a class="edit-profile-btn" href="New2UTech-DonorEditProfile.php">Edit Profile</a>
          <br>
          <table>
            <tr>
              <td> <label for="uname"><b>Username (email address): </b></label> </td> <td id="uname" name="uname" style="color:red"> <?php echo($_SESSION["username"]); ?> </td>
            </tr>
            <tr>
              <td> <label for="fname"><b>First Name: </b></label> </td> <td id="fname" name="fname"> <?php echo $first_name ?> </td>
            </tr>
            <tr>
              <td> <label for="lname"><b>Last Name: </b></label> </td> <td id="lname" name="lname"> <?php echo $last_name ?> </td>
            </tr>
            <tr>
              <td> <label for="bname"><b>Business Name: </b></label> </td> <td id="bname" name="bname"> <?php echo $don_business_name ?> </td>
            </tr>
            <tr>
              <td> <label for="address1"><b>Street Address: </b></label> </td> <td id="address1" name="address1"> <?php echo $address1 ?> </td>
            </tr>
            <tr>
              <td> <label for="address2"><b>Street Address 2: </b></label> </td> <td id="address2" name="address2"> <?php echo $address2 ?> </td>
            </tr>
            <tr>
              <td> <label for="city"><b>City: </b></label> </td> <td id="city" name="city"> <?php echo $city ?> </td>
            </tr>
            <tr>
              <td> <label for="state"><b>State: </b></label> </td> <td id="state" name="state"> <?php echo $state ?> </td>
            </tr>
            <tr>
              <td> <label for="zip"><b>5-Digit ZIP Code: </b></label> </td> <td id="zip" name="zip"> <?php echo $zip ?> </td>
            </tr>
          </table>
          <br>
          <table>
            <tr>
              <td style="padding:1em">
          <a class="update-inventory-view-btn" href="New2UTech-DonorInventory.php">Manage Inventory</a>
            </td>
          <td>
          <a class="view-inventory-btn" href="New2UTech-DonorManageRequests.php">View Claim Requests</a>
        </td>
      </tr>
          </table>
      </div>
  </main>
  <div class="separator"></div>

  <footer>
    <div class="homepage-footer">
      <a href="New2UTech-Homepage.php">New2UTech</a>
    </div>
  </footer>
  </body>
</html>
