<?php

if(isset($_POST['oculto'])){
    $defaults = $_POST;
    }
    elseif(isset($_POST['todo'])){
        $defaults = $_POST;
        } else {
                $defaults = array (	'Nombre' => '',
                                    'Apellidos' => '',
                                    'Orden' => isset($ordenar));
                             }

if ($errors){
    print("	<table align='center'>
                <tr>
                    <th style='text-align:center'>
                        <font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
                    </th>
                </tr>
                <tr>
                <td style='text-align:left'>");
        
            for($a=0; $c=count($errors), $a<$c; $a++){
                print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
                }
    print("</td>
            </tr>
            </table>");
                }
    
$ordenar = array (	'`id` ASC' => 'ID ASC',
                    '`id` DESC' => 'ID DSC',
                    '`Nombre` ASC' => 'NOMBRE ASC',
                    '`Nombre` DESC' => 'NOMBRE DSC',
                    '`Apellidos` ASC' => 'APELLIDO ASC',
                    '`Apellidos` DESC' => 'APELLIDO DSC',
                        );

if (($_SESSION['Nivel'] == 'admin')){ 

print(" <div class=\"BorderSup\" style=\"text-align:center; display:block; margin-top:8px; border-top: #fff solid 1px;\">
                        ".$uptitulo."
            <div class=\"BorderInf\" style=\"text-align:center; display:block; padding: 8px 0px 8px 0px;\">
                        ".$titulo."
            </div>
            
    <div  style='width:auto; text-align:center; padding: 8px 0px 8px 0px;'>
        <form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
            <div style='display:inline-block;'>
                        <input type='submit' value='USER CONSULTA' />
                        <input type='hidden' name='oculto' value=1 />
            </div>
            <div style='display:inline-block;'>
                <input type='text' name='Nombre' size=20 maxlenth=10 value='".@$defaults['Nombre']."'placeholder='NOMBRE' />
                <input type='text' name='Apellidos' size=20 maxlenth=10 value='".@$defaults['Apellidos']."'placeholder='APELLIDO' />
            </div>
        </form>	
    </div>

        <div  style='width:auto; text-align:center;'>
    <form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
                    <input type='submit' value='USER TODOS' />
                    <input type='hidden' name='todo' value=1 />

                    <select name='Orden'>");
                    
            foreach($ordenar as $option => $label){
                
                print ("<option value='".$option."' ");
                
                if($option == @$defaults['Orden']){ print ("selected = 'selected'"); }
                                                print ("> $label </option>");
                                            }	
        print ("	</select>
            </form>														
                    </div>
        </div>");
                }	// CONDICIONAL NIVEL ADMIN

?>