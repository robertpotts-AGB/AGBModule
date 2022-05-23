<?php
	define('debug',false);	// settare a true per l'output di debug

	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
	require_once('Common/Fun_FormatText.inc.php');


    $ToCode = '';

	$Select
        = "SELECT ToCode,ToName "
        . "FROM Tournament "
        . "WHERE ToId=" . StrSafe_DB($_SESSION['TourId']) . " ";
	$Rs = safe_r_sql($Select);

	if (safe_num_rows($Rs) == 1) {
        $row = safe_fetch($Rs);
        $ToCode = $row->ToName;

    }

	$MyQuery =
    $result = "SELECT EnId,EnOnlineId,EnTournament,EnDivision,EnClass,EnSubClass,EnAgeClass,EnCountry,EnCode,EnName,EnFirstName,EnAthlete,EnSex,QuScore,ToName FROM Entries,Qualifications,Tournament WHERE EnFirstName = 'Hall' AND QuID = EnID AND ToId = EnTournament AND EnTournament= " . StrSafe_DB($_SESSION['TourId']) . " ";
	
    $Rs = safe_r_sql($MyQuery);
	//echo $MyQuery;exit;
	$StrData = '';

	if (safe_num_rows($Rs) > 0) {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Content-Disposition: attachment; filename=' . ($ToCode != '' ? $ToCode : 'export') . '.txt');
        header('Content-type: text/tab-separated-values; charset=' . PageEncode);

        $MyHeader
            .= ("AGB Number") . "\t"
            . ("FirstName") . "\t"
            . ("Surname") . "\t"
            . ("Bowstyle") . "\t"
            . ("Division") . "\t"
            . ("Day1Score") . "\t"
            . ("Day1Tens") . "\t"
            . ("Day1Xs") . "\t"
            . ("Day2Score") . "\t"
            . ("Day2Tens") . "\t"
            . ("Day2Xs") . "\t"
            . ("Ranking Round Score") . "\t"
            . ("10's") . "\t"
            . ("X's") . "\t"
            . ("Head 2 Head Position") . "\t";


        $MyHeader .= "\n";

        print $MyHeader;

        while ($MyRow = safe_fetch($Rs)) {
            $StrData
                .= $MyRow->EnOnlineId . "\t"
                . $MyRow->EnTournament . "\t"
                . $MyRow->EnDivision . "\t"
                . $MyRow->EnClass . "\t"
                . $MyRow->EnSubClass . "\t"
                . $MyRow->EnAgeClass . "\t"
                . $MyRow->EnCountry . "\t"
                . $MyRow->EnCode . "\t"
                . $MyRow->EnName . "\t"
                . $MyRow->EnFirstName . "\t"
                . $MyRow->EnAthlete . "\t"
                . $MyRow->EnSex . "\t"
                . $MyRow->QuScore . "\t"
                . $MyRow->ToName . "\t";

            $StrData .= "\n";
        }

        print $StrData;
    }


?>