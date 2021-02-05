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
    
$ordenar = array (	'' => 'ORDENAR POR',
                    '`id` ASC' => 'ID Ascen',
                    '`id` DESC' => 'ID Descen',
                    '`Nombre` ASC' => 'Nombre Ascen',
                    '`Nombre` DESC' => 'Nombre Descen',
                    '`Apellidos` ASC' => 'Apellido Ascen',
                    '`Apellidos` DESC' => 'Apellido Descen',
                                                            );

if ((@$_SESSION['uNivel'] == 'adminu')||($_SESSION['Nivel'] == 'admin')){ 

print(" <div class=\"juancentramail col-xs-12 col-sm-12 col-lg-6\" >
            <div style=\"text-align:center;\">
                        ".$titulo."
            </div>
            
    <form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
                    
                <div style=\"text-align:left; display:inline-block;\">
                    <input type='submit' value='USER CONSULTA' style=\"width:140px;\" />
                    <input type='hidden' name='oculto' value=1 />
                </div>
                <div style=\"display:inline-block;\">
                    <select name='Orden'>");
                    
            foreach($ordenar as $option => $label){
                
                print ("<option value='".$option."' ");
                
                if($option == @$defaults['Orden']){ print ("selected = 'selected'"); }
                                                print ("> $label </option>");
                                            }	
        print ("	</select>
                        </div>

            <div style=\"clear:both\"></div>

                <div style=\"text-align:left; display:inline-block;\">
                    <label>	
                        Nombre:
                    </label>
            <input type='text' name='Nombre' size=20 maxlenth=10 value='".@$defaults['Nombre']."' />
                </div>  
        
                <div style=\"text-align:left; display:inline-block;\">
                <label>
                    Apellido:
                </label>	
            <input type='text' name='Apellidos' size=20 maxlenth=10 value='".@$defaults['Apellidos']."' />
                </div>
            </form>	
            
        <div style=\"clear:both\"></div>

    <form name='todo' method='post' action='$_SERVER[PHP_SELF]' >

                <div style=\"text-align:left; display:inline-block; width:140px;\">
                    <input type='submit' value='USER VER TODOS' />
                    <input type='hidden' name='todo' value=1 />
                </div>
                <div style=\"display:inline-block; margin-left:6px;\">
                    <select name='Orden'>");
                    
            foreach($ordenar as $option => $label){
                
                print ("<option value='".$option."' ");
                
                if($option == @$defaults['Orden']){ print ("selected = 'selected'"); }
                                                print ("> $label </option>");
                                            }	
        print ("	</select>
                        </div>
            </form>														
        </div>");
                }	// CONDICIONAL NIVEL ADMIN

/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>