
<?php

	global $tablename;
	$tablename = "gch_art";
	$tablename = "`".$tablename."`";
	$sqla = "UPDATE `$db_name`.$tablename SET `ivalora` = '$valmartx100', `iprecio` = '$valmart2x100' WHERE $tablename.`refart` = '$refartval' LIMIT 1 ";
	if(mysqli_query($db, $sqla)){ } else { }

?>