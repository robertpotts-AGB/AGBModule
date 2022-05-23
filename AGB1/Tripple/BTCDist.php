<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once('Common/Fun_FormatText.inc.php');


// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = "SELECT QuClRank,QuHits,QuGold,QuXnine, QuScore, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, EnCode, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS Name,CONCAT(EnDivision,EnClass)AS Event, CoName,(QuD3Score+QuD4Score)AS ShtDstTot,QuD1Hits,QuD1Gold FROM Qualifications, Entries, Individuals, Tournament, Countries WHERE QuD1Rank='1' AND EnDivision='C' AND EnClass='M' AND CoID=EnCountry AND QuID=EnID AND EnID = IndID AND EnTournament=ToID AND EnTournament= " . StrSafe_DB($_SESSION['TourId']) . " ORDER BY ShtDstTot DESC LIMIT 5";

$result1 = "SELECT QuClRank,QuHits,QuGold,QuXnine, QuScore, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, EnCode, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS Name,CONCAT(EnDivision,EnClass)AS Event, CoName,(QuD3Score+QuD4Score)AS ShtDstTot,QuD2Hits,QuD2Gold FROM Qualifications, Entries, Individuals, Tournament, Countries WHERE QuD2Rank='1' AND EnDivision = 'R' AND EnClass='M' AND CoID=EnCountry AND QuID=EnID AND EnID = IndID AND EnTournament=ToID AND EnTournament= " . StrSafe_DB($_SESSION['TourId']) . " ORDER BY ShtDstTot DESC LIMIT 5";

$result2 = "SELECT QuClRank,QuHits,QuGold,QuXnine, QuScore, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, EnCode, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS Name,CONCAT(EnDivision,EnClass)AS Event, CoName,(QuD3Score+QuD4Score)AS ShtDstTot,QuD3Hits,QuD3Gold FROM Qualifications, Entries, Individuals, Tournament, Countries WHERE QuD3Rank='1' AND EnDivision = 'R' AND EnClass='W' AND CoID=EnCountry AND QuID=EnID AND EnID = IndID AND EnTournament=ToID AND EnTournament= " . StrSafe_DB($_SESSION['TourId']) . " ORDER BY ShtDstTot DESC LIMIT 5";

$result3 = "SELECT QuClRank,QuHits,QuGold,QuXnine, QuScore, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, EnCode, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS Name,CONCAT(EnDivision,EnClass)AS Event, CoName,(QuD3Score+QuD4Score)AS ShtDstTot,QuD4Hits,QuD4Gold FROM Qualifications, Entries, Individuals, Tournament, Countries WHERE QuD4Rank='1' AND EnDivision = 'C' AND EnClass='W' AND CoID=EnCountry AND QuID=EnID AND EnID = IndID AND EnTournament=ToID AND EnTournament= " . StrSafe_DB($_SESSION['TourId']) . " ORDER BY ShtDstTot DESC LIMIT 5";

$Rs = safe_r_sql($result);
while($row = safe_fetch($Rs)) {
$LR70mName = $row->Name ;
$LR70mScore = $row->ShtDstTot ;
$LR70mHits = $row->QuD1Hits ;
$LR70mGolds = $row->QuD1Gold ;

}
$Rs = safe_r_sql($result1);
while($row = safe_fetch($Rs)) {
$LR60mName = $row->Name ;
$LR60mScore = $row->ShtDstTot ;
$LR60mHits = $row->QuD2Hits ;
$LR60mGolds = $row->QuD2Gold ;

}
$Rs = safe_r_sql($result2);
while($row = safe_fetch($Rs)) {
$LR50mName = $row->Name ;
$LR50mScore = $row->ShtDstTot ;
$LR50mHits = $row->QuD3Hits ;
$LR50mGolds = $row->QuD3Gold ;

}
$Rs = safe_r_sql($result3);
while($row = safe_fetch($Rs)) {
$LR30mName = $row->Name ;
$LR30mScore = $row->ShtDstTot ;
$LR30mHits = $row->QuD4Hits ;
$LR30mGolds = $row->QuD4Gold ;

}

echo "<table border='1'>
<tr>

<th>Mens Recurve</th>

</tr>";

echo "<tr>";
echo"<td> Womens Recurve 50m & 30m </td>";
  echo "<td> $LR70mName </td>";
  echo "<td> $LR70mRank </td>";
  echo "<td> $LR70mScore </td>";
  echo "<td> $LR70mHits </td>"; 
  echo "<td> $LR70mGolds</td>";
  echo "</tr>";
  echo "<tr>";
echo"<td> Mens Recurve 50m & 30m </td>";
  echo "<td> $LR60mName </td>";
  echo "<td> $LR60mRank </td>";
  echo "<td> $LR60mScore </td>";
  echo "<td> $LR60mHits </td>"; 
  echo "<td> $LR60mGolds</td>";
  echo "</tr>";
  echo "<tr>";
echo"<td> Mens Compound 50m & 30m </td>";
  echo "<td> $LR50mName </td>";
  echo "<td> $LR50mRank </td>";
  echo "<td> $LR50mScore </td>";
  echo "<td> $LR50mHits </td>"; 
  echo "<td> $LR50mGolds</td>";
  echo "</tr>";
  echo "<tr>";
echo"<td> Womens Compound 50m & 30m </td>";
  echo "<td> $LR30mName </td>";
  echo "<td> $LR30mRank </td>";
  echo "<td> $LR30mScore </td>";
  echo "<td> $LR30mHits </td>"; 
  echo "<td> $LR30mGolds</td>";
  echo "</tr>";
  echo "</table>";

?> 