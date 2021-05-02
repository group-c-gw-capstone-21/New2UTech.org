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

$np_trans_id = $_SESSION['npid'];

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
      <h2 style="text-align:center">Non-Profit Previous Transactions</h2>

      <form class="email-entry" action="New2UTech-RequestedInventory.php" method="post">

          <table class="npo-search-resuts-tbl">
            <tr>
              <th> Transaction Status </th>
              <th> Equipment Type </th>
              <th> Brand Name </th>
              <th> Model </th>
              <th> Serial Number </th>
              <th> Item ID </th>
              <th> Donor's Company Name</th>
            </tr>

            <?php

              // Prepare a select statement
              $sql = "SELECT Transaction.TransactionStatus, Inventory.ItemType, Inventory.ItemBrand, Inventory.ItemModel, Inventory.ItemSerialNumber, Inventory.ItemID, Donor.DonorCompanyName
              FROM Inventory JOIN Donor ON Inventory.DonorID=Donor.DonorID JOIN Transaction ON Transaction.TransactionID=Inventory.TransactionID
              WHERE Transaction.NPID = $np_trans_id AND Transaction.TransactionStatus = 'Completed'";

              $result = mysqli_query($link, $sql);
            // output result

                if ($result -> num_rows > 0){
                  while ($row = $result -> fetch_assoc() ){
                      echo '<tr>';
                      echo '<td>' . $row["TransactionStatus"] . '</td>' ;
                      echo '<td>' . $row["ItemType"] . '</td>' ;
                      echo '<td>' . $row["ItemBrand"] . '</td>' ;
                      echo '<td>' . $row["ItemModel"] . '</td>' ;
                      echo '<td>' . $row["ItemSerialNumber"] . '</td>' ;
                      echo '<td>' . $row["ItemID"] . '</td>' ;
                      echo '<td>' . $row["DonorCompanyName"] . '</td>' ;
                      echo '</tr>';
                  }
                  mysqli_close($link);
                }
            ?>
          </table>
          <br>
          <table><tr>
              <td>
                <a class="npo-profile-btn" href="New2UTech-ProfileNPO.php">View Profile</a></td>
                <td>
                  <td>
                    <form action="New2UTech-Export.php" method="post">
                    <button class="export-inventory-report-btn" type="submit" name="export">Export Transactions</button></td>

                  </form></tr>
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
