<?php

		global $conte;
		$conte = substr($rowb['conte'],0,56);
		$conte = $conte." ...";	
		
		global $actionforma;
		global $formbotona;
		global $actionformb;
		global $formbotonb;

	print (	"<div style=\"margin-top:8px; padding-top: 0px; border-top: #fff solid 1px; border-bottom: #fff solid 1px; \">
									
	".$actionforma."

	<input name='id' type='hidden' value='".$rowb['id']."' />
	<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
	<input name='refart' type='hidden' value='".$rowb['refart']."' />
							
		<div class='whiletotala'>
			NOMBRE<br>
	<input name='tit' type='hidden' value='".$rowb['tit']."' />".strtoupper($rowb['tit'])."
		</div>

	<input name='titsub' type='hidden' value='".$rowb['titsub']."' />
	<input name='datein' type='hidden' value='".$rowb['datein']."' />
	<input name='timein' type='hidden' value='".$rowb['timein']."' />
	<input name='datemod' type='hidden' value='".$rowb['datemod']."' />
	<input name='timemod' type='hidden' value='".$rowb['timemod']."' />

		<div class='whiletotala'>
			ISLA<br>
	<input name='isla' type='hidden' value='".$rowb['refisla']."' />".strtoupper($rowb['refisla'])." / ".strtoupper($islaname)."
		</div>

		<div class='whiletotala'>
			AYUNTAMIENTO<br>
	<input name='ayto' type='hidden' value='".$rowb['refayto']."' />".strtoupper($rowb['refayto'])." / ".strtoupper($aytoname)."
		</div>

		<div class='whiletotala conte'>
			<span style=\"display:block; text-align:center;\">
				DESCRIPCION
			</span>
	<input name='conte' type='hidden' value='".$rowb['conte']."' />".strtoupper($conte)."
		</div>

		<div class='whiletotala'>
			<input name='myimg1' type='hidden' value='".$rowb['myimg1']."' />
			<img src='../Gch.Img.Art/".$rowb['myimg1']."' />
		</div>
		
	<input name='tipo' type='hidden' value='".$rowb['reftipo']."' />
	<input name='espec1' type='hidden' value='".$rowb['refespec1']."' />
	<input name='espec2' type='hidden' value='".$rowb['refespec2']."' />
	<input name='valora' type='hidden' value='".$rowb['ivalora']."' />
	<input name='precio' type='hidden' value='".$rowb['iprecio']."' />
	<input name='url' type='hidden' value='".$rowb['url']."' />
	<input name='map' type='hidden' value='".$rowb['map']."' />
	<input name='mapiframe' type='hidden' value='".$rowb['mapiframe']."' />
	<input name='latitud' type='hidden' value='".$rowb['latitud']."' />
	<input name='longitud' type='hidden' value='".$rowb['longitud']."' />
	<input name='calle' type='hidden' value='".$rowb['calle']."' />
	<input name='Email' type='hidden' value='".$rowb['Email']."' />
	<input name='Tlf1' type='hidden' value='".$rowb['Tlf1']."' />
	<input name='Tlf2' type='hidden' value='".$rowb['Tlf2']."' />

	".$formbotona.$actionformb."
	
	<input name='id' type='hidden' value='".$rowb['id']."' />
	<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
	<input name='refart' type='hidden' value='".$rowb['refart']."' />
	<input name='tit' type='hidden' value='".$rowb['tit']."' />
	<input name='titsub' type='hidden' value='".$rowb['titsub']."' />
	<input name='isla' type='hidden' value='".$rowb['refisla']." / ".$islaname."'' />
	<input name='ayto' type='hidden' value='".$rowb['refayto']." / ".$aytoname."' />
	<input name='myimg1' type='hidden' value='".$rowb['myimg1']."' />
	<input name='myimg2' type='hidden' value='".$rowb['myimg2']."' />
	<input name='myimg3' type='hidden' value='".$rowb['myimg3']."' />
	<input name='myimg4' type='hidden' value='".$rowb['myimg4']."' />

	".$formbotonb."

	</div>");


?>