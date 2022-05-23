<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once('Common/Fun_FormatText.inc.php');


// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = "SELECT QuClRank,QuHits,QuGold,QuXnine, QuScore, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, EnCode, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS Name,CONCAT(EnDivision,EnClass)AS Event, CoName FROM Qualifications, Entries, Individuals, Tournament, Countries WHERE CoID=EnCountry AND QuID=EnID AND EnID = IndID AND EnTournament=ToID AND EnTournament= " . StrSafe_DB($_SESSION['TourId']) . " ORDER BY Event DESC, QuClRank ASC";

$Rs = safe_r_sql($result);

$StrData = '';

  if (safe_num_rows($Rs)>0)
  {
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Content-Disposition: attachment; filename=' . ($ToCode!='' ? $ToCode : 'F7050') . '.txt');
    header('Content-type: text/tab-separated-values; charset=' . PageEncode);

    $MyHeader
      .=("AGB Number") . "\t"
      . ("ShootIdent") ."\t"
      . ("Event") . "\t"
      . ("Name") . "\t"
      . ("Club") . "\t"
      . ("F70 pos") . "\t"
      . ("WA5070Score") . "\t"
      . ("WA5070Tens")  . "\t"
      . ("WA5070Xs") . "\t"
      . ("Event Name") . "\t";




    $MyHeader.="\n";

    print $MyHeader;

    while ($MyRow=safe_fetch($Rs))
    {
      $StrData
        .=$MyRow->EnCode . "\t"
        . $MyRow->EnTournament . "\t"
        . $MyRow->Event . "\t"
        . $MyRow->Name . "\t"
        . $MyRow->CoName . "\t"
        . $MyRow->QuClRank . "\t"
        . $MyRow->QuScore . "\t"
        . $MyRow->QuGold . "\t"      
        . $MyRow->QuXnine . "\t"
        . $MyRow->ToName . "\t"
        ; 

      $StrData.="\n";
    }

    print $StrData;
  }

echo "<table border='1'>
<tr>
<th>ArcherIdent</th>
<th>ShootIdent</th>
<th>Event</th>
<th>Name</th>
<th>Club</th>
<th>F70 Pos</th>
<th>WA5070Score</th>
<th>WA5070Tens</th>
<th>WA5070Xs</th>
<th>Event Name</th>
</tr>";

while($row = safe_fetch($Rs)) {
  echo "<tr>";
  
  echo "<td>" . $row->EnCode . "</td>";
  echo "<td>" . $row->EnTournament . "</td>";
echo "<td>" . $row->Event . "</td>";
  echo "<td>" . $row->Name . "</td>"; 
  echo "<td>" . $row->CoName . "</td>";
  echo "<td>" . $row->QuClRank ."</td>";
  echo "<td>" . $row->QuScore . "</td>";
  echo "<td>" . $row->QuGold . "</td>";
  echo "<td>" . $row->QuXnine . "</td>";
  echo "<td>" . $row->ToName . "</td>";
  
 
  echo "</tr>";
}

echo "</table>";

?> 