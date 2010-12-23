<?PHP
$ps = $_GET['ps'];

if($ps=="1"){
$position = " -> <a class='Estilo2' href='buscar.php?ps=1'>buscar</a>";
}else if($ps=="2"){
$position = " -> <a class='Estilo2' href='registro.php?ps=2'>registro</a>";
}else if($ps=="3"){
$position = " -> <a class='Estilo2' href='entrar.php?ps=3'>entrar</a>";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<title>header</title>
<style type="text/css">
<!--
.Estilo2 {
	font-weight: bold;
	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}
-->
</style>
</head>
<body>
<div id="seccion" style="width:1024px; height:135px;">
<div id="topheader">
<div id="headerLogo" class="logo"><img src="img/logo.jpg" width="117" height="95" alt=""></div>
<div id="bgHeader" class="bgHeader">
  <div id="headerTitle" align="center" class="headerTitle style1"><strong>De Negocio a Negocio el primer portal B2B Hispano</strong></div>
</div>
<div id="bgHeaderDos" class="bgHeaderDos">
  <div id="bandera" class="bandera"><img src="img/bandera.jpg" width="46" height="31" alt=""></div>
  <div align="center" class="banderaTitle style1" id="banderaTitle"><strong>Venezuela</strong></div>
</div>
<div id="headerRightCorner" class="headerCorner"><img src="img/leftCorn.jpg" width="27" height="95" alt=""></div>
</div>

<div id="separador" class="separador"></div>

<div class="headerSeparator Estilo2" id="headerSeparator">
  <div align="left" style="padding-left:10px;"><a class="Estilo2" href="index.php">Inicio</a><?PHP echo $position;?></div>
</div> 
  
</div>
</body>
</html>
