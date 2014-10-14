<?php
/*********************************************************************************************
*
* A simple subscribe module.
* This script isn't complete.
*
* For better use, you can add other validate & filter clauses
* Either your improve your website ergonomy yourself, just the regular way, or you can
* just integrate this script
*
* file : display.php
* @author Med Amine Ben Asker [YuriLz]- mail : ben[dot]asker[dot]amine[at]gmail[dot]com
*
**********************************************************************************************/

$selection = "civility_guest,firstname_guest,name_guest,email_guest,phone_guest,birthday_guest,website_guest,date_subscribe,ip_subscribe";

 	include("config.php");

 	mysql_connect($dbhostname, $dbuser, $dbpassword ) or die("We can't access to database");
 	mysql_select_db($dbname);
  $sql = mysql_query("SELECT ". $selection ." FROM guests ");

  mysql_close();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Free & Simple Subscribe Module </title>
  <meta name="description" content="Free and Simple Subscribe Module">
  <meta name="author" content="Med Amine Ben Asker">
  <link rel="stylesheet" href="">

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>

 <p>This is a Simple Form subscribe </p>

<table>
<?php 
$selection = explode(",",$selection);

 echo "<tr>";
 foreach ($selection as $value) 
    echo "<td>". $value ."</td>";

 echo "</tr>";

while ($w = mysql_fetch_array($sql)){
 echo "<tr>";
  foreach ($selection as $value) 
     echo "<td>". $w[$value] ."</td>";
 
  echo "</tr>";
}
?>

</table>

<footer>
<!-- you can keep this if you like ;) -->
   <p>Free Module coded by <a href="https://twitter.com/asker_amine">@asker_amine</a></p>
</footer>
</body>
</html>
