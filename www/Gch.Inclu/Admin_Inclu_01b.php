<?php
require 'misdatos.php';
?>

<!DOCTYPE html>
	
<head>
	
<meta http-equiv="content-type" content="text/html" charset="<?php print($meta_type_charset);?>" />
<meta http-equiv="Content-Language" content="<?php print($meta_lang_cotent2);?>">
<meta name="Language" content="<?php print($meta_lang_cotent);?>">
<meta name="description" content="<?php print($meta_desc_cotent);?>" />
<meta name="keywords" content="<?php print($meta_key_cotent);?>" />
<meta name="robots" content="<?php print($meta_robots_cotent);?>" />
<meta name="audience" content="<?php print($meta_audience_cotent);?>" />
<title><?php print($meta_titulo);?></title>
	
<link href="../Gch.Css/conta.css" rel="stylesheet" type="text/css" />
<link href="../Gch.Css/menu.css" rel="stylesheet" type="text/css" />
<link href="../Gch.Css/menuico.css" rel="stylesheet" type="text/css" />

<link href="../Gch.Img.Sys/favicon.png" type='image/ico' rel='shortcut icon' />

<script type="text/JavaScript">

function limitac(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("coment");
 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }
 
  if(codigoCaracter == 8 || codigoCaracter == 46) {
    return true;
  }
  else if(elemento.value.length >= maximoCaracteres ) {
    return false;
  }
  else {
    return true;
  }
}
 
function actualizaInfoc(maximoCaracteres) {
  var elemento = document.getElementById("coment");
  var info = document.getElementById("infoc");
 
  if(elemento.value.length >= maximoCaracteres ) {
    info.innerHTML = "Máximo "+maximoCaracteres+" caracteres";
  }
  else {
    info.innerHTML = "You can write up to "+(maximoCaracteres-elemento.value.length)+" additional characters";
  }
}

</script>
</head>

<body topmargin="0">
<div id="Conte">

  <div id="head"> 
  			<span style="font-size:18px">
  							<?php print(strtoupper($head_titulo));?>
            </span>
  	</br>
  			<span style="font-size:12px">
  							<?php print(strtoupper($head_titulo2));?>
            </span>
   </div>

  				<div style="clear:both"></div>
   
<!--
////////////////////////////////
////////////////////////////////
	Inicio contenedor de datos.
////////////////////////////////
////////////////////////////////
-->

  <div id="Caja2Admin">


