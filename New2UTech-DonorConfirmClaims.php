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

$don_claims_name = $_SESSION['donor_bus_name'];
$don_email = $_SESSION["username"];

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

        <?php
        if (isset($_POST['approve'])){
          echo '<center>
                  This is the email that each Non-profit will receive. <br>
                  The production version will deliver a custom email to each Non-profit<br>
                  (similiar to the current configuration when a Non-profit executes claim requests, each donor receives a custom email):
                </center>
          <form class="email-entry" action="#" method="post">
                <p style="text-align: left">
                  Dear [non-profit name],<br>
                  <br>We have an update concerning items, which you requested to claim on the New2UTech web portal!<br>
                  <br>The following items were approved by '.$don_claims_name.':<br>
                </p>
                <table class="npo-search-resuts-tbl">
                  <tr>
                    <th> Equipment Type </th>
                    <th> Brand Name </th>
                    <th> Model </th>
                    <th> Serial Number </th>
                  </tr>';

        				foreach ($_POST['id'] as $id):
                $sq=mysqli_query($link,"SELECT ItemType,ItemBrand, ItemModel, ItemSerialNumber, ItemStatus, ItemID
                FROM Inventory JOIN Transaction ON Inventory.TransactionID = Transaction.TransactionID WHERE ItemID='$id'");
        				$srow=mysqli_fetch_array($sq);
                    echo '<tr>';
                    echo '<td>' . $srow["ItemType"] . '</td>' ;
                    echo '<td>' . $srow["ItemBrand"] . '</td>' ;
                    echo '<td>' . $srow["ItemModel"] . '</td>' ;
                    echo '<td>' . $srow["ItemSerialNumber"] . '</td>' ;
                    echo '</tr>';
        		     endforeach;
                 echo '</table>';
                 foreach ($_POST['id'] as $id):
                    $sql= ("UPDATE Inventory,Transaction SET Inventory.ItemStatus = 'Claimed', Transaction.TransactionStatus = 'Completed'
                      WHERE Inventory.TransactionID = Transaction.TransactionID AND ItemID ='$id'");
                  $run=mysqli_query($link, $sql);
                  endforeach;
                 mysqli_close($run);
                 echo '<p style="text-align: left">Please contact the following email address to make arrangements to retrieve the equipment: '.$don_email.'
                 <br><br>Sincerely,<br><br>New2UTech</p>
                 <a class="update-inventory-view-btn" href="New2UTech-Donate.php">Return</a></td>
                 </form>';

                 echo '<center><br><br>
                   This is the email that the logged-in Donor will receive: <br>
                 </center>';

                 echo '<form class="email-entry" action="#" method="post">
                       <p style="text-align: left">
                         Dear '.$don_claims_name.',<br>
                         <br>Thank you for using the New2UTech web portal and approving the following items to be retrieved:<br>
                       </p>
                       <table class="npo-search-resuts-tbl">
                         <tr>
                         <th> Non-Profit Name </th>
                         <th> Non-Profit TIN/EIN </th>
                           <th> Equipment Type </th>
                           <th> Brand Name </th>
                           <th> Model </th>
                           <th> Serial Number </th>
                         </tr>';

                       foreach ($_POST['id'] as $id):
                       $sq=mysqli_query($link,"SELECT ItemType,ItemBrand, ItemModel, ItemSerialNumber, ItemStatus, ItemID
                       FROM Inventory JOIN Transaction ON Inventory.TransactionID = Transaction.TransactionID WHERE ItemID='$id'");
                       $srow=mysqli_fetch_array($sq);

                       $query_result = mysqli_query($link, "SELECT TIN_EIN, NPCompanyName FROM Non_Profit JOIN Inventory ON Non_Profit.NPID = Inventory.NPID
                       WHERE ItemID='$id'");
                       while($data = mysqli_fetch_array($query_result))
                       {
                         $np_tax_id = $data['TIN_EIN'];
                         $np_tax_name = $data['NPCompanyName'];
                           echo '<tr>';
                           echo '<td>' . $np_tax_name . '</td>' ;
                           echo '<td>' . $np_tax_id . '</td>' ;
                           echo '<td>' . $srow["ItemType"] . '</td>' ;
                           echo '<td>' . $srow["ItemBrand"] . '</td>' ;
                           echo '<td>' . $srow["ItemModel"] . '</td>' ;
                           echo '<td>' . $srow["ItemSerialNumber"] . '</td>' ;
                           echo '</tr>';
                         }
                        endforeach;
                        echo '</table>';
                        foreach ($_POST['id'] as $id):
                           $sql= ("UPDATE Inventory,Transaction SET Inventory.ItemStatus = 'Claimed', Transaction.TransactionStatus = 'Completed'
                             WHERE Inventory.TransactionID = Transaction.TransactionID AND ItemID ='$id'");
                         $run=mysqli_query($link, $sql);
                         endforeach;


                        mysqli_close($run);
                        echo '<p style="text-align: left">For your tax records, you can find the Tax Identification Number(TIN) or Employer Identification Number(EIN) of the Non-profit organization(s) listed on the table above.<br>
                        <br>Regarding retrieval of your equipment, you should expect an email from each Non-profit organization that you approved a claim request with. The Non-profit organizations are responsible for making arrangements to retreive the equipment.<br>
                        <br>Thank you for using New2UTech!
                        <br><br>Sincerely,<br><br>New2UTech</p>
                        <a class="update-inventory-view-btn" href="New2UTech-Donate.php">Return</a></td>
                        </form>';
              }
           ?>
					 <?php
 	        if (isset($_POST['decline'])){
                   echo '<center>
                           This is the email that each Non-profit will receive. <br>
                           The production version will deliver a custom email to each Non-profit<br>
                           (similiar to the current configuration when a Non-profit executes claim requests, each donor receives a custom email):
                         </center>
                   <form class="email-entry" action="#" method="post">
                         <p style="text-align: left">
                           Dear [non-profit name],<br>
                           <br>We have an update concerning items, which you requested to claim on the New2UTech web portal!<br>
                           <br>The following items were not approved to be retrieved:<br>
                         </p>
                         <table class="npo-search-resuts-tbl">
                           <tr>
                             <th> Equipment Type </th>
                             <th> Brand Name </th>
                             <th> Model </th>
                             <th> Serial Number </th>
                           </tr>';

                 				foreach ($_POST['id'] as $id):
                          $sq=mysqli_query($link,"SELECT ItemType,ItemBrand, ItemModel, ItemSerialNumber, ItemStatus, ItemID
                          FROM Inventory WHERE ItemID='$id'");
                 				$srow=mysqli_fetch_array($sq);
                             echo '<tr>';
                             echo '<td>' . $srow["ItemType"] . '</td>' ;
                             echo '<td>' . $srow["ItemBrand"] . '</td>' ;
                             echo '<td>' . $srow["ItemModel"] . '</td>' ;
                             echo '<td>' . $srow["ItemSerialNumber"] . '</td>' ;
                             echo '</tr>';
                 		     endforeach;
                          echo '</table>';
                          foreach ($_POST['id'] as $id):

                             $sql= ("UPDATE Inventory,Transaction SET Inventory.NPID = 0, Inventory.TransactionID = 0, Inventory.ItemStatus = 'Available', Transaction.TransactionStatus = 'Not Approved'
                               WHERE Inventory.TransactionID = Transaction.TransactionID AND ItemID ='$id'");


                           $run=mysqli_query($link, $sql);
                           endforeach;
                          mysqli_close($run);
                          echo '<p style="text-align: left">We welcome you to perform more searches on the New2UTech web portal for other item(s) that may be available and still meets your needs.
                          <br><br>Thank you for your business and we hope to work with you again in the future!
                          <br><br>Sincerely,<br><br>New2UTech</p>
                          <a class="update-inventory-view-btn" href="New2UTech-Donate.php">Return</a></td>
                          </form>';
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
