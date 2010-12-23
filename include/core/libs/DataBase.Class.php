<?php
/* 
 * MeMall corp 2008
 */

Class DataBase{


 public function __construct()  {
          
    }

function check($query){
// me conecto a la base de datos
 $link = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD)or die(mysql_error());
 // selecciono la base de datos
 mysql_select_db(DB_DATABASE)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
 // ejecuto la consulta 
 $result = mysql_query($query, $link)or die (mysql_error());
 // devuelvo el resultado
 return $result;
 // cierro la conexion
 mysql_close($link);
    }

    function check_noreturn($query){
	// me conecto a la base de datos
    $link = mysql_connect(DB_SERVER, DB_SERVER_USERNAME,DB_SERVER_PASSWORD) or die (mysql_error());
	// selecciono la base de datos
	mysql_select_db(DB_DATABASE)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
	//Ejecuto la consulta
	mysql_query($query, $link)or die(mysql_error());
    //cierro la base de datos sin devolver valores
	mysql_close($link);
    }

/* Funcion para realizar una consulta validando el numero de resultados*/
    function validate($query){
	// me conecto a la base de datos
	$link = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD) or die (mysql_error());
    // selecciono la base de datos
	mysql_select_db(DB_DATABASE)or die ('Error al seleccionar la Base de Datos: '.mysql_error());
	// ejecuto la consulta
	$result = mysql_query($query, $link);
	// cuento el numero de filas de la consulta
    $count = mysql_num_rows($result);
	// retorno el resultado
    return $count;
    mysql_close($link);
    }
}

?>
