<?php

/**
 * Description of FundamentalClass
 * Fundamental class contiene una serie de funciones nesesarias para
 * el funcionamiento del sistema de memall, estas funciones son
 * propias del sistema y no prodran ser creadas por un usuario
 *
 * @author Javier Portilla
 */

class Fundamental{

    function getNations(){
    $sql = new DataBase();
    $query = "SELECT * FROM pai_pais";
    $result = $sql->check($query);
    return $result;
    }

    function getCategories(){
    $sql = new DataBase();
    $query = "SELECT * FROM categoria ORDER BY id_cat";
    $result = $sql->check($query);
    return $result;
    }
	
function redimensiona_imagen($archivo_nuevo, $dir,  $anchura, $altura){ 

//datos nesesarios para procesar  
//$archivo foto  a redireccionar 
//dir - directorio donde se guarda la foto 
//$anchura maxima 
//$azltura  maxima 

//creamos imagen nuevo apartir de cargado 
//ruta completa del archivo 
$uploadfile=$dir. basename($archivo_nuevo); 
$img_fuente=@imagecreatefromjpeg($uploadfile) 
or die("No se puede proceder"); 
//sacamos los datos de altura y anchura del imagen cargado 
//anchura 
$img_ancho=imagesx($img_fuente); 
//echo($img_ancho); 
             
//altura 
$img_alto=imagesy($img_fuente); 
//echo($img_alto); 

//sacamos la diferencia para averiguar forma de imagen 
$diferencia = $img_ancho/$img_alto;
 
//si la anchura es superior a la altura ajustamos anchura a establecido 
if($img_ancho>$anchura || $img_alto>$altura){ 

if($diferencia > 1){ 
    // crear imagen nueva 
    $img_nueva_anchura=$anchura; 
    $img_nueva_altura=$img_alto/($img_ancho/$anchura);      
//si altura es superior a la anchura  
}else if($diferencia < 1){ 
        $img_nueva_altura=$altura; 
        $img_nueva_anchura=$img_ancho/($img_alto/$altura);     
        //si el imagen es cuadrado restamos de altura ya anchura lo mismo 
}else if($diferencia==1){ 
        $dif=$img_ancho-$anchura; 
        $img_nueva_anchura=$anchura; 
        $img_nueva_altura=$img_alto-$dif;
}//end if-else 
// creamos  imagen nueva vacia con dimesiones adecuadas 
$thumb = imagecreatetruecolor($img_nueva_anchura,$img_nueva_altura) 
or die("No se ha podido ejecutar la función imagecreatetruecolor"); 
//redimensionamos el imagen 
imagecopyresampled ($thumb, $img_fuente, 0,0,0,0, $img_nueva_anchura, $img_nueva_altura, $img_ancho, $img_alto) 
or die("No se ha podido ejecutar la función imagecopyresampled"); 
// guardar la imagen redimensionada  

//asignamos permisos de escritura a la carpeta donde esta hubicado el archivo 
chmod($uploadfile, 0775);  
imagejpeg($thumb ,$uploadfile) 
or die("No se ha podido mover el archivo redimensionado a la carpeta."); 

            //echo "<b>Redireccionamiento ok!. Datos:</b><br>";  
            //echo "Nombre: <i><a href='".$uploadfile."'>".$uploadfile."</a></i><br>";  
            //echo "Anchura: <i>".$img_nueva_anchura."</i><br>";  
            //echo "Altura: <i>".$img_nueva_altura." bytes</i><br>";  
            //echo "<br><hr><br>";  
     }else{
		echo "<b>Redimensionamiento no procede!</b>. El imagen tiene tamaño adecuado.<br>";
     } //end if-else
}//end function




}
?>
