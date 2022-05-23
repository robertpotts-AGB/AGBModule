<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once('Common/Fun_FormatText.inc.php');
include("Bkinconfig.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
  
	if (empty($_POST["name"])) 
	{
     ?>
  			<script type="text/javascript">
    		alert("Please scan your card");
    		history.back();
  			</script>
<?php
     
	} else 
	{
		$CardNo = ($_POST["name"]);
    $Badge = ($_POST["Value"]);
    $Level = ($_POST["Award"]);
    $Bowtype = ($_POST["Bow"]);
		$NumLength = strlen($CardNo);
        $AccOpp = "1";
        $currDate =date('Y-m-d H:i');
        $TourID = "226";

		// If card number is longer than 8 then do the trim else use the number
		if ($NumLength > 8) {
		$ValidDate = substr($CardNo,0,8);
		$MemIDNo = substr($CardNo,8);
		$MemNo = ltrim($MemIDNo,'0'); // Trim off leading 0's from the membership number
		}
		else
		{
		$MemNo =$CardNo;
		$ValidDate = "30092019";
		}



		// Check Membership Expiry Date, REMEMBER TO UPDATE YEARLY

		if ($ValidDate == "30092019")
		{
            include("Bkinconfig.php");

			//Check MySQL Connection before Launching Queries
			if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			$Tour11 = $_SESSION['TourId'];
			//insert code for select query here and assign to variables for archer info:
			$query="SELECT EnID,EnDivision,EnClass,EnName,EnAgeClass,QuScore,EnFirstName,EnCode,EnCountry,QuID,QuTargetNo,CoID,CoName,EnTournament,ClId,ClDescription,ClTournament,DivID,DivTournament,DivDescription,ToId,ToName FROM Entries, Qualifications, Countries,Classes,Divisions, Tournament WHERE ToId='$TourCode' AND DivID=EnDivision AND DivTournament = '$TourCode' AND ClId=EnClass AND ClTournament='$TourCode'  AND EnTournament='$TourCode' AND CoID=EnCountry AND QuID=EnID AND EnCode = '$MemNo'"; //
			//Run Query
			$result = safe_r_sql($query);
			
			// populate variables
			while($row = safe_fetch($result)) {
				$EntryNo = $row->EnID;
				$Firstname = $row->EnFirstName;
				$Name = $row->EnName;
				$Division = $row->EnDivision;
				$Class = $row->EnClass;
				$Catname = $row->ClDescription;
				$Club = $row->EnCountry;
				$ClubName = $row->CoName;
				$AgeClass = $row->EnAgeClass;
				$TargetID = $row->QuTargetNo;
				$Target=substr($TargetID,1);
				$Session = substr($TargetID,0,1);
				$DivisionName = $row->DivDescription;
				$EnCode = $row->EnCode;
            $QuScore = $row->QuScore;
				}
		
			 //Check for Archer actually existing....
					
				if (is_null($EntryNo)) //If Archer is Not found
			 		{
					?>
  					<script type="text/javascript">
    				alert("You are not Entered into this Event");
    				//history.back();
  					</script>
					<?php
			 		}

				else
					{
					// Book Archer In (in reality this sets the archers Ianseo status to 'Can Participate' to allow us to see who has booked in, but still allowing everyone to fall to the PDA's)
					$Insert = "INSERT INTO AGBRecs (ArcherID,Badge,Level,Bowtype,ScoreAchieved,EventID) VALUES ('$MemNo','$Badge','$Level','$Bowtype','$QuScore','$TourCode')";
                        $INS = safe_r_sql($Insert);
					//$iscurr ="SELECT * FROM AccEntries WHERE AEId='$EntryNo'";
					//if(safe_r_sql($iscurr) > 0){

                    //}
					//else //{
                        
                    //}
				    }
			
			
		}
		else
		    {
		     ?>   <script type="text/javascript">
                alert("Current Card is out of date, please scan a valid membership card.");

    		//history.back();
  			</script>
                <?php
		    }

		}  

	}
   //Test Code to ensure result is being obtained
   /*  if (!mysql_num_rows($result)) 
		{
			echo 'No records found';
		} 
		else 
		{
		for ($i = 0; $i < mysql_num_rows($result); ++$i) 
		{
			echo mysql_result($result, $i, 'EnFirstName'), PHP_EOL;
		}
		} */

