<?php

    global $rf;
    global $loguser;

    if ((@$_SESSION['Nivel'] == 'admin')||(@$_SESSION['Nivel'] == 'plus')) { 
                $loguser = $_SESSION['ref']; 
              }
    elseif ((@$_SESSION['uNivel'] == 'adminu')||(@$_SESSION['uNivel'] == 'useru')) { 
                $loguser = $_SESSION['uref'];
              }
    else { $loguser = $rf; }

    global $logdate;
    $logdate = date('Y_m_d');
    global $filename;
    $filename = "../Gch.Log/".$logdate."_".$loguser.".log";
    $log = fopen($filename, 'ab+');
    fwrite($log, $logtext);
    fclose($log);

?>