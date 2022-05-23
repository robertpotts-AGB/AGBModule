<?php
	define('debug',true);	// settare a true per l'output di debug

	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
	require_once('Common/Fun_FormatText.inc.php');

	if (!CheckTourSession()) {
		print get_text('CrackError');
		exit;
	}
    checkACL(AclQualification, AclReadOnly);

	$ToCode = '';

	$Select
		= "SELECT ToCode,ToName "
		. "FROM Tournament "
		. "WHERE ToId=" . StrSafe_DB($_SESSION['TourId']) . " ";
	$Rs=safe_r_sql($Select);

	if (safe_num_rows($Rs)==1)
	{
		$row=safe_fetch($Rs);
		$ToCode=$row->ToName;

	}

	$MyQuery = 
$result = "SELECT QuClRank,QuHits,QuGold,QuXnine, QuScore, EnCode, EnName, EnFirstName,EnTournament,EnCountry, ToName, QuID, EnID, EnCode,EnDivision,EnClass, IndRankFinal, CONCAT(EnName,' ', EnFirstName)AS Name,CONCAT(EnDivision,EnClass)AS Event,IndRank, CoName,ToName FROM Qualifications, Entries, Individuals, Tournament, Countries WHERE CoID=EnCountry AND QuID=EnID AND EnID = IndID AND EnTournament=ToID AND EnTournament= " . StrSafe_DB($_SESSION['TourId']) . " ORDER BY Event DESC, QuClRank ASC";
	$Rs=safe_r_sql($MyQuery);
	//echo $MyQuery;exit;
	$StrData = '';

	if (safe_num_rows($Rs)>0)
	{
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Disposition: attachment; filename=' . ($ToCode!='' ? $ToCode : 'export') . '.txt');
		header('Content-type: text/tab-separated-values; charset=' . PageEncode);

		$MyHeader
			.=("AGB Number") . "\t"
			. ("FirstName") ."\t"
			. ("Surname") . "\t"
			. ("Bowstyle") . "\t"
			. ("Division") . "\t"
			. ("Ranking Round Position") . "\t"
			. ("Ranking Round Score") . "\t"
			. ("10's")  . "\t"
			. ("X's") . "\t"
			. ("Head 2 Head Position") . "\t";




		$MyHeader.="\n";

		print $MyHeader;

		while ($MyRow=safe_fetch($Rs))
		{
			$StrData
				.=$MyRow->EnCode . "\t"
				. $MyRow->EnName . "\t"
				. $MyRow->EnFirstName . "\t"
				. $MyRow->EnDivision . "\t"
				. $MyRow->EnClass . "\t"
				. $MyRow->IndRank . "\t"			
				. $MyRow->QuScore . "\t"
				. $MyRow->QuGold . "\t"
				. $MyRow->QuXnine . "\t"
				. $MyRow->IndRankFinal . "\t"
				;	

			$StrData.="\n";
		}

		print $StrData;
	}
?>