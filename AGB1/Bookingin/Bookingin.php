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
			$query="SELECT EnID,EnDivision,EnClass,EnName,EnAgeClass,EnFirstName,EnCode,EnCountry,QuID,QuTargetNo,CoID,CoName,EnTournament,ClId,ClDescription,ClTournament,DivID,DivTournament,DivDescription,ToId,ToName FROM Entries, Qualifications, Countries,Classes,Divisions, Tournament WHERE ToId='$TourCode' AND DivID=EnDivision AND DivTournament = '$TourCode' AND ClId=EnClass AND ClTournament='$TourCode'  AND EnTournament='$TourCode' AND CoID=EnCountry AND QuID=EnID AND EnCode = '$MemNo'"; //
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
					$updQuery="UPDATE Entries SET EnStatus = '0' WHERE EnId ='$EntryNo'";
					$updateArcher = safe_r_sql($updQuery);
					$Insert = "INSERT INTO AccEntries (AEId,AEOperation,AETournament,AEWhen) VALUES('$EntryNo','$AccOpp','$TourCode','$currDate') ON DUPLICATE KEY UPDATE AEOperation='$AccOpp',AEWhen='$currDate'";
                        $INS = safe_r_sql($Insert);
					$iscurr ="SELECT * FROM AccEntries WHERE AEId='$EntryNo'";
					if(safe_r_sql($iscurr) > 0){

                    }
					else {
                        
                    }
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
			Tournaments Registration System
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
			<p><font size="4" color="yellow">Category: <font size="6" color="yellow"><?php echo $DivisionName ?> <?php echo $Catname ?></font></p>
			
		</td>
		<td  id="Scanning" bgcolor="Blue" color="white" style=color:white align="Center"> 
				<p> Session </p>
				<p><font size="10"><?php echo $Session ?></font></p>
				<p> Target </p>
				<p><font size="10"><?php echo $Target ?></font></p>
		</td>
	</tr>

</table>

<!-- <p>Your Card expiry date is: <?php /*echo $ValidDate */?> </p>
<p>Your Membership number is: <?php /*echo $MemNo */?> </p>
<p><?php /*echo $TourCode */?></p>

-->

</body>
</html>
