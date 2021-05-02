<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: New2UTech-login.php");
    exit;
}

// Include config file
require 'New2UTech-Config.php';

$donor_request_id = $_SESSION['donor_id'];
$don_claims_bus = $_SESSION['donor_bus_name'];
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>New2UTech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="New2UTech-Format.v1.css" />
    <script src="test.js"></script>
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
      <table><tr><td style="text-align:center"><h2>Edit Inventory: </h2></td><td style="color:red"><h2><?php echo $don_claims_bus; ?></h2></td>
        </tr></table>
      <form class="email-entry" action="New2UTech-DonorConfirmClaims.php" method="post">
          <table class="donor-tbl">
            <tr>
              <th>
                <input type="checkbox" name="box" value="" style="display:none" >
              </th>
              <th> Item Status </th>
              <th> Equipment Type </th>
              <th> Brand Name </th>
              <th> Model </th>
              <th> Serial Number </th>
              <th> Non-Profit </th>
            </tr>
            <tr>

              <?php

              // Prepare a select statement
              $sql = "SELECT * FROM Inventory JOIN Non_Profit ON Inventory.NPID = Non_Profit.NPID WHERE DonorID = $donor_request_id";

              $result = mysqli_query($link, $sql);
            // output result

                if ($result -> num_rows > 0){
                  while ($row = $result -> fetch_assoc() ){
                    if ($row["ItemStatus"] == "Pending"){
                      echo '<tr>';
                      echo '<td>';
                      echo "<input type='checkbox' value='".$row["ItemID"]."' name='id[]' >";
                      echo '</td>' ;
                      echo '<td>' . $row["ItemStatus"] . '</td>' ;
                      echo '<td>' . $row["ItemType"] . '</td>' ;
                      echo '<td>' . $row["ItemBrand"] . '</td>' ;
                      echo '<td>' . $row["ItemModel"] . '</td>' ;
                      echo '<td>' . $row["ItemSerialNumber"] . '</td>' ;
                      echo '<td>' . $row["NPCompanyName"] . '</td>' ;
                      echo '</tr>';
                    }
                  }
                }
              mysqli_close($resulting);
              ?>

            </tr>
          </table>
          <br>
          <table><tr>
            <td>
              <a class="cancel-btn" href="New2UTech-DonorProfile.php">Cancel</a></td>
              <td>
                <button class="npo-search-inventory-btn" type="submit" name="decline" onclick="return confirm('Are you sure you would like to decline the selected requests?');">Decline</button></td>
								<td>
	              <button class="email-submit-btn" type="submit" name="approve" onclick="return confirm('Are you sure you would like to approve the selected requests?');">Approve</button></td>
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
