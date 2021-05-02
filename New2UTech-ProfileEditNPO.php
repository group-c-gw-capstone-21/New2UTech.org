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
  header("location: New2UTech-ProfileNPO.php");
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
      <h2 style="text-align:center">Edit Non-Profit Account Profile</h2>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="new-account-form">
        <p style="text-align:center">Please contact us to edit your email address, business name, and/or EIN/TIN.</p><br>
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
              <td> <label for="bname"><b>Business Name: </b></label> </td> <td id="bname" name="bname" style="color:red"> <?php echo $npo_official_bus_name ?> </td>
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
              <td> <label for="state"><b>State: </b></label> </td> <td> <select id="state" placeholder="Select State" name="state">
                <option value="" disabled selected hidden> <?php echo $state ?> </option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option>
              </select></td>
            </tr>
            <tr>
              <td> <label for="zip"><b>5-Digit ZIP Code: </b></label> </td> <td> <input type="text" id="zip" placeholder="<?php echo $zip ?>" name="zip" pattern="\d{5}-?(\d{4})?"></td>
            </tr>
            <tr>
              <td> <label for="tin-ein"><b>Non-Profit TIN / EIN: </b></label> </td> <td id="tin-ein" name="tin-ein" style="color:red">  <?php echo $npo_ein_tin ?> </td>
            </tr>
          </table>
          <br>
          <table><tr>
            <td style="padding:1em">
              <a class="cancel-btn" href="New2UTech-ProfileNPO.php">Cancel</a></td>
            <td>
              <button class="email-submit-btn" name="submit" type="submit">Update Profile</button></td>
            </tr>
            </table>
        <!-- </div> -->

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
