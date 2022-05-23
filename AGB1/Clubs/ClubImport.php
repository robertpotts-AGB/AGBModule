<?php

///////////////////////// MODULE FOR IMPORTING AGB CLUB STRUTURE INTO IANSEO /////////////////////////
///LATEST CLUB IMPORT FILE AVAILALBE IN DROPBOX: /RESULTS TEAM/MEMBERSHIP DATA/IANSEOCLUBIMPORT.csv///


require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once('Common/Fun_FormatText.inc.php');

//$connect = mysql_connect("localhost","root","ianseo"); 
//mysql_select_db("ianseo",$connect); //select the table 

if ($_FILES[csv][size] > 0) { 
//get the csv file
    $file = $_FILES[csv][tmp_name];
    $handle = fopen($file,"r");
    $Tour11 = $_SESSION['TourId'];
    //loop through the csv file and insert into database
    do {
        if ($data[0]) {
           // mysql_query
            safe_r_sql("INSERT INTO ianseo.Countries (CoTournament, CoCode, CoName, CoNameComplete) VALUES
                (
					'".$Tour11."',
					'".addslashes($data[0])."',
                    '".addslashes($data[1])."',
                    '".addslashes($data[2])."'
                )
            ");
        }
    } while ($data = fgetcsv($handle,1000,",","'"));
    //
    //redirect 
    header('Location: ClubImport.php?success=1'); die; 

} 

?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Import Clubs, Counties and Regions</title> 
</head> 

<body> 
<p>
Your File must be structured in the following format:
AGB Club ID, AGB Club Name - Short version, AGB Club Name - Long Version
</p>
<?php if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> 

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  Choose your file: <br /> 
  <input name="csv" type="file" id="csv" /> 
  <input type="submit" name="Submit" value="Submit" /> 
</form> 
<p>Module developed 14/9/15 by Rob Potts</p>
</body> 
</html> 
