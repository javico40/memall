<?PHP
session_start();
if(!isset($_SESSION['validate'])){
header("location: entrar.php");
}else{
include("include/core/main.php");
include("include/connection.php");
include("include/config.php");
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
$producto =  mysql_real_escape_string($_POST["txtProducto"]);
$industria = mysql_real_escape_string($_POST["comboIndustria"]);
$categoria = mysql_real_escape_string($_POST["comboCategoria"]);

$marca = mysql_real_escape_string($_POST["txtMarca"]);
$modelo = mysql_real_escape_string($_POST["txtModelo"]);
$estado = mysql_real_escape_string($_POST["txtEstado"]);
$descripcionCorta = mysql_real_escape_string($_POST["txtDescripcionCorta"]);
$descripcionDetallada = mysql_real_escape_string($_POST["txtDescripcionDetallada"]);

$cantidadMinima = mysql_real_escape_string($_POST["txtCantidadMinima"]);
$unidadCantidadMinima = mysql_real_escape_string($_POST["comboUnidadOrdenar"]);

$precioAlPorMayor = mysql_real_escape_string($_POST["txtPrecioAlPorMayor"]);
$divisaPrecioAlPorMayor = mysql_real_escape_string($_POST["comboDivisaPorMayor"]);

$precioProducto = mysql_real_escape_string($_POST["txtPrecioPorProducto"]);
$divisaPrecioProducto = mysql_real_escape_string($_POST["comboDivisaProducto"]);

$precioOtraDivisa = mysql_real_escape_string($_POST["txtPrecioOtraDivisa"]);
$divisaPrecioOtraDivisa = mysql_real_escape_string($_POST["comboDivisaOtraDivisa"]);

//metodos de pago
$metodoPagoDeposito = mysql_real_escape_string($_POST["checkDeposito"]);
$metodoPagoCheque = mysql_real_escape_string($_POST["checkCheque"]);
$metodoPagoIntercambio = mysql_real_escape_string($_POST["checkIntercambio"]);
$metodoPagoWestern = mysql_real_escape_string($_POST["checkWestern"]);
$metodoPagoMoney = mysql_real_escape_string($_POST["checkMoneyGram"]);
$metodoPagoOtros = mysql_real_escape_string($_POST["checkOtros"]);

if($metodoPagoDeposito =='on'){
$metodoPagoDeposito = 1;
} 

if($$metodoPagoCheque =='on'){
$metodoPagoCheque = 1;
} 

if($metodoPagoIntercambio =='on'){
$metodoPagoIntercambio = 1;
} 

if($metodoPagoWestern =='on'){
$metodoPagoWestern = 1;
} 

if($metodoPagoMoney =='on'){
$metodoPagoMoney = 1;
} 

if($metodoPagoOtros=='on'){
$metodoPagoOtros = 1;
} 

//Produccion
$capacidadProduccion = mysql_real_escape_string($_POST["txtCapacidadProduccion"]);
$unidadCapacidadProduccion = mysql_real_escape_string($_POST["comboUnidadProduccion"]);
$tiempoCapacidadProduccion = mysql_real_escape_string($_POST["comboTiempoProduccion"]);
$tiempoEntrega = mysql_real_escape_string($_POST["txtTiempoEntrega"]);
$detallesEmpaque = mysql_real_escape_string($_POST["txtDetallesEmpacado"]);

//Validar Campos Vacios
if($producto==NULL|$industria==NULL|$categoria==NULL|$marca==NULL|$modelo==NULL|$estado==NULL|$descripcionCorta==NULL|$descripcionDetallada==NULL|$cantidadMinima==NULL|$unidadCantidadMinima==NULL|$precioAlPorMayor==NULL|$divisaPrecioAlPorMayor==NULL|$precioProducto==NULL|$divisaPrecioProducto==NULL|$precioOtraDivisa==NULL|$divisaPrecioOtraDivisa==NULL|$capacidadProduccion==NULL|$unidadCapacidadProduccion==NULL|$tiempoCapacidadProduccion==NULL|$tiempoEntrega==NULL|$detallesEmpaque==NULL){
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
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], "usuarios/img/".$user."_".$nombre_archivo)){ 
       $status = "El archivo ha sido cargado correctamente."; 
	   $fund = new Fundamental();
	   $fund->redimensiona_imagen($user."_".$nombre_archivo, "usuarios/img/",  "130", "100");	   
    }else{ 
       $status = "<span class='letrasIncorrecto'><label><strong>Error al almacenar la imagen, revise el formato y tamaño.</strong></label></span>"; 
    }//end if file not uploades
}//end if extension o size problems
//nombre de la imagen
$rutaimagen = "usuarios/img/".$user."_".$nombre_archivo;
//registrar El Producto
$cliente->registrarProducto($producto, $idUser, $industria, $categoria, $marca, $modelo, $estado, $descripcionCorta, $descripcionDetallada, $Grupo,$cantidadMinima, $unidadCantidadMinima, $precioAlPorMayor, $divisaPrecioAlPorMayor, $precioProducto, $divisaPrecioProducto, $precioOtraDivisa,  $divisaPrecioOtraDivisa, $capacidadProduccion, $unidadCapacidadProduccion, $tiempoCapacidadProduccion, $tiempoEntrega, $detallesEmpaque, $rutaimagen, $metodoPagoDeposito, $metodoPagoCheque, $metodoPagoIntercambio, $metodoPagoWestern, $metodoPagoMoney, $metodoPagoOtros);
$status = "<span class='letrasCorrecto'><label><strong>El producto ha sido registrado correctamente.</strong></label></span>"; 

}//end validar campos vacios
}//end register
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
<link href="css/users.css" rel="stylesheet" type="text/css" />
<link href="css/visual.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="./css/ui-lightness/jquery-ui-1.8.2.custom.css" />
 		  
  <style type="text/css">
			
			#demoWrapper {
         	padding : 1em;
	        width : auto;
			}

			#demoNavigation {
				margin-top : 0.5em;
				margin-right : 1em;
				text-align: right;
			}
			
			#data {
				font-size : 0.7em;
			}

			input {
				margin-right: 0.1em;
				margin-bottom: 0.5em;
			}

			.input_field_25em {
				width: 2.5em;
			}

			.input_field_3em {
				width: 3em;
			}

			.input_field_35em {
				width: 3.5em;
			}

			.input_field_12em {
				width: 12em;
			}

			label {
				margin-bottom: 0.2em;
				font-weight: bold;
				font-size: 0.8em;
			}

			.step span {
				float: right;
				font-weight: bold;
				padding-right: 0.8em;
			}

			label.error {
				color: red;
				font-size: 0.8em;
				margin-left : 0.5em;
			}

			.navigation_button {
				width : 70px;
			}
			
			#data {
					overflow : auto;
			}
			
		</style>
        
        <style type="text/css">
