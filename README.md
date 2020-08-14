# ElBlog_Hostel 
## ElBlog_Hostel.F03.V21b ESTABLE

----

## EN EL DIRECTORIO Gch.Tutorial SE ENCUENTRA UNA GUÍA GENERAL DE LA APP.

----

### 2020.08.14

* SE HA SUSTITUIDO LA PRESENTACIÓN DE IMAGENTES POR UN LIGHTBOX
* SE CONSERVA LA CONFIGURACIÓN ANTERIOR EN Gch.Artic/Inc_porfolio (SinLightBox).php y en Gch.Www/portfolio (SinLightBox).php
* SE HAN MODIFICADO CUESTIONES DE CODIGO RELATIVA A INICIO Y CIERRE DE SESION.
* SE HAN INCLUIDO LOS ARCHIVOS NECESARIOS PARA LIGHTBOX EN Gch.Www/

* SE RECOMIENDA SOBREESCRIBIR: Gch.Www, Gch.Users, Gch.Artic, Gch.Syst, Gch.Config y css.
* MODIFICADO index_Play_System(Docker).php SOBREESCRIBIR Y RENOMBRAR A index.php.

----

### 2020.08.13

* SE HAN MODIFICADO CUESTIONES DE MAQUETACIÓN ORIENTATAS A FRONT END MOVIL FIRST

* SE RECOMIENDA SOBREESCRIBIR: Gch.Www, Gch.Users, Gch.Artic.

----

### 2020.08.12

* SE HAN MODIFICADO CUESTIONES DE MAQUETACIÓN ORIENTATAS A FRONT END MOVIL FIRST
* SE HAN CREADO NUEVOS ARCHIVOS Y DEPENDENCIAS

* SE RECOMIENDA SOBREESCRIBIR: Gch.Www, Gch.Users, Gch.Syst, Gch.Css.

----

### 2020.08.11

* SE HA SOLUCIONADO VARIOS ERRORES CRITICOS Y CUESTIONES DE DISEÑO.

* SE RECOMIENDA SOBREESCRIBIR: Gch.Www, Gch.Users, Gch.Syst, Gch.Artic, Gch.Css, vendor y css.

----

### 2020.08.04

* SE HA SOLUCIONADO UN ERROR CRITICO.

* SE RECOMIENDA SOBREESCRIBIR: Gch.Www, Gch.Users, Gch.Syst y Gch.Artic.

----

### 2020.08.04

* SE RECOMIENDA SOBREESCRIBIR: Gch.Www, Gch.Users y Gch.Artic.

* Modificado index_Play_System(Docker).php (y otros relacionados) sobreescribir y renombrar a index.php.

* Se graba la fecha y hora de acceso / salida, de los usuarios comunes y el número de accesos de cada usuario.

----

### 2020.08.02

* SE RECOMIENDA SOBREESCRIBIR: Gch.Users y Gch.Artic.

----

### 2020.08.01

* SE RECOMIENDA BORRAR Y RECARGAR:

- Gch.Syst y Gch.Users

* Se ha modificado la gestión de usuarios generales del frontpage y su backend asociado, y adaptado a sus derechos legales ARCO.
----

### 2020.07.28

* SE RECOMIENDA SOBREESCRIBIR:

- Gch.Artic, Gch.Syst, Gch.Users, Gch.Inclu, css, Gch.Css, vendor, Gch.Www.

----

### 2020.07.26

* SE HA ACTUALIZADO:

1. El calculo de la valoración de restaurantes.

2. Visualización de opiniones del frontend.

* Se recomienda sobreescribir los directorios: Gch.Artic, Gch.Syst, Gch.Users, Gch.Inclu.

----

### 2020.07.26

