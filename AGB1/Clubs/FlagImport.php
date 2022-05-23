<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');

$TID = $_SESSION['TourId'];


$InsertFlags=("INSERT INTO Flags (FlTournament, FlCode, FlSVG, FlJPG)
(SELECT '$TID', FlCode, FlSVG,FlJPG FROM Flags WHERE FlTournament='463') ")  ;
$InsertFlag = safe_r_sql($InsertFlags);


echo 'Flags Inserted';


