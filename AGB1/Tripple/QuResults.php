<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once('Common/Fun_FormatText.inc.php');
require_once('LRQuResults.php');
require_once('MRQuResults.php');
require_once('LCQuResults.php');
require_once('MCQuResults.php');



// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}



?> 