<?php

global $logdate;
$logdate = date('Y_m_d');
global $filename;
$filename = "../Gch.Log/".$logdate."_".$_SESSION['ref'].".log";
//echo $filename;
global $log;
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
fclose($log);

?>