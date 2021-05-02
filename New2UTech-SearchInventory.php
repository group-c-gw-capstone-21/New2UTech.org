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
      <h2 style="text-align:center">Non-Profit Search Inventory</h2>

      <form class="new-account-form" action="New2UTech-SearchResults.php" method="post">
          <p style="text-align:justify">Please enter your search parameters below. You do not need to enter a value for each search parameter. If you do not enter any search criteria, the results will yield all available equipment.</p><br>
          <br>
          <table>
            <tr>
              <td> <label for="donor_company_name"><b>Donor's Company Name: </b></label> </td> <td> <input type="text" id="don_comp_name" placeholder="Enter Company Name" name="don_comp_name" ></td>
            </tr>
            <tr>
              <td> <label for="tech_type"><b>Equipment Type: </b></label> </td>
              <td> <select  style="width:175px" id="tech_type" placeholder="All Equipment Types" name="tech_type">
                <option value="" disabled selected hidden> All Equipment Types</option>
                <option value="laptop">Laptops</option>
                <option value="pc-tower">PC Towers</option>
                <option value="tablet">Tablets</option>
                <option value="monitor">Monitors</option>
                <option value="printer">Printers</option>
                <option value="keyboard">Keyboards</option>
                <option value="mouse">Mice</option>
                <option value="speaker">Speakers</option>
                <option value="web-cam">Web Cams</option>
                <option value="projecter">Projecters</option>
                <option value="router">Routers</option>
                <option value="switch">Switches</option>
                <option value="hub">Hubs</option>
                <option value="server">Servers</option>
                <option value="UPS">UPS Units</option>
                <option value="serv-rack">Server Racks</option></select>
              </td>
            </tr>
            <tr>
              <td> <label for="tech_brands"><b>Brand Name: </b></label> </td> <td> <input type="text" id="tech_brands" placeholder="Enter Device Brand Name" name="tech_brands" ></td>
            </tr>
            <tr>
              <td> <label for="tech_model"><b>Model Number: </b></label> </td> <td> <input type="tech_model" id="tech_model" placeholder="Enter Model Number" name="tech_model"></td>
            </tr>
            <tr>
              <td> <label for="serial_numbers"><b>Serial Number: </b></label> </td> <td> <input type="text" id="serial_numbers" placeholder="Enter Serial Number" name="serial_numbers"></td>
            </tr>
          </table>
          <br>
      <table><tr>
        <td>
          <a class="cancel-btn" href="New2UTech-ProfileNPO.php">Cancel</a></td>
          <td>
            <a class="npo-profile-btn" href="New2UTech-ProfileNPO.php">View Profile</a></td>
            <td>
            <button class="search-btn" type="submit" name="submit">Submit Search</button></td>
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
