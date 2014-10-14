<?php
/*********************************************************************************************
*
*    A simple subscribe module.
*    This script isn't complete.
* 
*    For better use, you can add other validate & filter clauses
*    Either your improve your website ergonomy yourself, just the regular way, or you can
*      just integrate this script
*
*     file : inscription.php
*     @author Med Amine Ben Asker [YuriLz]- mail : ben[dot]asker[dot]amine[at]gmail[dot]com
*
**********************************************************************************************/


function valide_to_standard(&$entry, &$error_array){

if ( !filter_var($entry['email'], FILTER_VALIDATE_EMAIL) )
    $error_array[] = "This email (". $entry['email'] . ") is not valid " ;
if ( !in_array($entry['civility'], array('Mme.', 'Mlle.','M.') ) )
    $error_array[] = "This civility (". $entry['civility'] . ") is not valid " ;
 
$test_date = '03/22/2010'; 
if (!preg_match('%\A(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d\z%',
 $entry['birthday']))

	 $error_array[] = "This birthday (". $entry['birthday'] . ") is not valid " ;

 }

function filter_to_standard(&$entry){

foreach ($entry as $key => $value) {
	$entry[ $key ] = mysql_real_escape_string($value);
	$entry[ $key ] = htmlspecialchars($value);

  }
}

// Initialisation 
$civility    = ( isset( $_POST['civility'] ) ) ? $_POST['civility'] : NULL;
$name        = ( isset( $_POST['name'] ) ) ? $_POST['name'] : NULL; 
$firstname   = ( isset( $_POST['firstname'] ) ) ? $_POST['firstname'] : NULL; 
$birthday    = ( isset( $_POST['birthday'] ) ) ? $_POST['birthday'] : NULL;
$email       = ( isset( $_POST['email'] ) ) ? $_POST['email'] : NULL;
$phonenumber = ( isset( $_POST['phonenumber'] ) ) ? $_POST['phonenumber'] : NULL;
$website     = ( isset( $_POST['website'] ) ) ? $_POST['website'] : NULL;

$entry = array('civility' => $civility,
    	'firstname' =>$firstname,
    	'name' =>$name,
    	'email' =>$email,
    	'phonenumber' =>$phonenumber,
    	'birthday' =>$birthday,
    	'website' =>$website,
    	NULL,
    	'REMOTE_ADDR' =>$_SERVER["REMOTE_ADDR"],
    	);

$error_array = array();


// Filtring input 
filter_to_standard($entry);
valide_to_standard($entry, $error_array);

if (empty($error_array) )
 {
 	include("config.php");

 	mysql_connect($dbhostname, $dbuser, $dbpassword ) or die("die");
 	mysql_select_db($dbname);
    $status = mysql_query("INSERT INTO guests VALUES ('','".implode("','",$entry)."')");
    mysql_close();

    if ($status)
        header("location:redirect.php");
    else
        $error_array[] = "Error while writing in database .";

 } else {
 	$error_array[] = "Error : inputs is not valid  .";
 }

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
<p>
	<?php
echo implode("<br>", $error_array);

	?>

</p>

</body>


<form method="POST">


<p>Civility <span style="color: #ff0000;"><strong>*</strong></span>
<input name="civility" value="M." type="radio" checked="checked">&nbsp;M.
<input name="civility" value="Mme." type="radio">&nbsp;Mme.
<input name="civility" value="Mlle." type="radio">&nbsp;Mlle.
</p>

<p>Your firstname <br>
<input name="firstname" value="" size="40" type="text"></p>
<p>Your name <br>
<input name="name" value="" size="40" type="text"></p>
<p>Your E-mail  <br>
<input name="email" value="" size="40" type="text"></p>
<p>Your birthday  <br>
<input name="birthday" value="mm/dd/yyyy" size="10" type="text"></p>

<p>Your phone number <br>
<input name="phonenumber" value="" size="40" type="text"></p>
<p>Web site  <br>
<input name="website" value="" size="40" type="text"></p>

<input name="submit" value="Subscribe !" type="submit" >


</form>

<footer>
	<p>Free Module coded by <a href="https://twitter.com/asker_amine">@asker_amine</a></p>
</footer>
</html>
