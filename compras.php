<?PHP
session_start();
include("include/core/main.php");
include("include/connection.php");
include("include/config.php");
if(!isset($_SESSION['validate'])){
header("location: entrar.php");
}else{
//variable memall
$memall = new Memall();
$cliente = new Cliente();
//variable de mensaje
$status = "";
$user = $_SESSION['validate'];
$idUser = $cliente->getId($user);

//register
if ($_POST["send"]){
//get the variables
$descripcionCorta =  mysql_real_escape_string($_POST["txtDesCorta"]);
$industria = mysql_real_escape_string($_POST["comboIndustria"]);
$categoria = mysql_real_escape_string($_POST["comboCategoria"]);
$palabrasClave =  mysql_real_escape_string($_POST["txtPalabrasClave"]);
$estado =  mysql_real_escape_string($_POST["comboEstado"]);

$descripcionDetallada =  mysql_real_escape_string($_POST["txtDescripcionDetallada"]);
$divisaRango =  mysql_real_escape_string($_POST["comboDivisaRango"]);

$deRango =  mysql_real_escape_string($_POST["txtDe"]);
$hastaRango =  mysql_real_escape_string($_POST["txtHasta"]);
$cantidadRequerida =  mysql_real_escape_string($_POST["txtCantidadRequerida"]);
$unidadRequerida =  mysql_real_escape_string($_POST["comboUnidadRequerida"]);
$certificacion =  mysql_real_escape_string($_POST["txtCertificacion"]);

//echo $cantidadRequerida;

//$privacidad =  mysql_real_escape_string($_POST["txtProducto"]);

//procesar los datos
//Validar Campos Vacios
if($descripcionCorta==NULL|$industria==NULL|$categoria==NULL|$palabrasClave==NULL|$estado==NULL|$descripcionDetallada==NULL|$divisaRango==NULL|$deRango==NULL|$hastaRango==NULL|$cantidadRequerida==NULL|$unidadRequerida==NULL|$certificacion==NULL){
$status = "<span class='letrasIncorrecto'><label><strong>Debe llenar todos los campos requeridos.</strong></label></span>";
}else{
//subo la imagen
//imagen
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 

//compruebo si las características del archivo son las que deseo 
if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 200000))) { 
    $status = "La extensión o el tamaño de los archivos no es correcta."; 
}else{ 
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], "usuarios/compras/".$user."_".$nombre_archivo)){ 
       $status = "El archivo ha sido cargado correctamente."; 
	   $fund = new Fundamental();
	   $fund->redimensiona_imagen($user."_".$nombre_archivo, "usuarios/compras/",  "130", "100");	   
    }else{ 
       $status = "<span class='letrasIncorrecto'><label><strong>Error al almacenar la imagen, revise el formato y tamaño.</strong></label></span>"; 
    }//end if file not uploades
}//end if extension o size problems
//nombre de la imagen
$rutaimagen = "usuarios/compras/".$user."_".$nombre_archivo;
//registrar la Compra
$cliente->registrarCompra($idUser, $descripcionCorta, $industria, $categoria, $palabrasClave, $estado, $rutaimagen, $descripcionDetallada, $divisaRango, $deRango, $hastaRango, $cantidadRequerida, $unidadRequerida, $certificacion);

