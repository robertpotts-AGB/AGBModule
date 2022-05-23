<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once('Common/Fun_FormatText.inc.php');
////Script for Setting County and Region for a defined club////
////Your File must be structured in the following format: AGB Club ID, County- CXXX, Region - RXXX and saved to Modules/AGBNS/CandR.csv ////

// set local variables
//$connect = mysql_connect("localhost","root","ianseo") or die('Could not connect: ' . mysql_error());
$handle = fopen("test.csv", "r");

// connect to mysql and select database or exit
//mysql_select_db("ianseo", $connect);

// loop content of csv file, using comma as delimiter and set variables
while (($data = fgetcsv($handle, 1000, ",")) !== false) {
$club = $data[0];
$county = $data[1];
$region = $data[2];

// entry exists update
$query = "UPDATE ianseo.Countries SET CoParent1 =(SELECT * FROM(SELECT CoID FROM Countries WHERE CoCode= '$county' AND CoTournament = '". $_SESSION['TourId'] ."')tbltemp), CoParent2 =(SELECT * FROM(SELECT CoID FROM Countries WHERE CoCode= '$region' AND CoTournament = '". $_SESSION['TourId'] ."')tbltemp2) WHERE CoCode = '$club' AND CoTournament = '". $_SESSION['TourId'] ."'";

//mysql_query($query);
$Rs = safe_r_sql($query);
} 

fclose($handle);
//mysql_close($connect);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Updates Clubs</title> 
</head> 

<body> 

<p>Counties and Regions have been Successfully Linked for this Tournament</p>

<p>Module developed 14/9/15 by Rob Potts</p>
</body> 
</html> 
