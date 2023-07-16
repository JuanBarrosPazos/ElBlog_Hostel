
<?php

$sqld =  "SELECT * FROM `gch_admin` WHERE `ID` = '$_POST[ID]'";
$qd = mysqli_query($db, $sqld);
$rowd = mysqli_fetch_assoc($qd);

/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>