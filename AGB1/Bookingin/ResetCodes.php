<?php
	require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
	require_once('Common/Fun_FormatText.inc.php');
	$Tour11 = $_SESSION['TourId'];	
?>
				
<html>
<body>

<p>Click the below button to reset the Archer Status for the current competition.</p>

<button onclick="myFunction()">Reset Archer Statuses</button>

<p id="reset"></p>

<script>
function myFunction() {
    var x;
			if (confirm("Are you sure you want to reset the Archers Acceditation Status?") == true){
			<?php
			$updQuery="UPDATE Entries SET EnStatus = '1' WHERE EnTournament='$Tour11'";
			$updateArcher = safe_r_sql($updQuery);
			?>
			
			x ="Archer Statuses reset to 1 (Not Booked In). Please use the registration form to book in Archers ";  
			}

  else {
        x = "No Statuses have been Reset";
    }
    document.getElementById("reset").innerHTML = x;
}
</script>

</body>
</html>
