<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: New2UTech-login.php");
    exit;
}

include 'New2UTech-Config.php';

  if(isset($_POST['submit'])){
    $npo_entered_bus_name = strtolower($_POST['npo_bus_name']);
    if ($_SESSION["npo_name"] == $npo_entered_bus_name) {
      $npo_ein_tin = $_SESSION['ein_tin'];
      $npo_official_bus_name = $_SESSION["npo_name"];
      $id = $_SESSION['id'];
      $sql = "INSERT INTO Non_Profit (NPCompanyName, TIN_EIN, UserID) VALUES ( '$npo_official_bus_name', $npo_ein_tin, $id)";
      if (mysqli_query($link, $sql)){
        header("location: New2UTech-NewAccountNPO.php");
      }
      else{
        echo "Error: " . $sql . ":-" . mysqli_error($link);
      }
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
  <div class="login-header">
    <h4>Logged in as: <?php echo($_SESSION["username"]); ?></h4>
      <a href="New2UTech-reset-password.php" >Reset Your Password</a>
        <br>
        <a href="New2UTech-logout.php" >Log Out</a>
  </div>
  <center>
    <h2>Verify Non-Profit Status</h2>
  <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>"style="border: solid 2px; width: 50%">
<?php
    echo "EIN/TIN Number: ".$_SESSION['ein_tin'];
    echo "<br>";
    $npo_entered_bus_name = strtolower($_SESSION['npo_bus_name']);
    // first time try is successful - enter data into database and proceed to new account page
    if ($_SESSION["npo_name"] == $npo_entered_bus_name) {
      $npo_ein_tin = $_SESSION['ein_tin'];
      $npo_official_bus_name = $_SESSION["npo_name"];
      $id = $_SESSION['id'];
      $sql = "INSERT INTO Non_Profit (NPCompanyName, TIN_EIN, UserID) VALUES ( '$npo_official_bus_name', $npo_ein_tin, $id)";
      if (mysqli_query($link, $sql)){
        header("location: New2UTech-NewAccountNPO.php");
      }
      else{
        echo "Error: " . $sql . ":-" . mysqli_error($link);
      }
      mysqli_close($link);
    }
    // first try unsuccessful loop to allow the user an opportunity to enter the correct information
    else {
      $count = 0;
      while ($count < 1) {
        echo "The non-profit business name that you entered is not associated with the EIN/TIN that you entered. <br> Please double check the spelling and try again.";
        echo "Business Name: <input name='npo_bus_name' id='npo_bus_name' type='text' required /><br /><button name='submit' type='submit'> Submit Business Name</button>";
        echo "<button style='background-color: #00b3b3;'  href='New2UTech-VerifyAPI.php'>Click here to re-enter EIN/TIN</button>";
        $count++;
      }
    }
?>
</form>
  </center>
  <div class="separator"></div>
  <footer>
    <div class="homepage-footer">
      <a href="New2UTech-Homepage.php">New2UTech</a>
    </div>
  </footer>
</body>
</html>
