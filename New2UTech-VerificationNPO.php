<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: New2UTech-login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>New2UTech</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="New2UTech-Format.v1.css" />
  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <!-- call javascript function to pull api data, verify its legitimacy, and present the results below in the body of the html  -->
  <script>
  function submit_soap(){
    var ip=$("#ip_address").val();
    $.get("New2UTech-VerifyAPI.php", {ip:ip}, function(data){$("#json_response").html(data);});
  }
  </script>

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
    <div id="json_response" style="border: solid 2px; width: 50%"></div>
    <!-- basic form to acquire user input ... ein/tin and business name -->
    <form style="border: solid 2px; width: 50%">
      <p style="text-align:justify">To create a non-profit account, you must first verify your non-profit status. Please submit your Tax Identification Number (TIN) or Employee Identification Number (EIN) and the name of your non-profit exactly how it is spelled according to the United States (U.S.) Internal Revenue Services (IRS).</p><br>
      EIN/TIN Number: <input name="ip_address" id="ip_address" type="text" required /><br />
      <input type="button" value="Submit" onclick="submit_soap()"/>
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
