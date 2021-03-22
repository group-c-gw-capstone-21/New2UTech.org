<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'jgyvJ78QXHBO');
   define('DB_DATABASE', 'New2UTech');
   $link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   if($link === false){
       die("ERROR: Could not connect. " . mysqli_connect_error());
   }
?>
