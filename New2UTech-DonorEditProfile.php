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

//call database and store values to local variables
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

//if values change, update database
if(isset($_POST['submit']))
{
  $id = $_SESSION['id'];
  $modify_date = date('Y/m/d h:i:s a', time());
  if (empty($_POST['fname'])) {}
  else {
    $first_name = $_POST['fname'];
    $sql = "UPDATE User SET UserFirstName = '$first_name', DateModified = '$modify_date' WHERE UserID = $id";
    if (mysqli_query($link, $sql)){
    }else{
      echo "Error: " . $sql . ":-" . mysqli_error($link);
    }
  }
  if (empty($_POST['lname'])) {}
  else {
    $last_name = $_POST['lname'];
    $sql1 = "UPDATE User SET UserLastName = '$last_name', DateModified = '$modify_date' WHERE UserID = $id";
    if (mysqli_query($link, $sql1)){
    }else{
      echo "Error: " . $sql1 . ":-" . mysqli_error($link);
    }
  }

  if (empty($_POST['address1'])) {}
  else {
    $address1 = $_POST['address1'];
    $sql2 = "UPDATE User SET UserAddress = '$address1', DateModified = '$modify_date' WHERE UserID = $id";
    if (mysqli_query($link, $sql2)){
    }else{
      echo "Error: " . $sql2 . ":-" . mysqli_error($link);
    }
  }
  if (empty($_POST['address2'])) {}
  else {
    $address2 = $_POST['address2'];
    $sql3 = "UPDATE User SET UserAddress2 = '$address2', DateModified = '$modify_date' WHERE UserID = $id";
    if (mysqli_query($link, $sql3)){
    }else{
      echo "Error: " . $sql3 . ":-" . mysqli_error($link);
    }
  }
  if (empty($_POST['city'])) {}
  else {
    $city = $_POST['city'];
    $sql4 = "UPDATE User SET UserCity = '$city', DateModified = '$modify_date' WHERE UserID = $id";
    if (mysqli_query($link, $sql4)){
    }else{
      echo "Error: " . $sql4 . ":-" . mysqli_error($link);
    }
  }
  if (empty($_POST['state'])) {}
  else {
    $state = $_POST['state'];
    $sql5 = "UPDATE User SET UserState = '$state', DateModified = '$modify_date' WHERE UserID = $id";
    if (mysqli_query($link, $sql5)){
    }else{
      echo "Error: " . $sql5 . ":-" . mysqli_error($link);
    }
  }
  if (empty($_POST['zip'])) {}
  else {
    $zip = $_POST['zip'];
    $sql6 = "UPDATE User SET UserZipCode = '$zip', DateModified = '$modify_date' WHERE UserID = $id";
    if (mysqli_query($link, $sql6)){
    }else{
      echo "Error: " . $sql6 . ":-" . mysqli_error($link);
    }
  }
  if (empty($_POST['bname'])) {}
  else {
    $business_name = $_POST['bname'];
    $sql7 = "UPDATE Donor SET DonorCompanyName = '$business_name' WHERE UserID = $id)";
    if (mysqli_query($link, $sql7)){
    }else{
      echo "Error: " . $sql7 . ":-" . mysqli_error($link);
    }
  }
  header("location: New2UTech-DonorProfile.php");
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
    <div class="login-header">
      <h4>Logged in as: <?php echo($_SESSION["username"]); ?></h4>
        <a href="New2UTech-reset-password.php" >Reset Your Password</a>
          <br>
          <a href="New2UTech-logout.php" >Log Out</a>
    </div>
    <main>
      <h2 style="text-align:center">Edit Donor Account Profile</h2>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="new-account-form">
          <p style="text-align:center">Please contact us to edit your email address.</p><br>
          <table>
            <tr>
              <td> <label for="uname"><b>Username (email address): </b></label> </td> <td id="uname" name="uname" style="color:red"> <?php echo($_SESSION["username"]); ?> </td>
            </tr>
            <tr>
              <td> <label for="fname"><b>First Name: </b></label> </td> <td> <input type="text" id="fname" placeholder="<?php echo $first_name ?>" name="fname"></td>
            </tr>
            <tr>
              <td> <label for="lname"><b>Last Name: </b></label> </td> <td> <input type="text" id="lname" placeholder="<?php echo $last_name ?>" name="lname"></td>
            </tr>
            <tr>
              <td> <label for="bname"><b>Business Name: </b></label> </td> <td> <input type="text" id="bname" placeholder="<?php echo $don_business_name ?>" name="bname"></td>
            </tr>
            <tr>
              <td> <label for="address1"><b>Street Address: </b></label> </td> <td> <input type="text" id="address1" placeholder="<?php echo $address1 ?>" name="address1"></td>
            </tr>
            <tr>
              <td> <label for="address2"><b>Street Address 2: </b></label> </td> <td> <input type="text" id="address2" placeholder="<?php echo $address2 ?>" name="address2"></td>
            </tr>
            <tr>
              <td> <label for="city"><b>City: </b></label> </td> <td> <input type="text" id="city" placeholder="<?php echo $city ?>" name="city"></td>
            </tr>
            <tr>
              <td> <label for="state"><b>State: </b></label> </td> <td> <select id="state" name="state">
                <option value="" disabled selected hidden> <?php echo $state ?> </option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option>
              </select></td>
            </tr>
            <tr>
              <td> <label for="zip"><b>5-Digit ZIP Code: </b></label> </td> <td> <input type="text" id="zip" placeholder="<?php echo $zip ?>" name="zip" pattern="\d{5}-?(\d{4})?"></td>
            </tr>
          </table>
          <br>
          <table><tr>
            <td style="padding:1em">
              <a class="cancel-btn" href="New2UTech-DonorProfile.php">Cancel</a></td>
            <td>
              <button class="email-submit-btn" name="submit" type="submit">Update Profile</button></td>
            </tr>
            </table>
      </form>
  </main>
  <div class="separator"></div>

  <footer>
    <div class="homepage-footer">
      <a href="Home-Page.php">New2UTech</a>
    </div>
  </footer>
  </body>
</html>
