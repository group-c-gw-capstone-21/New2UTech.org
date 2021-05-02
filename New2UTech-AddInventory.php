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

$don_add_id = $_SESSION['donor_id'];

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
      <table><tr><td style="text-align:center"><h2>Add Items to Inventory: </h2></td><td style="color:red"><h2><?php echo $_SESSION['donor_bus_name']; ?></h2></td>
        </tr>
      </table>
      <br>

      <!-- Create seperate DB connection PHP file -->
      <?php
      $fileName = $_FILES['csv_input']['tmp_name'];
      $fileSize = $_FILES['csv_input']['size'];

        if(isset($_POST['csv_button'])){
          if ($fileSize < 5000){
          }else{
            exit("Too large of a file");
          }
          $line = 1;
          if(($handle  =  fopen($fileName, "r")) !== FALSE){
            while(($row =  fgetcsv($handle)) !== FALSE){
            if($line == 1){ $line++; continue; }
              $link->query('INSERT INTO `Inventory`(`ItemType`, `ItemBrand`, `ItemModel`, `ItemSerialNumber`, `DonorID`) VALUES ("'.$row[0].'","'.$row[1].'","'.$row[2].'","'.$row[3].'","'.$don_add_id.'")');
              }
            fclose($handle);
            }
          }
          mysqli_close($link);
      ?>

      <form class="csv-file-input" action="" method="post" enctype="multipart/form-data">
          <p style="text-align:justiy">To add item descriptions to your inventory, you have two options. You can upload a Comma Separated Value (CSV) file or use the manual entry form below. CSV file uploads must be in the following format:</p>
          <p style="text-align:justiy">
            <table style="border:solid black"><tr><td style="border:solid black"> <select id="tech-type" placeholder="All Equipment Types" name="tech-type">
              <option value="" disabled selected hidden> Valid Equipment Type Entries</option><option
              value="laptops">Laptops</option><option
              value="pc-towers">PC Towers</option><option value="tablets">Tablets</option><option value="monitors">Monitors</option><option value="printers">Printers</option><option value="keyboards">Keyboards</option><option
              value="mice">Mice</option><option
              value="speakers">Speakers</option><option
              value="web-cams">Web Cams</option><option value="projecters">Projecters</option><option value="routers">Routers</option><option
              value=switches>Switches</option><option
              value="hubs">Hubs</option><option
              value="server">Servers</option><option
              value="ups">UPS Units</option><option
              value="serv-racks">Server Racks</option></select></td>
              <td style="border:solid black">Device Brand Name</td><td style="border:solid black">Device Model Number</td><td style="border:solid black">Device Serial Number (not required)</td>
              </tr>
              </table>
            </p>
            <div class="csv-input-div">
              <p>To download a template CSV: <a href="UploadInventory.csv" target="_blank"><input type="button" value = "Click Here"/></a></p>
              <label for="csv_input"><b>Upload CSV File Here: </b></label> <input type="file" id="csv_input" name="csv_input" accept=".csv" />
            </div>
            <button class="csv-submit-btn" type="submit" name="csv_button" >Upload File</button>
        </form>
        <br><br>

        <?php
        require 'New2UTech-Config.php';

        if(isset($_POST['submit'])){
          $serial_number = $_POST['serial_numbers'];
          $item_type = $_POST['tech_type'];
          $item_brand = $_POST['tech_brands'];
          $item_model = $_POST['tech_model'];
          $item_quantity = $_POST['tech_quantity'];
          if(empty($serial_number) == "TRUE" && $item_quantity > 1){
          }
          elseif(!empty($serial_number) && $item_quantity == 1){
          }
          elseif(empty($serial_number) == "TRUE" && $item_quantity == 1){
          }
          else{
            exit("Error: You cannot have a serial number if submitting more than 1 quantity");
          }
          for ($x = 1; $x <= $item_quantity; $x++){
            $sql = "INSERT INTO Inventory (ItemSerialNumber, ItemType, ItemBrand, ItemModel, DonorID, TransactionID)
            VALUES ( '$serial_number', '$item_type', '$item_brand', '$item_model', '$don_add_id',0)";
            if (mysqli_query($link, $sql)){
            }else{
              echo "Error: " . $sql . ":-" . mysqli_error($link);
            }
           }
         }
         mysqli_close($link);

        ?>
        <form class="add-inventory-form" action="" method="post">
          <table>
            <tr>
              <td> <label for="tech_type"><b>Equipment Types: </b></label> </td><td> <select  style="width:175px" id="tech_type" placeholder="All Equipment Types" name="tech_type" value="<?php echo $tech_type;?>" required>
                <option value="" disabled selected hidden> All Equipment Types</option><option value="Laptop">Laptops</option><option value="PC-Tower">PC Towers</option><option value="Tablet">Tablets</option><option value="Monitor">Monitors</option><option value="Printer">Printers</option><option value="Keyboard">Keyboards</option><option
                value="Mice">Mice</option><option
                value="Speaker">Speakers</option><option
                value="Web-Cam">Web Cams</option><option value="Projecter">Projecters</option><option value="Router">Routers</option><option value=switch>Switches</option><option
                value="Hub">Hubs</option><option
                value="Server">Servers</option><option
                value="UPS">UPS Units</option><option
                value="Server Rack">Server Racks</option></select>
              </td>
            </tr>
            <tr>
              <td> <label for="tech_brands"><b>Brand Name: </b></label> </td> <td> <input type="text" id="tech_brands" placeholder="Enter Device Brand Name" name="tech_brands" value="<?php echo $tech_brands;?>" required></td>
            </tr>
            <tr>
              <td> <label for="tech_model"><b>Model Number: </b></</label> </td> <td> <input type="tech_model" id="tech_model" placeholder="Enter Model Number" name="tech_model" value="<?php echo $tech_model;?>" required></td>
            </tr>
            <tr>
              <td> <label for="serial_numbers"><b>Serial Number: </b></label> </td> <td> <input type="text" id="serial_numbers" placeholder="Enter Serial Number" name="serial_numbers" value="<?php echo $serial_numbers;?>"></td>
            </tr>
            <tr>
              <td> <label for="tech_quantity"><b>Quantity: </b></label> </td> <td> <input type="number" id="tech_quantity" value="1" name="tech_quantity"></td>
            </tr>
          </table>
          <br>
          <button class="email-reset-btn" type="reset" name="reset">Reset</button>
          <button class="email-submit-btn" type="submit" name="submit" onclick="clearform();">Submit</button>
      </form>
      <br>
      <a class="view-inventory-btn" href="New2UTech-DonorInventory.php">View Inventory</a>
  </main>
  <div class="separator"></div>
  <footer>
    <div class="homepage-footer">
      <a href="New2UTech-Homepage.php">New2UTech</a>
    </div>
  </footer>
  </body>
</html>