* SE HA ACTUALIZADO:
1. La modificación de las 4 imágenes de los restaurantes y su interface de usuario.
2. El borrado de restaurantes y sus imágenes correspondientes de forma automática.
3. Al borrar un restaurante se eliminan todos los comentarios relacionados.
4. La creación de restaurantes y creación de sus 4 imágenes, con una imágen por defecto para las img2, 3 o 4, que no son obligatorias.
5. La validación en la modificación de datos de restaurantes.
6. Modificado index_Play_System(Docker).php (y otros relacionados) sobreescribir y renombrar a index.php.
7. Al borrar un administrador se modifica su referencia en la tabla restaurantes y opiniones por admindel.
8. Se ha modificado el formulario de número de administradores permitidos y su validación.

* Se recomienda sobreescribir los directorios: Gch.Artic, Gch.Www, Gch.Config, Gch.Users, Gck.Admin.
* O borrarlos y cargarlos de nuevo.

----

### 2020.07.25

* Se han creado nuevos archivos para la actualización de la valoraciones y se ha modificado todo lo relacionado con las valoraciones.

* Se ha actualizado la modificación de las 4 imágenes de los restaurantes.

* Se recomienda sobreescribir los directorios: Gch.Artic, Gch.Syst, Gch.Inclu, Gch.Admin, Gch.Css.

* 

----

### 2020.07.23

* Se ha modificado la creación, modificación y validación de restaurantes, así como el calculo de valoraciones y precios.

* Se recomienda sobreescribir el directorio Gch.Artic/

----

### 2020.07.21

* Se ha actualizado la zona de administración, creación de restaurantes y cálculo de valoraciones.

* Se recomienda sobreescribir los directorios: Gch.Artic, Gch.Syst, Gch.Users, Gch.Wwww, Gch.Config.

* Copiar index_Play_System(Docker).php y renombrar a index.php

----

### 2020.07.20

* Se ha integrado los admin del sistema en admin user

* Se ha modificado la exportación de bbdd y tablas.

* Se recomienda sobre escribir Gch.upbbdd/

----

### 2020.07.17 

* Se comienza la integración del antiguo proyecto con el proyecto Borja Moll.

* Se implementará la opcion de Docker con el constructor de php para bbdd y directorios sin dockerizar.

* Se inicia el sistema dockerizado con un usuario user/user y un administrador WebMaster admin/admin

* Si no se dockeriza, se crearán los usuarios de sistema siguiendo los pasos comunes.

----

## Si dockerizo: 

*index_Play_System(Docker).php cambio nombre a index.php
* Los directorios con nombre xxx(Docker) son para uso exclusivo de docker, habrá que cambiar el nombre. quitando la parte (Docker)
* Contienen las imágenes necesarias para iniciar la dockerización con datos.
docker-compose build + docker-compose pull -d

## Si no dockerizo: 
* Index_Init_System(NoDocker).php cambio nombre a index.php
* Sigo los pasos de instalación del constructor php
* Los archivos que necesito están en www/ y los que pongan (Docker) o algo similar los puedo eliminar si quiero.

----

# ESTA ES UNA VERSIÓN DE INSTALACIÓN COMPLETA.

----

## BMoll.Proy.End.V01.Beta17 2020.06.26

- Se ha reparado error exportación de tablas Gch.upbbdd/export_bbdd.php, se puede sobreescribir todo el directorio
- Se ha modificado el directorio Gch.Syst.
  (se puede sobreescribir el directorio)
- Se ha configurado la confirmación de borrado de ayuntamiento y todos los articulos relacionados y sus imágenes.
- Se ha configurado la confirmación de borrado de isla y todos los ayuntamientos, y articulos relacionados así como sus imágenes.


*** BMoll.Proy.End.V01.Beta15/16 2020.06.25

- Se ha modificado el directorio Gch.Syst.
  (se recomienda borrar directorios y recargarlos)
- Se han exportado bbdd y tablas desde el sistema funcionando y se ha comprobado el correcto funcionamiento de esta tarea en producción.
- 

*** BMoll.Proy.End.V01.Beta14 2020.06.24

