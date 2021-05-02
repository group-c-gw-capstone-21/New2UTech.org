<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: New2UTech-login.php");
    exit;
}
// catch the get form data input values from the user input verificaion page
try{
  $bus_name=$_GET['bus_name'];
  $ip=$_GET['ip'];
  $json=$ip.".json";
  $url = 'https://projects.propublica.org/nonprofits/api/v2/organizations/'.$json;
  $response = file_get_contents($url);
  // post input to verify if business name matches the ein/tin on file with the IRS
    if(isset($_POST['submit'])){
      $_SESSION['npo_bus_name'] = $_POST['npo_bus_name'];
      header("location: New2UTech-ValidationNPO.php");
    }
    // after calling the api retriving the data, manipulating it to adequately compare it, regardless of how it's entered
    if ($response !== false){
      $str_array = explode(":", $response);
      $ein_tin = substr_replace($str_array[3],"", -7);
      $_SESSION['ein_tin'] = $ein_tin;
      echo "<br><br>";
      $npo_div = $str_array[4];
      $npo_div2 = explode(",", $npo_div);
      $npo_div3 = $npo_div2[0];
      $npo_name = trim($npo_div3,'"');
      $npo_name_verify = strtolower($npo_name);
      $_SESSION["npo_name"] = $npo_name_verify;
      // verifies the ein/tin and will loop around to provide the user multiple tries
      echo "The EIN/TIN that you entered is valid. <br> Please submit the business name. <br> YOU MUST SPELL THE NON-PROFIT BUSINESS NAME EXACTLY HOW IT'S LISTED WITH THE IRS";
      echo "<form action=". htmlspecialchars($_SERVER['PHP_SELF'])." method='post'> Business Name: <input name='npo_bus_name' id='npo_bus_name' type='text' required /><br /><button name='submit' type='submit'> Submit Business Name</button>  </form>";
    }
    else {
      echo "The EIN/TIN that you entered was not valid, please try again.";
    }
  }
  // try catch loop to allow the user to enter valid npo input credentials
  catch(Exception $e){
      echo $e->getMessage();
  }
?>
