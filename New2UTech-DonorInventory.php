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
      <table><tr><td style="text-align:center"><h2>Inventory: </h2></td><td style="color:red"><h2><?php echo $_SESSION['donor_bus_name']; ?></h2></td>
        </tr></table>

          <table class="donor-tbl">
            <th>Equipment Types</th>
            <th>Brands</th>
            <th>Models</th>
            <th>Serial Numbers</th>
            <th>Item Status</th>
            <tr>
              <?php
              $don_id = $_SESSION['donor_id'];
              $test="SELECT * FROM Inventory WHERE DonorID = $don_id";
              $resulting = mysqli_query($link,$test);
              $i=1;
              while($row=mysqli_fetch_assoc($resulting))
              {
                  $itemid[$i] = $row['ItemID'];
                  $serial[$i] = $row['ItemSerialNumber'];
                  $type[$i] = $row['ItemType'];
                  $brand[$i] = $row['ItemBrand'];
                  $model[$i] = $row['ItemModel'];
                  $status[$i] = $row['ItemStatus'];
                  $donor[$i] = $row['DonorID'];
                  $i++;
              }

              // Loop through the results from the database
              for ($i = 1; $i <=count($itemid); $i++)
              {
                  echo
                      "<tr>
                      <td>".$type[$i]."</td>
                      <td>".$brand[$i]."</td>
                      <td>".$model[$i]."</td>
                      <td>".$serial[$i]."</td>
                      <td>".$status[$i]."</td>
                      </tr>";
              }
              mysqli_close($resulting);
              ?>

            </tr>
          </table>
          <br>
          <table>
            <tr>
              <td>
                <a class="add-inventory-btn" href="New2UTech-AddInventory.php">Add Inventory</a></td>
                <td>
                  <a class="edit-inventory-btn" href="New2UTech-DonorEditInventory.php">Edit Inventory</a></td>
                  <td>
                    <form action="New2UTech-Export.php" method="post">
                    <button class="export-inventory-report-btn" type="submit" name="export">Export Inventory Report</button></td>
                  </form>
            </tr>
          </table>
  </main>
  <div class="separator"></div>
  <footer>
    <div class="homepage-footer">
      <a href="New2UTech-Homepage.php">New2UTech</a>
    </div>
  </footer>
  </body>
</html>
