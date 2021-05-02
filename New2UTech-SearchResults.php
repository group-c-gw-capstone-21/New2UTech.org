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

if(isset($_POST['submit']))
  {
    $don_comp_name = $_POST['don_comp_name'];
    $tech_type = $_POST['tech_type'];
    $tech_brands = $_POST['tech_brands'];
    $tech_model = $_POST['tech_model'];
    $serial_numbers = $_POST['serial_numbers'];
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
      <h2 style="text-align:center">Non-Profit Search Inventory Results</h2>
      <center>
      <a class="npo-search-again-btn" href ="New2UTech-SearchInventory.php">Click here to submit another search.</a>
    </center>

      <form class="email-entry" action="New2UTech-RequestedInventory.php" method="post">

          <table class="npo-search-resuts-tbl">
            <tr>
              <th> Claim Item? </th>
              <th> Item Status </th>
              <th> Donor's Company Name</th>
              <th> Equipment Type </th>
              <th> Brand Name </th>
              <th> Model </th>
              <th> Serial Number </th>
              <th> Item ID </th>
            </tr>

            <?php

              // Prepare a select statement
              $sql = "SELECT Donor.DonorCompanyName, Inventory.ItemType, Inventory.ItemBrand, Inventory.ItemModel, Inventory.ItemSerialNumber, Inventory.ItemStatus, Inventory.ItemID
              FROM Inventory JOIN Donor ON Inventory.DonorID=Donor.DonorID
              WHERE Donor.DonorCompanyName LIKE '$don_comp_name%' AND
              ItemType LIKE '$tech_type%' AND
              ItemBrand LIKE '$tech_brands%' AND
              ItemModel LIKE '$tech_model%' AND
              ItemSerialNumber LIKE '$serial_numbers%' AND
              ItemID LIKE '$itemID%'
              ";

              $result = mysqli_query($link, $sql);
            // output result

                if ($result -> num_rows > 0){
                  while ($row = $result -> fetch_assoc() ){
                    if ($row["ItemStatus"] == "Available"){
                      echo '<tr>';
                      echo '<td>';
                      echo "<input type='checkbox' value='".$row["ItemID"]."' name='id[]' >";
                      echo '</td>' ;
                      echo '<td>' . $row["ItemStatus"] . '</td>' ;
                      echo '<td>' . $row["DonorCompanyName"] . '</td>' ;
                      echo '<td>' . $row["ItemType"] . '</td>' ;
                      echo '<td>' . $row["ItemBrand"] . '</td>' ;
                      echo '<td>' . $row["ItemModel"] . '</td>' ;
                      echo '<td>' . $row["ItemSerialNumber"] . '</td>' ;
                      echo '<td>' . $row["ItemID"] . '</td>' ;
                      echo '</tr>';
                    }
                  }
                }
            ?>
          </table>
          <br>
          <button name = "submit" class="npo-claim-request-btn" type="submit">Submit Claim Request</button>
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
