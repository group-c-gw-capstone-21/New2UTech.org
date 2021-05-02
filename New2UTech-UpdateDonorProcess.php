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

if(count($_POST) > 0 ) {
mysqli_query($link,"UPDATE Inventory set ItemID='" . $_POST['item_id'] . "', ItemSerialNumber='" . $_POST['item_serial_number'] . "', ItemBrand='" . $_POST['item_brand'] . "' ,ItemType='" . $_POST['item_type'] . "' WHERE ItemID='" . $_POST['item_id'] . "'");
$message = "Record Modified Successfully";
}
$result = mysqli_query($link,"SELECT * FROM Inventory WHERE ItemID='" . $_GET['id'] . "'");
$row= mysqli_fetch_array($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>New2UTech</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="New2UTech-Format.v1.css" />
	<title>Update Inventory Data</title>
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
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<table>
<input type="hidden" name="item_id"  value="<?php echo $row["ItemID"]; ?>">
<tr>
  <td>
    Item Type:
  </td>
  <td>
    <select id="item_type"  name="item_type" value="<?php echo $row["ItemType"]; ?>">
      	<option value="<?php echo $row["ItemType"]; ?>" disabled selected hidden></option><option
      	value="Laptop">Laptop</option><option
      	value="PC-Tower">PC Tower</option><option value="Tablet">Tablet</option><option value="Monitor">Monitor</option><option value="Printer">Printer</option><option value="Keyboard">Keyboard</option><option
      	value="Mice">Mice</option><option
      	value="Speaker">Speaker</option><option
      	value="Webcam">Webcam</option><option value="Projecter">Projecter</option><option value="Router">Router</option><option
      	value=Switch>Switch</option><option
      	value="Hub">Hub</option><option
      	value="Server">Server</option><option
      	value="UPS">UPS Unit</option><option
      	value="Server-Rack">Server Rack</option></select>
      </td>
    </tr>
    <tr> <td> Item Brand: </td> <td> <input type="text" name="item_brand"  value="<?php echo $row["ItemBrand"]; ?>"> </td> </tr>
    <tr> <td> Item Model: </td> <td> <input type="text" name="item_model"  value="<?php echo $row["ItemModel"]; ?>">  </td>  </tr>
    <tr> <td> Serial Number: </td> <td> <input type="text" name="item_serial_number"  value="<?php echo $row["ItemSerialNumber"] ; ?>"> </td> </tr>
</table>

<table><tr>
  <td style="padding:1em">
    <a  class="cancel-btn" href="New2UTech-DonorInventoryUpdate.php">Return</a></td>
  <td>
    <button class="email-submit-btn" name="submit" type="Submit">Submit</button></td>
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
