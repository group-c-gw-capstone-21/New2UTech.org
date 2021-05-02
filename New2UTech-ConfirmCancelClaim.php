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

$donor_del_id = $_SESSION['donor_id'];
$npid_claims_id = $_SESSION['npid'];
$npid_bus_name = $_SESSION['npid_bus_name'];


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
       <h3 style="text-align:center">This email would be sent to the non-profit organization:</h3>
       <form class="email-entry" action="#" method="post">
       <p style="text-align: left">
         Dear <?php echo $npid_bus_name; ?>, <br>
         You canceled a claim request for the following items: <br>
       </p>
     <table class="npo-search-resuts-tbl">
       <tr>
         <th> Equipment Type </th>
         <th> Brand Name </th>
         <th> Model </th>
         <th> Serial Number </th>
       </tr>

        <?php
        if (isset($_POST['delete'])){
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

                 foreach ($_POST['id'] as $id):
                  $sql= ("UPDATE Inventory SET ItemStatus='Available', NPID=0, TransactionID=0 WHERE ItemID ='$id'");
                  $run=mysqli_query($link, $sql);
                  endforeach;
                 mysqli_close($run);

              }
           ?>

 </table>
 <p style="text-align: left">
   If this was done by mistake, please login to New2UTech, and issue another claim request(s).<br>
   <br>
   Thank you,<br>
   New2UTech<br>
 </p>
 </form>
 <table><tr>
   <td>
       <a class="update-inventory-view-btn" href="New2UTech-ProfileNPO.php">Return</a></td>
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