- Se ha configurado la exportación de bbdd automática los días 6, 12, 18, 24,30; y manual completa o selecctiva por tablas.
- Se ha comprobado el funcionamiento de exportación de log del sistema de usuarios (pendiente de completar configuración).
- Se han configurado los menús de usuario según categorías de usuarios.
- Se ha modificado el directorio Gch.Admin, Gch.Inclu, Gch.upbbdd, img.
  (se recomienda borrar los directorios y recargarlos)

*** BMoll.Proy.End.V01.Beta13 2020.06.23

- Se ha configurado la moderación y eliminación del opiniones, por restaurantes y por tipo de moderación.
- Se han modificado los archivos index.php (relativo a instalación inicial) require 'Gch.Config/Inc_Crear_Tablas.php';
- Se ha creado Gch.Config/Inc_Crear_Tablas.php
- Se ha modificado la estructura de las bbdd en las tabla Gch.opiniones, en el archivo Gch.Config/Inc_Crear_Tablas.php
  (relativo a instalación inicial)
  Se recomienda consultar la función: function crear_tablas(){... de dicho archivo y cotejar la estructura de dicha tabla
  con la bbdd.
	$opiniones = "CREATE TABLE IF NOT EXISTS `$db_name`.`gch_opiniones` (
  		...
  		`refuser` varchar(22) collate utf8_spanish2_ci NOT NULL default 'anonymous',
  		...
  		`datemod` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  		...

- Se ha modificado el directorio Gch.Artic, Gch.Css, Gch.Sys.
  (SE RECOMIENDA BORRAR Gch.Sys COMPLETO Y VOLVER A CARGARLO)
  (sólo sería necesario sobreescribir los directorios, en relación a la versión anterior)

----

*** BMoll.Proy.End.V01.Beta12 2020.06.22

- Se ha modificado el directorio Gch.Artic, Gch.Www, Gch.Sys.
  (sólo sería necesario sobreescribir los directorios, en relación a la versión anterior)
- Se ha creado la opción crear comentarios para usuarios sin registrar en el frontpage, estos comentarios estarán 
  pendientes de moderación hasta que el webmaster los permita.
- Se ha implementado en new paginación con filtro las valoraciones y puntuaciones.
- Se han implementado los botones de ver opiniones y valorar en todo el frontpage.

----

*** BMoll.Proy.End.V01.Beta11 2020.06.21

- Se ha modificado el directorio Gch.Img.Sys añadiendo las imágenes necesarias para las valoraciones.
  (sólo sería necesario sobreescribir los directorios, en relación a la versión anterior)
- Se ha modificado el directorio Gch.Artic, Gch.Www, Gch.Css, Gch.Sys.
- Se ha creado la valoración por estrellas en frontpage, y el script de cálculo asociado.
- Se ha modificado la estructura de las bbdd en las tablas Gch.opiniones, en los archivos index.php (relativo a instalación inicial)
  Gch.Config/Index_Init_System.php, Gch.Config/config.php.
  Se recomienda consultar la función: function crear_tablas(){... L.504 de dichos archivos y cotejar la estructura de dichas tablas con
  la bbdd.

*** BMoll.Proy.End.V01.Beta10 2020.06.20

- Se ha modificado el directorio Gch.Artic y Gch.Amin
- Modificación imágenes y contenido restaurantes, eliminación entradas restaurantes.
  (sólo sería necesario sobreescribir los directorios, en relación a la versión anterior).
- Se ha creado el nuevo directorio Gch.Sys, desde el que se gestionarán las tablas de comentarios, islas, aytos,
  tipologías de negocios, especialidades. (en construcción).


----

*** BMoll.Proy.End.V01.Beta09 2020.06.19

- Modificado el código de paginación.
- Creación del archivo Gch.Artic/Inclu_Name_Ref_to_Name.php y sus dependencias
- Modificación del backend restaurantes.
- Eliminados de Gch.Artic/(Inc_Logica_01.php + Inc_Show_Form_01_Val.php).
- Se ha modificado el directorio Gch.Artic y Gch.Amin
  (sólo sería necesario sobreescribirlo, en relación a la versión anterior).

----

*** BMoll.Proy.End.V01.Beta08 2020.06.18

- Se han construido los filtros de font page con formulario por isla, ayuntamiento, categoria, especialidad.
- Sólo se ha modificado el directorio Gch.Artic
  (sólo sería necesario sobreescribirlo, en relación a la versión anterior).

----

* EL ARCHIVO INDEX.PHP DE LA INSTALACIÓN "CONEXIÓN BBDD" INICIAL SE ELIMINA Y SE SUSTITUYE POR CONFIG/INDEX_PLAY_SYSTEM.PHP

----

** ARCHIVOS QUE NO SE TIENEN QUE SOBRE ESCRIBIR SI LA APLICACIÓN ESTA EN PRODUCCIÓN EN EL SERVIDOR:

* INDEX.PHP
* Gch.Connet/conection.php
* Gch.Config/ayear.php
* Gch.Config/year.txt
* Gch.Inclu/mydni.php
* Gch.Admin/nemp.php
* LOS DIRECTORIOS DE USUARIO Y SUS ARCHIVOS LOS GENERA/ELIMINA EL SISTEMA AUTOMÁTICAMENTE.

** DICHO ESTO, DICHO TODO. 

----

2020.06.17

A PARTIR DE LA VERSION BETA 07 SE HA MODIFICADO LA ESTRUCTURA DE LA BBDD EN LA TABLA gch_art AÑADIENDO CUATRO CAMPOS MÁS.
SE PUEDE CONSULTAR EL ARCHIVO index.php de la instalación nativa o Gch.Config/Index_Init_System.php
EN LA CONSTRUCCIÓN DE gch_art, PARA CONOCER LA CONFIGURACIÓN DE LOS NUEVOS CAMPOS
O PROCEDER A UNA INSTALACIÓN DESDE CERO.

----

EN ESTA APP CUANDO HABLAMOS DE ISLAS PODRÍAMOS INTERPRETARLO COMO PROVINCIAS.
Y AYUNTAMIENTOS SEGUIR LA MISMA DINÁMICA.
DE ESTA FORMA PODRÍAMOS UTILIZAR LA APP DENTRO DE CUALQUIER CONTEXTO POSIBLE.

----

1º. DESCOMPRIMIR EL ZIP O RAR CON TODOS LOS ARCHIVOS.

2º. COPIAR EL DIRECTORIO CON TODOS LOS ARCHIVOS EN EL SERVIDOR REMOTO O LOCAL.

3º. ACCEDER A ARCHIVO DE CONEXIONES EN RUTASERVER/index.php

    - Mediante este archivo se configura la conexión a la bbdd y se crean las carpetas que 
      necesita el sistema, para poder trabajar.
      Gch.Config/index_Init_System.php actua como copia de index.php con las mismas RUTASERVER
      Gch.Config/config.php actua como index.php desde la ruta Gch.Config/

    - Gch.Config/config2.php
      Se accede directamente a él depués de haber superado el paso anterior y haber generado
      los archivos de conexión al servidor y las tablas de bbdd.
      Mediante este archivo crearemos el primer administrador con categoría de WebMaster.

4º. UNA VEZ SUPERADOS ESTOS DOS PASOS CON ÉXITO PODREMOS ACCEDER AL LOGIN ZONA DE ADMINISTRACIÓN:
    
    - Mediante el enlace que se muestra tras crear el primer admin o webmaster.

    - En la ruta: RUTASERVER/Gch.Admin/access.php
    
    - EL index.php QUE NOS HA PROPORCIONADO LA CONEXIÓN A BBDD Y LA GENERACIÓN DE TABLAS 
      ES ELIMINADO POR EL SISTEMA Y REEMPLAZADO POR UN NUEVO index.php (Gch.Config/index_Init_System.php)
      Y NOS PRESENTA EL FRONT PAGE DEL BLOG.

5º. EN CASO DE DETECTARSE UNA INSTALACIÓN ANTERIOR, SEGUIR LOS PASOS QUE NOS INTERESEN.

6º. 
