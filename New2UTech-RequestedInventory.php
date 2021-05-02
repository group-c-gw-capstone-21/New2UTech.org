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

$npid = $_SESSION['npid'];

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
       <h2 style="text-align:center">Proof of Concept: Email Deliveries</h2>
       <center>
         This is the email that Donors will receive:

     </center>

<?php
if (isset($_POST['submit'])){
    $item_array = array();
    $donid_array = array();

        foreach ($_POST['id'] as $id):
          $sq=mysqli_query($link,"SELECT Donor.DonorID, Donor.DonorCompanyName, Inventory.ItemType, Inventory.ItemBrand, Inventory.ItemModel, Inventory.ItemSerialNumber, Inventory.ItemStatus, Inventory.ItemID
          FROM Inventory JOIN Donor ON Inventory.DonorID=Donor.DonorID
          WHERE ItemID='$id'");
  				$srow=mysqli_fetch_array($sq);
                array_push($item_array, $srow["ItemID"]);
                array_push($donid_array, $srow["DonorID"]);
				endforeach;

        $arrlength = count($item_array);
        $unique_donid_array = array_unique($donid_array, SORT_NUMERIC);
        $filter_donid_array = array_filter($unique_donid_array);
        $length_unique_donid_array = count($unique_donid_array);

        for($y = 0; $y < $arrlength; $y++) {
          $trans_query1 = "UPDATE Inventory SET NPID = $npid, ItemStatus = 'Pending' WHERE ItemID = $item_array[$y]";
              if (mysqli_query($link, $trans_query1)){}
              else{
                echo "Error: " . $trans_query1 . ":-" . mysqli_error($link);
              }
        }

        for($x = 0; $x <= $arrlength; $x++) {
          $donor_id = $filter_donid_array[$x];
          if ($donor_id == 0){}
          else{
          $trans_query = "INSERT INTO Transaction (NPID, DonorID) VALUES ('$npid', '$donor_id')";
              if (mysqli_query($link, $trans_query)){
                $last_id1 = mysqli_insert_id($link);

                $trans_query3 = "UPDATE Inventory SET TransactionID = '$last_id1' WHERE NPID = $npid AND DonorID = $donor_id AND ItemStatus = 'Pending'";
                if (mysqli_query($link, $trans_query3)){

                  $query_result = mysqli_query($link, "SELECT DonorCompanyName FROM Donor WHERE DonorID = $donor_id");
                  while($data = mysqli_fetch_array($query_result))
                  {
                    $don_company_name = $data['DonorCompanyName'];
                  echo
                    "<form class='email-entry' action='#' method='post'>
                    <p style='text-align: left'>
                      Greetings ".$don_company_name.", <br>
                      This is a request from the New2UTech web portal!<br>
                      The following items have been requested for pickup.<br>
                    </p>
                    <table class='npo-search-resuts-tbl'>
                       <tr>
                         <th> Equipment Type </th>
                         <th> Brand Name </th>
                         <th> Model </th>
                         <th> Serial Number </th>
                         <th> Non-Profit Company Name</th>
                         <th> Item ID </th>
                       </tr>";
                     }

                       $sqly = "SELECT Non_Profit.NPCompanyName, Inventory.ItemType, Inventory.ItemBrand, Inventory.ItemModel, Inventory.ItemSerialNumber, Inventory.ItemStatus, Inventory.ItemID
                       FROM Inventory JOIN Non_Profit ON Inventory.NPID=Non_Profit.NPID WHERE Inventory.TransactionID = '$last_id1'";
                       $results = mysqli_query($link, $sqly);
                       $i=0;
                       while($row=mysqli_fetch_assoc($results))
                       {
                         $type[$i] = $row['ItemType'];
                         $brand[$i] = $row['ItemBrand'];
                         $model[$i] = $row['ItemModel'];
                         $serial[$i] = $row['ItemSerialNumber'];
                         $status[$i] = $row['NPCompanyName'];
                         $itemid[$i] = $row['ItemID'];
                         $i++;
                       }

                       // Loop through the results from the database
                       for ($i = 0; $i <=count($itemid); $i++)
                       {
                           echo
                               "<tr>
                               <td>".$type[$i]."</td>
                               <td>".$brand[$i]."</td>
                               <td>".$model[$i]."</td>
                               <td>".$serial[$i]."</td>
                               <td>".$status[$i]."</td>
                               <td>".$itemid[$i]."</td>
                              </tr></table>";
                       }
                  echo '<p style="text-align: left">
                           Please login to the New2UTech web portal to accept this request<br>
                           <a href="New2UTech-login.php">New2UTech</a> <br>
                           Thank you!</p></form><br>';
                }
                else{
                  echo "Error: " . $trans_query3 . ":-" . mysqli_error($link);
                }
              }
              else{
                echo "Error: " . $trans_query . ":-" . mysqli_error($link);
              }
            }
        }

        echo'<br><br>
        <center>
          This is the email that the NPO will receive:
        </center>
        <form class="email-entry" action="#" method="post">
          <p style="text-align: left">
            Greetings,<br>
            Thank you for using the New2UTech web portal!<br>
            The following items were requested for pickup.<br>
         </p>
         <table class="npo-search-resuts-tbl">
          <tr>
            <th> Equipment Type </th>
            <th> Brand Name </th>
            <th> Model </th>
            <th> Serial Number </th>
            <th> Donor Company Name</th>
            <th> Item ID </th>
          </tr>';

        foreach ($_POST['id'] as $id):
          $squery=mysqli_query($link,"SELECT Donor.DonorCompanyName, Inventory.ItemType, Inventory.ItemBrand, Inventory.ItemModel, Inventory.ItemSerialNumber, Inventory.ItemStatus, Inventory.ItemID
          FROM Inventory JOIN Donor ON Inventory.DonorID=Donor.DonorID
          WHERE ItemID='$id'");
          $srows=mysqli_fetch_array($squery);
          echo '<tr>';
          echo '<td>' . $srows["ItemType"] . '</td>' ;
          echo '<td>' . $srows["ItemBrand"] . '</td>' ;
          echo '<td>' . $srows["ItemModel"] . '</td>' ;
          echo '<td>' . $srows["ItemSerialNumber"] . '</td>' ;
          echo '<td>' . $srows["DonorCompanyName"] . '</td>' ;
          echo '<td>' . $srows["ItemID"] . '</td>' ;
          echo '</tr>';

          $claimID = $srows["ItemID"];
          $sql = "UPDATE Inventory SET ItemStatus = 'Pending', NPID = '$npid' WHERE ItemID = $claimID";
          if (mysqli_query($link, $sql)){
          }else{
            echo "Error: " . $sql . ":-" . mysqli_error($link);
          }
        endforeach;
			}
      mysqli_close($link);
   ?>

 </table>
    <br><p style='text-align: left'>
       The Donor(s) of the requested items are required to accept your request before you can schedule to retrieve any equipment.<br>
       You will be notified via email if any of your requests are accepted.<br>
       <br>Thank you,<br>
       New2UTech
      </p><br>
            <a class="npo-continue-btn" href="New2UTech-Donate.php">Continue</a>
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
