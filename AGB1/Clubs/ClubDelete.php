<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once('Common/Fun_FormatText.inc.php');


$result = "DELETE FROM countries WHERE CoTournament = '". $_SESSION['TourId'] ."'";

$Rs = safe_r_sql($result);

?> 
