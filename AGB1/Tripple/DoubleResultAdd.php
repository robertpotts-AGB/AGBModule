<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once('Common/Fun_FormatText.inc.php');


// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$var_value = $_POST['Tour2'];
$secondTourID = "264";

//$result = "SELECT QuClRank,QuHits,QuGold,QuXnine, QuScore, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, EnCode, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS Name,CONCAT(EnDivision,EnClass)AS Event, CoName FROM Qualifications, Entries, Individuals, Tournament, Countries WHERE CoID=EnCountry AND QuID=EnID AND EnID = IndID AND EnTournament=ToID AND EnTournament= " . StrSafe_DB($_SESSION['TourId']) . " ORDER BY Event DESC, QuClRank ASC";

//Union on EnCode

 $result2 = "SELECT QuClRank,QuHits,SUM(QuGold) As Golds,SUM(QuXnine) AS Xs, SUM(QuScore) As Score, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, IndRankFinal, FNName, EvEvent, CoName FROM
(SELECT QuClRank,QuHits,QuGold,QuXnine, QuScore, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS FNName, CONCAT(EnDivision,EnClass)AS EvEvent, CoName FROM Qualifications, Entries, Individuals, Tournament, Countries WHERE CoID=EnCountry AND QuID=EnID AND EnID = IndID AND EnTournament=ToID AND EnTournament= " . StrSafe_DB($_SESSION['TourId']) . "
UNION
SELECT QuClRank,QuHits,QuGold,QuXnine, QuScore, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS Name,CONCAT(EnDivision,EnClass)AS Event, CoName FROM Qualifications, Entries, Individuals, Tournament, Countries WHERE CoID=EnCountry AND QuID=EnID AND EnID = IndID AND EnTournament=ToID AND EnTournament= $secondTourID) AS A
GROUP BY EnCode
ORDER BY EvEvent DESC, Score DESC,Golds DESC,Xs DESC";
     $Rs = safe_r_sql($result2);

echo "<table border='1'>
<tr>
<th>ArcherIdent</th>
<th>ShootIdent</th>
<th>Event</th>
<th>Name</th>
<th>1440 Pos</th>
<th>Double</th>
<th>Day 1 X's</th>
<th>Day 1 10+X's</th>
<th>Event Name</th>
</tr>";

while($row = safe_fetch($Rs)) {
  echo "<tr>";
  
  echo "<td>" . $row->EnCode . "</td>";
  echo "<td>" . $row->EnTournament . "</td>";
  echo "<td>" . $row->EvEvent . "</td>";
  echo "<td>" . $row->FNName . "</td>";
  echo "<td>" . $row->QuClRank ."</td>";
  echo "<td>" . $row->Score ."</td>";
  echo "<td>" . $row->Xs ."</td>";
  echo "<td>" . $row->Golds ."</td>";
  echo "<td>" . $row->QuClRank ."</td>";
  echo "<td>" . $row->ToName . "</td>";
  
 
  echo "</tr>";
}

echo "</table>";

?> 