?>
<html>
<style>
#Header {
    border-radius: 25px;
    font-family: Cambria;
 	font-size:27px;
    background: #DD0000;
    color: white;
    padding:20px;
    height: 50px;
    margin: auto;
}
#Scanning {
    border-radius: 25px;
    font-family: Calibri;
    font-size: 22px;
    background: #00AAFF;
    padding:15px;
    height: 30px;
    margin: auto;
    text-align: center;
    vertical-align: middle;
    
}
#Data {
    border-radius: 25px;
    font-family: Calibri;
    font-size: 30px;
    background: #000000;
    padding:5px;
    height: 30px;
    margin: auto;
    vertical-align: middle;
    
}
</style>

<body>
<table width="100%" id="Header">
	<tr> 
		<td align="center">
			Tournaments Award System (<?php echo $TourCode ?>)
		</td>
	</tr>
	
</table>
<p/>
	
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table  width="100%" id="Scanning">
	<tr> 
		<td align="center">
	
			Scanned Barcode number: <input id="0011" type="text" name="name" autofocus value="<?php echo $name;?>"><br/>
			<input hidden="true" type="submit" name="Submit" value="submit">
	
		</td>


                <td align="center">
                    Award Type:
  <select name="Award">
  <option value="Select">---Select---</option>
  <option value="Silver Star">Silver Star</option>
  <option value="WA Star">WA Star</option>
  <option value="National Record">National Record</option>
      <option value="Six Gold End">Six Gold End</option>
      <option value="Three Gold End">Three Gold End</option>
      <option value=" Imperial Six Gold End">Imperial Six Gold End</option>
      <option value=" Imperial Three Gold End">Imperial Three Gold End</option>
      <option value="Rose Awards">Rose Awards</option>
      <option value="Target Awards">Target Awards</option>
      <option value="Silver Target Awards">Silver Target Awards</option>
            
            
</select>
            </td>
            <td align="left">
                Award Level:
            <select name="Value">
                <option value="Select">---Select---</option>
  <option value="1000">1000</option>
  <option value="1100">1100</option>
  <option value="1200">1200</option>
  <option value="1300">1300</option>
  <option value="1350">1350</option>
  <option value="1400">1400</option>
  <option value="800">800 Rose</option>
  <option value="900">900 Rose</option>
  <option value="1000">1000 Rose</option>
    <option value="1100">1100 Rose</option>
                <option value="1200">1200 Rose</option>
            <option value="1250">1250 Rose</option>
            <option value="LB 225">Longbow 225 Rose</option>
            <option value="LB 300">Longbow 300 Rose</option>
            <option value="LB 375">Longbow 375 Rose</option>
            <option value="LB 450">Longbow 450 Rose</option>
             <option value="LB 525">Longbow 525 Rose</option>
             <option value="LB 600">Longbow 600 Rose</option>
             <option value="National Record">National Record</option>
              <option value="Six Gold End">Six Gold End</option>
            <option value="Three Gold End">Three Gold End</option>
  <option value="500">500/480 (White)</option>
  <option value="525">525/500 (Black)</option>
  <option value="550">550/520 (Blue) </option>
  <option value="575">575/540 (Red)</option>
  <option value="585">585/550 (Gold)</option>
  <option value="595">595/560 (Purple)</option>
            
            </select>
            Bowstyle:
             <select name="Bow">
                 <option value="Select">---Select---</option>
  	<option value="Recurve">Recurve</option>
  <option value="Compound">Compound</option>
  <option value="Longbow">Longbow</option>
            <option value="Barebow">Barebow</option>
                    
            
