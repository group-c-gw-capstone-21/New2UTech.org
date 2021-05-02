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

$donor_update_id = $_SESSION['donor_id'];
$don_update_bus = $_SESSION['donor_bus_name'];

$result = mysqli_query($link,"SELECT * FROM Inventory WHERE DonorID = $donor_update_id AND ItemStatus = 'Available'");

?>

<!DOCTYPE html>
<html>
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
  <main>
    <table><tr><td style="text-align:center"><h2>Edit Inventory: </h2></td><td style="color:red"><h2><?php echo $don_update_bus; ?></h2></td>
      </tr></table>

      <form class="email-entry" action="" method="">
<?php
if (mysqli_num_rows($result) > 0) {
?>
<table class="donor-tbl">
	  <tr>
	  <td>Item Status</td>
		<td>Equipment Type</td>
		<td>Brand Name</td>
		<td>Item Model</td>
		<td>Serial Number</td>
		<td>Action</td>
	  </tr>
			<?php
			$i=0;
			while($row = mysqli_fetch_array($result)) {
			?>
	  <tr>
    <td><?php echo $row["ItemStatus"]; ?></td>
    <td><?php echo $row["ItemType"]; ?></td>
    <td><?php echo $row["ItemBrand"]; ?></td>
    <td><?php echo $row["ItemModel"]; ?></td>
		<td><?php echo $row["ItemSerialNumber"]; ?></td>
		<td><a href="New2UTech-UpdateDonorProcess.php?id=<?php echo $row["ItemID"]; ?>">Update</a></td>
      </tr>
			<?php
			$i++;
			}
			?>
</table>
<br>
<table><tr>
  <td>
    <a class="cancel-btn" href="New2UTech-DonorEditInventory.php">Return</a></td>
    </tr>
</table>
</form>
 <?php
}
else
{
    echo "No result found";
}
?>
</main>
 <div class="separator"></div>
 <footer>
   <div class="homepage-footer">
     <a href="New2UTech-Homepage.php">New2UTech</a>
   </div>
 </footer>
</body>
</html>