<!--
.style1 {color: #000000}
.letrasCorrecto{color: #00CC00}
.letrasIncorrecto{color:#FF0000}
.step span {
				float: right;
				font-weight: bold;
				padding-right: 0.8em;
			}
      input {
				margin-right: 0.1em;
				margin-bottom: 0.5em;
			}
-->
</style>
<script language="JavaScript">

function addOpt(oCntrl, iPos, sTxt, sVal){
     var selOpcion = new Option(sTxt, sVal);
     eval(oCntrl.options[iPos]=selOpcion);
   }
   
function cambia(oCntrl){
    while (oCntrl.length) oCntrl.remove(0);
    switch (document.demoForm.comboIndustria.selectedIndex){
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
    <div id="pagina" align="center" class="paginaUsuariosVentas">
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

<div id="menuIzquierdo" class="menuLateralVentas" align="left">
<div id="contenedorMenu" class="contenedorMenu" align="center">
<div class="botonIzquierdo posicionBotonUno botonSeleccionado" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="publicar.php">Publicar un nuevo Producto</a></div>
  <div class="botonIzquierdo posicionBotonDos" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="vender.php">Productos</a></div>
  <div class="botonIzquierdo posicionBotonTres" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="promociones.php">Promocionar mis Productos</a></div>
</div>

<div id="navegacionCentral" class="navegacionVender">
	  <div id="demoWrapper">
			<h5 id="status"></h5>
			<form id="demoForm" name="demoForm" method="post" action="json.html" class="bbq"  enctype="multipart/form-data" >
				<div id="fieldWrapper">
				  <div class="step" id="first">
					<span class="font_normal_07em_black">Detalles del Producto</span><br />
					  <div class="input" align="center">
						<label for="txtProducto">Nombre del Producto:</label><br />
						<input class="input_field_12em" id="txtProducto" name="txtProducto"><br />
						<label for="comboIndustria">Industria:</label><br />
						<select id="comboIndustria" name="comboIndustria" class="input_field_12em" onchange="cambia(document.demoForm.comboCategoria)" >
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
						</select><br />
						<label for="comboCategoria">Categoria</label><br />
						<select id="comboCategoria" name="comboCategoria" class="input_field_12em" >
							<option value="0">Seleccionar</option>
						</select><br />
                        <label for="txtMarca">Marca:</label><br />
						<input class="input_field_12em" name="txtMarca" id="txtMarca" ><br />
                        <label for="txtModelo">Modelo:</label><br />
						<input class="input_field_12em" name="txtModelo" id="txtModelo" ><br />
                        <label for="txtEstado">Estado</label><br />
						<select name="txtEstado" id="txtEstado" class="input_field_12em" >
							<option value="0">Seleccionar</option>
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
						</select>
                        <br />
					</div>
				</div>
				<div id="sweden" class="step">
					<span class="font_normal_07em_black">Imagen y Descripcion</span><br />
					<div class="input" align="center">
						<label for="day_se">Social Security Number</label><br />
						<input class="input_field_25em" name="day" id="day_se" value="DD">
						<input class="input_field_25em" name="month" id="month_se" value="MM">
						<input class="input_field_3em" name="year" id="year_se" value="YYYY"> - 
						<input class="input_field_3em" name="lastFour" id="lastFour_se" value="XXXX"><br />
						<label for="countryPrefix_se">Phone number</label><br />
						<input class="input_field_35em" name="countryPrefix" id="countryPrefix_se" value="+358"> - 
						<input class="input_field_3em" name="areaCode" id="areaCode_se"> - 
						<input class="input_field_12em" name="phoneNumber" id="phoneNumber_se"><br />
						<label for="email_se">*Email</label><br />
						<input class="input_field_12em required email" name="email" id="email_se"><br />
						<label for="username_se">User name</label><br />
						<input class="input_field_12em" name="username" id="username_se"><br />
						<label for="password_se">Password</label><br />
						<input class="input_field_12em" name="password" id="password_se" type="password"><br />
						<label for="retypePassword_se">Retype password</label><br />
						<input class="input_field_12em" name="retypePassword" id="retypePassword_se" type="password"><br />			
						<input type="hidden" class="link" value="summary" />
					</div>
				</div>
				<div id="finland" class="step">
					<span class="font_normal_07em_black">Finnish Step 2 - Personal information</span><br />
					<div class="input">
						<label for="day_fi">Social Security Number</label><br />
						<input class="input_field_25em" name="day" id="day_fi" value="DD">
						<input class="input_field_25em" name="month" id="month_fi" value="MM">
						<input class="input_field_3em" name="year" id="year_fi" value="YYYY"> - 
						<input class="input_field_3em" name="lastFour" id="lastFour_fi" value="XXXX"><br />
						<label for="countryPrefix_fi">Phone number</label><br />
						<input class="input_field_35em" name="countryPrefix" id="countryPrefix_fi" value="+358"> - 
						<input class="input_field_3em" name="areaCode" id="areaCode_fi"> - 
						<input class="input_field_12em" name="phoneNumber" id="phoneNumber_fi"><br />
						<label for="email_fi">*Email</label><br />
						<input class="input_field_12em" name="email" id="email_fi"><br />	 						
					</div>
				</div>
				<div id="confirmation" class="step">
					<span class="font_normal_07em_black">Finnish last step - Username</span><br />
					<div class="input">
						<label for="username">User name</label><br />
						<input class="input_field_12em" name="username" id="username"><br />
						<label for="password">Password</label><br />
						<input class="input_field_12em" name="password" id="password" type="password"><br />
						<label for="retypePassword">Retype password</label><br />
						<input class="input_field_12em" name="retypePassword" id="retypePassword" type="password"><br />
					</div>
				</div>
				<div id="summary" class="step">
					<span class="font_normal_07em_black">Summary page</span><br />
					<p>Please verify your information below.</p>
					<div id="summaryContainer"></div>
				</div>
				</div>
				<div id="demoNavigation"> 							
					<input class="navigation_button" id="back" value="Back" type="reset" />
					<input class="navigation_button" id="next" value="Next" type="submit" />
				</div>
			</form>
			
			<p id="data"></p>
		</div>
        
</div>

    <script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>		
    <script type="text/javascript" src="../js/jquery.form.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../js/bbq.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript" src="../js/jquery.form.wizard-3.0.4.js"></script>
    
    <script type="text/javascript">

			var cache = {}; // caching inputs for the visited steps

			$("#demoForm").bind("step_shown", function(event,data){	
				if(data.isLastStep){ // if this is the last step...then
					$("#summaryContainer").empty(); // empty the container holding the 
					$.each(data.activatedSteps, function(i, id){ // for each of the activated steps...do
						if(id === "summary") return; // if it is the summary page then just return
						cache[id] = $("#" + id).find(".input"); // else, find the div:s with class="input" and cache them with a key equal to the current step id
						cache[id].detach().appendTo('#summaryContainer').show().find(":input").removeAttr("disabled"); // detach the cached inputs and append them to the summary container, also show and enable them
					});
				}else if(data.previousStep === "summary"){ // if we are movin back from the summary page
					$.each(cache, function(id, inputs){ // for each of the keys in the cache...do
						var i = inputs.detach().appendTo("#" + id).find(":input");  // put the input divs back into their normal step
						if(id === data.currentStep){ // (we are moving back from the summary page so...) if enable inputs on the current step
							 i.removeAttr("disabled");
						}else{ // disable the inputs on the rest of the steps
							i.attr("disabled","disabled");
						}
					});
					cache = {}; // empty the cache again
				}
			})

			$(function(){
				$("#demoForm").formwizard({ 
				 	formPluginEnabled: true,
				 	validationEnabled: true,
				 	focusFirstInput : true,
				 	formOptions :{
						success: function(data){$("#status").fadeTo(500,1,function(){ $(this).html("You are now registered!").fadeTo(5000, 0); })},
						beforeSubmit: function(data){$("#data").html("data sent to the server: " + $.param(data));},
						dataType: 'json',
						resetForm: true
				 	}	
				 }
				);
  		});
    </script>
  
</div>
</body>
</html>
<?PHP
}//END IF-ELSE
?>
