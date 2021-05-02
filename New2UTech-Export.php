<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: New2UTech-login.php");
    exit;
}
$don_exp_id = $_SESSION['donor_id'];
require 'New2UTech-Config.php';
if(isset($_POST["export"])){
	header('Content-Type: text/csv; charset = utf-8');
	header('Content-Disposition: attachment; filename = New2UTech-Data.csv');
	$output = fopen("php://output", "w");
	fputcsv($output, array('Item Type', 'Item Brand', 'Item Model', 'Serial Number'));
	$query = "SELECT ItemType,ItemBrand,ItemModel,ItemSerialNumber FROM Inventory WHERE DonorID = $don_exp_id";
	$result = mysqli_query($link, $query);
	while($row = mysqli_fetch_assoc($result))
	{
			 fputcsv($output, $row);
	}
	fclose($output);
}
mysqli_close($link);
?>