</select>
            </td>
            </tr>
</table>
	</form>	
<p/>


<table id="Data" align="Center" bgcolor="black" border=0 width=90%>
	<tr>
		<td align="Center">
			<p> <font size="6"color="yellow" ><?php echo $Name ?> <?php echo $Firstname ?> ( <?php echo $EnCode ?> ) </font></p>
		</td>
	</tr>
	<tr>
		<td width=65%>
			<p><font color="yellow" size="4"> Club: <font size="6" color="yellow"><?php echo $ClubName ?></font> </p>
			<p><font size="4" color="yellow">Category: <font size="6" color="yellow"><?php echo $Level ?> <?php echo $Badge ?></font></p>
			
		</td>
		<td  id="Scanning" bgcolor="Blue" color="white" style=color:white align="Center"> 
				<p> Score </p>
				<p><font size="10"><?php echo $QuScore ?></font></p>
	
		</td>
	</tr>

</table>
<?php
if(is_null($MemNo))
{

}
else
    {
    $existingbadge = "SELECT AwardLevel,AwardDate,AwardBowstyle,MembershipID FROM AGBTargetClaims WHERE MembershipID=$MemNo";
    $Badges= safe_r_sql($existingbadge);
    $StrData = '';
    echo "<h2> Current Awards </h2>";
    echo "<table border='1'>
<tr>
<th>Award</th>
<th>Date</th>
<th>Bowstyle</th>
</tr>";

    while($row = safe_fetch($Badges)) {
        echo "<tr>";
        echo "<td>" . $row->AwardLevel . "</td>";
        echo "<td>" . $row->AwardDate . "</td>";
        echo "<td>" . $row->AwardBowstyle . "</td>";
        echo "</tr>";

    }
    echo"</table>";
}


$result = "SELECT Badge,Level,EventID,ScoreAchieved,Bowtype, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, EnCode, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS Name,CONCAT(EnDivision,EnClass)AS Event, CoName FROM AGBRecs, Qualifications, Entries, Individuals, Tournament, Countries WHERE EnTournament='$TourCode' AND CoID=EnCountry AND QuID=EnID AND ArcherID=EnCode AND EnID = IndID AND EnTournament=ToID AND EnTournament = EventID ORDER BY Event DESC, QuClRank ASC";

$Recs = safe_r_sql($result);

$StrData = '';
echo "<h2> Current Claims </h2>";
echo "<table border='1'>
<tr>
<th>ArcherIdent</th>
<th>Name</th>
<th>Bowstyle</th>
<th>Club</th>
<th></th>
<th>Score</th>
<th>Level</th>
<th>Award</th>
<th>Event Name</th>
</tr>";

while($row = safe_fetch($Recs)) {
  echo "<tr>";
  
  echo "<td>" . $row->EnCode . "</td>";
  echo "<td>" . $row->Name . "</td>";
  echo "<td>" . $row->Bowtype . "</td>"; 
  echo "<td>" . $row->CoName . "</td>";
  echo "<td>" . $row->QuClRank ."</td>";
  echo "<td>" . $row->ScoreAchieved . "</td>";
echo "<td>".$row->Badge ."</td>";
echo "<td>" . $row->Level ."</td>";

  echo "<td>" . $row->ToName . "</td>";
  
 
  echo "</tr>";
}



?>
      
<!-- <p>Your Card expiry date is: <?php /*echo $ValidDate */?> </p>
<p>Your Membership number is: <?php /*echo $MemNo */?> </p>
<p>Your Membership number is: <?php echo $CardNo ?> </p>
<p>Your Membership number is: <?php echo $Badge ?> </p>
<p>Your Membership number is: <?php echo $Level ?> </p>
<p><?php /*echo $TourCode */?></p>

-->

</body>
</html>
