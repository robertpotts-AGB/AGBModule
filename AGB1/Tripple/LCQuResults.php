<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once('Common/Fun_FormatText.inc.php');


// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = "SELECT QuClRank,QuHits,QuGold,QuXnine, QuScore, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, EnCode, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS Name,CONCAT(EnDivision,EnClass)AS Event, CoName,QuD1Rank,QuD1Score,QuD1Hits,QuD1Gold FROM Qualifications, Entries, Individuals, Tournament, Countries WHERE QuD1Rank='1' AND EnDivision='C' AND EnClass='W' AND CoID=EnCountry AND QuID=EnID AND EnID = IndID AND EnTournament=ToID AND EnTournament= " . StrSafe_DB($_SESSION['TourId']) . " ORDER BY Event DESC, QuClRank ASC";

$result1 = "SELECT QuClRank,QuHits,QuGold,QuXnine, QuScore, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, EnCode, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS Name,CONCAT(EnDivision,EnClass)AS Event, CoName,QuD2Rank,QuD2Score,QuD2Hits,QuD2Gold FROM Qualifications, Entries, Individuals, Tournament, Countries WHERE QuD2Rank='1' AND EnDivision = 'C' AND EnClass='W' AND CoID=EnCountry AND QuID=EnID AND EnID = IndID AND EnTournament=ToID AND EnTournament= " . StrSafe_DB($_SESSION['TourId']) . " ORDER BY Event DESC, QuClRank ASC";

$result2 = "SELECT QuClRank,QuHits,QuGold,QuXnine, QuScore, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, EnCode, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS Name,CONCAT(EnDivision,EnClass)AS Event, CoName,QuD3Rank,QuD3Score,QuD3Hits,QuD3Gold FROM Qualifications, Entries, Individuals, Tournament, Countries WHERE QuD3Rank='1' AND EnDivision = 'C' AND EnClass='W' AND CoID=EnCountry AND QuID=EnID AND EnID = IndID AND EnTournament=ToID AND EnTournament= " . StrSafe_DB($_SESSION['TourId']) . " ORDER BY Event DESC, QuClRank ASC";

$result3 = "SELECT QuClRank,QuHits,QuGold,QuXnine, QuScore, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, EnCode, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS Name,CONCAT(EnDivision,EnClass)AS Event, CoName,QuD4Rank,QuD4Score,QuD4Hits,QuD4Gold FROM Qualifications, Entries, Individuals, Tournament, Countries WHERE QuD4Rank='1' AND EnDivision = 'C' AND EnClass='W' AND CoID=EnCountry AND QuID=EnID AND EnID = IndID AND EnTournament=ToID AND EnTournament= " . StrSafe_DB($_SESSION['TourId']) . " ORDER BY Event DESC, QuClRank ASC";

$Rs = safe_r_sql($result);
while($row = safe_fetch($Rs)) {
$LR70mName = $row->Name ;
$LR70mRank = $row->QuD1Rank ;
$LR70mScore = $row->QuD1Score ;
$LR70mHits = $row->QuD1Hits ;
$LR70mGolds = $row->QuD1Gold ;

}
$Rs = safe_r_sql($result1);
while($row = safe_fetch($Rs)) {
$LR60mName = $row->Name ;
$LR60mRank = $row->QuD2Rank ;
$LR60mScore = $row->QuD2Score ;
$LR60mHits = $row->QuD2Hits ;
$LR60mGolds = $row->QuD2Gold ;

}
$Rs = safe_r_sql($result2);
while($row = safe_fetch($Rs)) {
$LR50mName = $row->Name ;
$LR50mRank = $row->QuD3Rank ;
$LR50mScore = $row->QuD3Score ;
$LR50mHits = $row->QuD3Hits ;
$LR50mGolds = $row->QuD3Gold ;

}
$Rs = safe_r_sql($result3);
while($row = safe_fetch($Rs)) {
$LR30mName = $row->Name ;
$LR30mRank = $row->QuD4Rank ;
$LR30mScore = $row->QuD4Score ;
$LR30mHits = $row->QuD4Hits ;
$LR30mGolds = $row->QuD4Gold ;

}

echo "<table border='1'>
<tr>
<th>Ladies Compound</th>

</tr>";

echo "<tr>";
echo"<td> Highest 70m Score </td>";
  echo "<td> $LR70mName </td>";
  echo "<td> $LR70mRank </td>";
  echo "<td> $LR70mScore </td>";
  echo "<td> $LR70mHits </td>"; 
  echo "<td> $LR70mGolds</td>";
  echo "</tr>";
  echo "<tr>";
echo"<td> Highest 60m Score </td>";
  echo "<td> $LR60mName </td>";
  echo "<td> $LR60mRank </td>";
  echo "<td> $LR60mScore </td>";
  echo "<td> $LR60mHits </td>"; 
  echo "<td> $LR60mGolds</td>";
  echo "</tr>";
  echo "<tr>";
echo"<td> Highest 50m Score </td>";
  echo "<td> $LR50mName </td>";
  echo "<td> $LR50mRank </td>";
  echo "<td> $LR50mScore </td>";
  echo "<td> $LR50mHits </td>"; 
  echo "<td> $LR50mGolds</td>";
  echo "</tr>";
  echo "<tr>";
echo"<td> Highest 30m Score </td>";
  echo "<td> $LR30mName </td>";
  echo "<td> $LR30mRank </td>";
  echo "<td> $LR30mScore </td>";
  echo "<td> $LR30mHits </td>"; 
  echo "<td> $LR30mGolds</td>";
  echo "</tr>";
  echo "</table>";

?> 