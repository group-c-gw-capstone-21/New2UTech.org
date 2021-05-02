
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

//User submits profile information
if(isset($_POST['submit']))
{
  $first_name = $_POST['fname'];
  $last_name = $_POST['lname'];
  $business_name = $_POST['bname'];
  $address1 = $_POST['address1'];
  $address2 = $_POST['address2'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zip = $_POST['zip'];
  $id = $_SESSION['id'];
  $modify_date = date('Y/m/d h:i:s a', time());

  //prepare sql statement, connect and submit to the database
  $sql = "UPDATE User SET UserFirstName = '$first_name', UserLastName = '$last_name', UserAddress = '$address1', UserAddress2 = '$address2', UserCity = '$city', UserState = '$state', UserZipCode = '$zip', DateModified = '$modify_date' WHERE UserID = $id";

  if (mysqli_query($link, $sql)){
  }else{
    echo "Error: " . $sql . ":-" . mysqli_error($link);
  }
    $sql1 = "INSERT INTO Donor (DonorCompanyName, UserID) VALUES ( '$business_name', $id)";
    if (mysqli_query($link, $sql1)){
      header("location: New2UTech-DonorProfile.php");
      mysqli_close($link);
    }else{
      echo "Error: " . $sql1 . ":-" . mysqli_error($link);
    }
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
      <h2 style="text-align:center">Create New Donor Account: Enter Profile</h2>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="new-account-form">
        <p style="text-align:justify">Thank you for verifying your email address. Please submit your user account information below.</p><br>
          <table>
            <tr>
              <td> <label for="uname"><b>Username (email address): </b></label> </td> <td id="uname" name="uname" style="color:red"> <?php echo($_SESSION["username"]); ?> </td>
            </tr>
            <tr>
              <td> <label for="fname"><b>First Name: </b></label> </td> <td> <input type="text" id="fname" placeholder="Enter First Name" name="fname" required></td>
            </tr>
            <tr>
              <td> <label for="lname"><b>Last Name: </b></label> </td> <td> <input type="text" id="lname" placeholder="Enter Last Name" name="lname" required></td>
            </tr>
            <tr>
              <td> <label for="bname"><b>Business Name: </b></label> </td> <td> <input type="text" id="bname" placeholder="Enter Business Name" name="bname" required></td>
            </tr>
            <tr>
              <td> <label for="address1"><b>Street Address: </b></label> </td> <td> <input type="text" id="address1" placeholder="Enter Street Address" name="address1" required></td>
            </tr>
            <tr>
              <td> <label for="address2"><b>Street Address 2: </b></label> </td> <td> <input type="text" id="address2" placeholder="Enter Street Address 2" name="address2"></td>
            </tr>
            <tr>
              <td> <label for="city"><b>City: </b></label> </td> <td> <input type="text" id="city" placeholder="Enter City" name="city" required></td>
            </tr>
            <tr>
              <td> <label for="state"><b>State: </b></label> </td> <td> <select id="state" placeholder="Select State" name="state" required>
                <option value="" disabled selected hidden> Select State...</option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option>
              </select></td>
            </tr>
            <tr>
              <td> <label for="zip"><b>5-Digit ZIP Code: </b></label> </td> <td> <input type="text" id="zip" placeholder="Enter ZIP Code" name="zip" pattern="\d{5}-?(\d{4})?" required></td>
            </tr>
          </table>
          <br>
          <button name="submit" class="email-submit-btn" type="submit">Submit</button>
          <label>
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
