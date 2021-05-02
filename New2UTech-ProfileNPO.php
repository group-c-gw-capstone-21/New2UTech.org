
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

$stmt8 = $link->prepare('SELECT UserFirstName, UserID FROM User WHERE UserID = ?');
$stmt8->bind_param('i', $_SESSION['id']);
$stmt8->execute();
$stmt8->bind_result($first_name, $userID);
$stmt8->fetch();
$stmt8->close();

$stmt9 = $link->prepare('SELECT UserLastName, UserID FROM User WHERE UserID = ?');
$stmt9->bind_param('i', $_SESSION['id']);
$stmt9->execute();
$stmt9->bind_result($last_name, $userID);
$stmt9->fetch();
$stmt9->close();

$stmt10 = $link->prepare('SELECT UserAddress, UserID FROM User WHERE UserID = ?');
$stmt10->bind_param('i', $_SESSION['id']);
$stmt10->execute();
$stmt10->bind_result($address1, $userID);
$stmt10->fetch();
$stmt10->close();

$stmt11 = $link->prepare('SELECT UserAddress2, UserID FROM User WHERE UserID = ?');
$stmt11->bind_param('i', $_SESSION['id']);
$stmt11->execute();
$stmt11->bind_result($address2, $userID);
$stmt11->fetch();
$stmt11->close();

$stmt12 = $link->prepare('SELECT UserCity, UserID FROM User WHERE UserID = ?');
$stmt12->bind_param('i', $_SESSION['id']);
$stmt12->execute();
$stmt12->bind_result($city, $userID);
$stmt12->fetch();
$stmt12->close();

$stmt13 = $link->prepare('SELECT UserState, UserID FROM User WHERE UserID = ?');
$stmt13->bind_param('i', $_SESSION['id']);
$stmt13->execute();
$stmt13->bind_result($state, $userID);
$stmt13->fetch();
$stmt13->close();

$stmt14 = $link->prepare('SELECT UserZipCode, UserID FROM User WHERE UserID = ?');
$stmt14->bind_param('i', $_SESSION['id']);
$stmt14->execute();
$stmt14->bind_result($zip, $userID);
$stmt14->fetch();
$stmt14->close();

$stmt15 = $link->prepare('SELECT NPCompanyName, UserID FROM Non_Profit WHERE UserID = ?');
$stmt15->bind_param('i', $_SESSION['id']);
$stmt15->execute();
$stmt15->bind_result($npo_official_bus_name, $userID);
$stmt15->fetch();
$stmt15->close();

$stmt16 = $link->prepare('SELECT TIN_EIN, UserID FROM Non_Profit WHERE UserID = ?');
$stmt16->bind_param('i', $_SESSION['id']);
$stmt16->execute();
$stmt16->bind_result($npo_ein_tin, $userID);
$stmt16->fetch();
$stmt16->close();

$stmt17 = $link->prepare('SELECT NPID, UserID FROM Non_Profit WHERE UserID = ?');
$stmt17->bind_param('i', $_SESSION['id']);
$stmt17->execute();
$stmt17->bind_result($npo_id, $userID);
$stmt17->fetch();
$stmt17->close();

$_SESSION['npid'] = $npo_id;
$_SESSION['npid_bus_name'] = $npo_official_bus_name;

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
            </div>   <!-- /.navbar-collapse -->
          </div> <!-- /.container -->
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
      <h2 style="text-align:center">Non-Profit Account Profile</h2>

      <form class="new-account-form" action="#" method="post">

        <!-- <div class="cotainer"> -->
          <p style="text-align:justify"></p><br>
          <a class="edit-profile-btn" href="New2UTech-ProfileEditNPO.php">Edit Profile</a>
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
              <td> <label for="bname"><b>Business Name: </b></label> </td> <td id="bname" name="bname" style="color:red"> <?php echo $npo_official_bus_name ?> </td>
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
            <tr>
              <td> <label for="tin-ein"><b>Non-Profit TIN / EIN: </b></label> </td> <td id="tin-ein" name="tin-ein" style="color:red"> <?php echo $npo_ein_tin ?> </td>
            </tr>
          </table>
          <br>
        <!-- </div> -->

      <table><tr>
        <td>
          <a class="npo-search-inventory-btn" href="New2UTech-PreviousTransactions.php">View Previous Transactions</a></td>
          <!-- "view-npo-trans-btn" -->
          <td>
            <a class="cancel-btn" href="New2UTech-ClaimRequestsNPO.php">Manage Claim Requests</a></td>
            <!-- "view-npo-claims-btn" -->
          <td>
            <a class="npo-profile-btn" href="New2UTech-SearchInventory.php">Search Available Inventory</a></td>
        </tr>
        </table>

      </form>

  </main>
  <div class="separator"></div>
  <footer>
    <div class="homepage-footer">
      <a href="New2UTech-Homepage.php">New2UTech</a>
    </div>
  </footer>
  </body>
</html>