$status = "<span class='letrasCorrecto'><label><strong>La compra ha sido registrado correctamente.</strong></label></span>"; 

}//end campos vacios
}//end post
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
<link href="css/users.css" rel="stylesheet" type="text/css" />
<script src="scripts/jquery-1.4.2.min.js" type="text/javascript"></script> 
<script src="scripts/jquery.validate.js" type="text/javascript"></script>
<style type="text/css">
<!--
.style1 {color: #000000}
.letrasCorrecto{color: #00CC00}
.letrasIncorrecto{color:#FF0000}
-->
</style>
<script language="JavaScript">

function addOpt(oCntrl, iPos, sTxt, sVal){
     var selOpcion=new Option(sTxt, sVal);
     eval(oCntrl.options[iPos]=selOpcion);
   }
   
function cambia(oCntrl){
    while (oCntrl.length) oCntrl.remove(0);
    switch (document.formulario.comboIndustria.selectedIndex){
     case 0: 
	   addOpt(oCntrl,  0, "Seleccionar", "0");
	  break;
	  case 1: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Semillas", "1");
	   addOpt(oCntrl,  2, "Aceite Animal/Plantas", "2");
	   addOpt(oCntrl,  3, "Maquinaria Agricola", "3");
	   addOpt(oCntrl,  4, "Frutas y Verduras Frescas", "4");
	  break;
	  case 2: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Bebidas Alcoholicas", "39");
	   addOpt(oCntrl,  2, "Mariscos/Comida de Mar", "40");
	   addOpt(oCntrl,  3, "Dulces y Chocolates", "41");
	   addOpt(oCntrl,  4, "Salsas y Condimentos", "42");
	   addOpt(oCntrl,  5, "Bebidas Gaseosas", "43");
	   addOpt(oCntrl,  6, "Embutidos", "44");
	   addOpt(oCntrl,  7, "Carnes", "45");
	   addOpt(oCntrl,  8, "Pollo", "46");
	   addOpt(oCntrl,  9, "Pasapalos y Fritos", "47");
	   addOpt(oCntrl,  10, "Comida Rapida", "48");
	   addOpt(oCntrl,  11, "Pizzas", "49");
	   addOpt(oCntrl,  12, "Tortas y Pasteles", "50");
	  break;
	  case 3: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Celulares", "35");
	   addOpt(oCntrl,  2, "Camaras digitales", "36");
	   addOpt(oCntrl,  3, "Televisores", "37");
	   addOpt(oCntrl,  4, "Equipos de Sonido", "38");
	   break;
	   case 4: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Repuestos Varios", "5");
	   addOpt(oCntrl,  2, "Cauchos", "6");
	   addOpt(oCntrl,  3, "Herramientas de Diagnostico", "7");
	   addOpt(oCntrl,  4, "Audio y Sonido", "8");
	   addOpt(oCntrl,  5, "Sistema de Iluminacion", "9");
	   addOpt(oCntrl,  6, "Aire Acondicionado", "10");
	   addOpt(oCntrl,  7, "Papel Ahumado", "11");
	   addOpt(oCntrl,  8, "Mecanica General", "12");
	   break;
	   case 5: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Laptops", "23");
	   addOpt(oCntrl,  2, "Desktops", "24");
	   addOpt(oCntrl,  3, "Networking/Accesorios", "25");
	   addOpt(oCntrl,  4, "Sistemas Administrativos", "26");
	   addOpt(oCntrl,  5, "Software Construccion", "27");
	   addOpt(oCntrl,  6, "Software", "28");
	   break;
	   case 6: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Cemento", "29");
	   addOpt(oCntrl,  2, "Puertas", "30");
	   addOpt(oCntrl,  3, "Baños", "31");
	   addOpt(oCntrl,  4, "Bloques", "32");
	   addOpt(oCntrl,  5, "Ceramicas", "33");
	   addOpt(oCntrl,  6, "Cabillas", "34");
	   break;
	   case 7: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Fitness y Gimnasio", "57");
	   addOpt(oCntrl,  2, "Implementos deportivos", "58");
	   break;
	   case 8: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Empacado de Alimentos", "59");
	   addOpt(oCntrl,  2, "Empacado de Papeles", "60");
	   addOpt(oCntrl,  3, "Empacado de Regalos", "61");
	   addOpt(oCntrl,  4, "Cajas para Empacar", "62");
	   addOpt(oCntrl,  5, "Bolsas para Empacar", "63");
	   addOpt(oCntrl,  6, "Envases de Vidrio", "64");
	   addOpt(oCntrl,  7, "Empaques Tetrapak", "65");
	   addOpt(oCntrl,  8, "Empaques Plasticos", "66");
	   addOpt(oCntrl,  9, "Impresion de Bolsas", "67");
	   addOpt(oCntrl,  10, "Impresiones Diversas", "68");
	   break;
	   case 9: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Pianos y Teclados", "101");
	   break;
	   case 10: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Papel para oficina", "79");
	   addOpt(oCntrl,  2, "Lapices y Boligrafos", "80");
	   addOpt(oCntrl,  3, "Cartuchos para Impresora", "81");
	   addOpt(oCntrl,  4, "Proyectores", "82");
	   addOpt(oCntrl,  5, "Archivadores", "83");
	   addOpt(oCntrl,  6, "Papeleria Facturacion", "84");
	   break;
	   case 11: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Alcalinos", "69");
	   addOpt(oCntrl,  2, "Intermedios Organicos", "70");
	   addOpt(oCntrl,  3, "Preservativos", "71");
	   addOpt(oCntrl,  4, "Endulzantes", "72");
	   addOpt(oCntrl,  5, "Pinturas", "73");
	   addOpt(oCntrl,  6, "Recubrimiento para Construccion", "74");
	   addOpt(oCntrl,  7, "Vitaminas, Aminoacidos y Enzimas", "75");
	   addOpt(oCntrl,  8, "NULL", "76");
	   break;
	   case 12: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Abono Organico", "77");
	   addOpt(oCntrl,  2, "Agroquimicos", "78");
	   break;
	   case 13: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Muñecas", "85");
	   addOpt(oCntrl,  2, "Figuras de Accion", "86");
	   addOpt(oCntrl,  3, "Juguetes Educativos", "87");
	   addOpt(oCntrl,  4, "Juguetes a Radio Control", "88");
	   addOpt(oCntrl,  5, "Juguetes Inflables", "89");
	   addOpt(oCntrl,  6, "Estructuras Externas para Niños", "90");
	   addOpt(oCntrl,  7, "Juguetes de Madera", "91");
	   addOpt(oCntrl,  8, "Juguetes para bebes", "92");
	   break;
	   case 14: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Procesamiento de Alimentos", "108");
	   addOpt(oCntrl,  2, "Extrusoras Plasticas", "109");
	   addOpt(oCntrl,  3, "Maquinaria de Empacado", "110");
	   addOpt(oCntrl,  4, "Maquinaria de Impresion", "111");
	   break;
	   case 15: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Bolsos y Carteras", "116");
	   addOpt(oCntrl,  2, "Cinturones", "117");
	   break;
	   case 16: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Muebles Antiguos", "51");
	   addOpt(oCntrl,  2, "Muebles para Niños", "52");
	   addOpt(oCntrl,  3, "Muebles para el Hogar", "53");
	   addOpt(oCntrl,  4, "Muebles para Hoteles", "54");
	   addOpt(oCntrl,  5, "Muebles de Oficina", "55");
	   addOpt(oCntrl,  6, "Muebles de Rattan", "56");
	   break;
	   case 17: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Decoracion del Hogar", "112");
	   addOpt(oCntrl,  2, "Regalos de Navidad", "113");
	   addOpt(oCntrl,  3, "Articulos de Cristal", "114");
	   addOpt(oCntrl,  4, "Insumos para Fiestas", "115");
	   break;
	   case 18: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Cosmeticos", "102");
	   addOpt(oCntrl,  2, "Jabones", "103");
	   addOpt(oCntrl,  3, "Cuidado de la piel", "104");
	   addOpt(oCntrl,  4, "Shampoo", "105");
	   addOpt(oCntrl,  5, "Cirujia Estetica", "106");
	   addOpt(oCntrl,  6, "Medicamentos", "107");
	   break;
	   case 19: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Empacado e Impresion", "13");
	   addOpt(oCntrl,  2, "Publicidad en Medios", "14");
	   addOpt(oCntrl,  3, "Publicidad en Internet", "15");
	   addOpt(oCntrl,  4, "Diseño Web", "16");
	   addOpt(oCntrl,  5, "Agentes Comerciales", "17");
	   addOpt(oCntrl,  6, "Agentes Aduanales", "18");
	   addOpt(oCntrl,  7, "Servicios Juridicos", "19");
	   addOpt(oCntrl,  8, "Consultoria Empresarial", "20");
	   addOpt(oCntrl,  9, "Consultoria IT", "21");
	   addOpt(oCntrl,  10, "Consultoria en Produccion", "22");
	   break;
	   case 20: 
       addOpt(oCntrl,  0, "Seleccionar", "0");
	   addOpt(oCntrl,  1, "Repartidores Motorizados", "93");
	   addOpt(oCntrl,  2, "Camiones de Reparto", "94");
	   addOpt(oCntrl,  3, "Transporte de Carga Intermunicipal", "95");
	   addOpt(oCntrl,  4, "Transporte de Carga Internacional", "96");
	   addOpt(oCntrl,  5, "Transporte Maritimo", "97");
	   addOpt(oCntrl,  6, "Transporte Aereo", "98");
	   addOpt(oCntrl,  7, "Transporte Escolar", "99");
	   addOpt(oCntrl,  8, "Transporte de Valores", "100");
	   break;
	  }
	 }
</script>
</head>
<body>
<div id="pagina" align="center" class="paginaUsuariosCompras">

<div id="header" class="header">
<?PHP
include("header.php");
?>
</div>
<div id="menuSuperior" style="float:left;">
<?PHP
include("menuSuperior.php");
?>
</div>

<div id="menuIzquierdo" class="menuLateralComp" align="left">

<div id="contenedorMenu" class="contenedorMenu" align="center">
     <div class="botonIzquierdo posicionBotonUno botonSeleccionado" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="compras.php">Publicar una nueva Compra</a></div>
  <div class="botonIzquierdo posicionBotonDos" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="comprar.php">Compras</a></div>
  </div>


<div id="navegacionCentral" class="navegacionComprar">

<div id="titulo" class="tituloContenedorVender letrasTituloContenedor" align="left">¿Que deseas Comprar?</div>
<form id="formulario" name="formulario" method="post" action="compras.php" enctype="multipart/form-data" >
  <table width="800" height="988" border="0" cellspacing="2">
    <tr>
      <td width="18" height="25">&nbsp;</td>
      <td width="234">&nbsp;</td>
      <td width="513"><?PHP echo $status; ?></td>
      <td width="17">&nbsp;</td>
    </tr>
    <tr>
      <td height="28">&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Descripcion Corta:</strong></div></td>
      <td><div align="left">
        <input name="txtDesCorta" type="text" class="required" id="txtDesCorta" size="40" maxlength="50" />
        Maximo 20 caracteres</div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Industria:</strong></div></td>
      <td><div align="left">
        <select name="comboIndustria" id="comboIndustria" onchange="cambia(document.formulario.comboCategoria)">
          <option value="0">Seleccionar</option>
          <?PHP
        $result = $memall->getIndustrias();
		 while($row = mysql_fetch_array($result)) {
               $id =  $row["idindustria"];
			   $industria = $row["descripcionIndustria"];
        ?>
          <option value="<?PHP echo $id; ?>"><?PHP echo $industria; ?></option>
          <?PHP
          }//end while 
		 ?>
        </select>
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Categoria:</strong></div></td>
      <td><label>
        <label>
        <div align="left">
          <select name="comboCategoria" id="comboCategoria">
            <option value="0">Seleccionar</option>
          </select>
        </div>
        <div align="left"></div>
        </label>
        <div align="left"></div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Palabras Clave:</strong></div></td>
      <td><label>
        <div align="left">
          <input type="text" class="required" name="txtPalabrasClave" id="txtPalabrasClave" />
        </div>
        <div align="left"></div>
        <div align="left"></div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Estado:</strong></div></td>
      <td><label>
        <select name="comboEstado" id="comboEstado">
          <option value="0">Seleccionar</option>
          <option value="1">Activo</option>
          <option value="2">Inactivo</option>
        </select>
        <div align="left"></div>
        <div align="left"></div>
        <div align="left"></div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"></div></td>
      <td><label>
        <div align="left"></div>
        <div align="left"></div>
        <div align="left"></div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"><strong>Foto:</strong></div></td>
      <td><label>
        <div align="left">
          <input type="file" name="userfile" id="userfile" />
        </div>
        <div align="left"></div>
        <div align="left"></div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"></div></td>
      <td><label>
        <img src="img/logoDefault.jpg" width="102" height="95" />
        <div align="left"></div>
        <div align="left"></div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Descripcion Detallada:</strong></div></td>
      <td><div align="left"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td>&nbsp;</td>
      <td><label>
        <div align="left">
          <textarea name="txtDescripcionDetallada" class="required" id="txtDescripcionDetallada" cols="45" rows="5"></textarea>
        </div>
        <div align="left"></div>
        <div align="left"></div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"></div></td>
      <td><div align="left"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Rango de Precios:</strong></div></td>
      <td><div align="left">
        <select name="comboDivisaRango" id="comboDivisaRango">
          <option value="0">Seleccionar Moneda</option>
          <option value="Bolivares">Bolivares</option>
          <option value="Dolares Estados Unidos">Dolares Estados Unidos</option>
          <option value="Euros">Euros</option>
        </select>
        <input name="txtDe" type="text" id="txtDe" value="De" onclick="value=''" />
      -
      <input name="txtHasta" type="text" id="txtHasta" value="Hasta" onclick="value=''" />
</div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>

      <td height="21">&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Cantidad Requerida:</strong></div></td>
      <td>
        <div align="left">
          <input type="text" name="txtCantidadRequerida" class="required" id="txtCantidadRequerida" />
          <select name="comboUnidadRequerida" id="comboUnidadRequerida">
            <option value="UND">Seleccione la Unidad</option>
            <option value="KG">KG</option>
            <option value="G">G</option>
          </select>
        </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Certificacion requerida:</strong></div></td>
      <td><label>
        <div align="left"></div>
        <div align="left"></div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="left">
        <textarea name="txtCertificacion" class="required" id="txtCertificacion" cols="45" rows="5"></textarea>
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"></div></td>
      <td><label>
        <label></label>
        <div align="left"></div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Privacidad:</strong></div></td>
      <td><div align="left">
        <input type="radio" name="radio" id="radio" value="radio" checked="checked" />
Permitir ver mis datos de contacto a todos los miembros.</div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td>&nbsp;</td>
      <td><label>
        <div align="left">
          <input type="radio" name="radio" id="radio2" value="radio" />
          Permitir contacto solo por mensajes.</div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td>&nbsp;</td>
      <td><label>
        <div align="left">
          <input type="radio" name="radio" id="radio3" value="radio" />
          Permitir contacto solo a miembros de Memall.        </div>
        <div align="left"></div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"></div></td>
      <td><label>
        <input type="submit" name="send" id="send" value="Guardar" />
        <div align="left"></div>
        <div align="left"></div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><div align="right"></div></td>
      <td><div align="left">
        <label></label>
      </div></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</div>  

</div>

</div>
</body>
</html>
<?PHP
}
?>