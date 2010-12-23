<?php
/* 
 * Este es el archivo de configuracion del sistema
 */
 
 /* BASE DE DATOS */
 
 define('DB_SERVER', 'localhost'); // Servidor
 define('DB_SERVER_USERNAME', 'root'); // Nombre de usuario
 define('DB_SERVER_PASSWORD', 'NEWPASSWORD'); // contrase a base de datos
 define('DB_DATABASE', 'memall'); // Base de datos
 define('DOMAIN', 'www.liderbs.com'); // Dominio
 
 /* Pagina Principal*/
 
 /*BOX*/
 define ('INDEX_BOXTITLE_1', 'anuncio');
 define ('INDEX_BOXCONTENT_1', 'contenido');
 define ('INDEX_BOXIMAGE_1', 'carrito.jpeg');
 
 /* SISTEMA */
 
 define ('DIR_LIBS','libs/');
 define ('DIR_LANGUAGE', DIR_LIBS.'lang/');

/*tables definition*/

/*routes definition*/
define('SOURCE_ROOT', 'libs/');

function redirect($page){
    header("location:$page");
};

?>
