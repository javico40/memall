<?PHP
include("include/core/main.php");
$memall = new Memall();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<link href="css/home123.css" rel="stylesheet" type="text/css" />
<link href="css/home.css" rel="stylesheet" type="text/css" />
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
<script language="JavaScript" src="css/ae.js" type="text/javascript"></script>
<script language="JavaScript" src="css/home.js" type="text/javascript"></script></head>
<body>
<div id="pagina" class="pagina">

<div id="header" class="header">
<?PHP
include("header.php");
?>
</div>

<div id="left" class="containerIndexLeft">
  <div id="headerCategorias" class="headerCategorias"><img src="img/headerCat.jpg" width="152" height="19" alt=""></div>
  <div id="bodyCategorias" align="left" class="bodyCategorias">
<table cellspacing="0" cellpadding="0" width="146" border="0">
  <tbody>
       <tr>
          <td class="leftbody" style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; MARGIN: 2px; PADDING-TOP: 2px; width: 146px; ">
               <div style="WIDTH: 146px">
                   <div class="box mainCategory" id="divExchangeContianer">
                      <ul>
                        <?PHP
						//creo el objeto memeall
                        $memall = new Memall();
						//selecciono las industria
                        $result = $memall->getIndustrias();
						$catcounter = 1;
                        //mientras halla industrias, selecciono los datos
						while($row = mysql_fetch_array($result)) {
                        $descripcionIndustria = $row["descripcionIndustria"];
						$idIndustria =  $row["idindustria"];
						?>
						 <li id="level_<?PHP echo $idIndustria; ?>"><a style="PADDING-LEFT: 2px; FONT-SIZE: 12px; MARGIN-LEFT: 2px; width:210px;" 
                          href="buscar.php?ps=1&im=<?PHP echo $idIndustria; ?>"><?PHP echo $descripcionIndustria; ?></a></li>
						  <?PHP
						  $catcounter = $catcounter + 1;
                        }//end while
                      	?>
				     </ul>
                   </div>
              </div>
                    <?PHP	
					//Seleccion de industria mas categorias     
				    $result = $memall->getIndustrias();
					//si existen industrias
					if (@mysql_num_rows($result)!=0){
						$catcounter = 1;
						//mientrs halla industria, sacar los datos
						while($row = @mysql_fetch_array($result)){		
						$descripcionIndustria = $row["descripcionIndustria"];
						$idIndustria =  $row["idindustria"];
						//mostrar datos
						?>
               <div class="ctgPlusItem" id="level_<?PHP echo $idIndustria; ?>_div" style="DISPLAY: none; z-index:200;">
                  <div class="content">
                       <ul>
                        <?PHP
						//Seleccionar subcategorias
					    $resultIndustry_subcat = $memall->getCategorias($idIndustria);
						//si existen categorias para la industria
					    if (@mysql_num_rows($resultIndustry_subcat)!=0){
						   //mientras halla subcategorias
						    while($row_subcat = @mysql_fetch_array($resultIndustry_subcat)){
						?>
                        <li><a href="buscar.php?ps=1&im=<?PHP echo $row_subcat['industria_idindustria']; ?>&amp;ct=<?PHP echo $row_subcat['idcategorias']; ?>" class="submenu"><?PHP echo $row_subcat['descripcionCategoria'];?></a> 
				   <?PHP
						  }//end while
					  }//end if-else				
				   ?>
                        </li>
                     </ul>
                  </div>
               </div>
               <?PHP
					$catcounter = $catcounter + 1;
				     }//end while industria
				   }//end if industria				
				?>
  <script language="JavaScript" type="text/javascript">
   var aMenuCrl=[];
   
   for(i=0;i<=44;i++){	
   aMenuCrl[i]=new AE.widget.overShow();
   }//end for
					 
   var categoryCurrentTimer=[];

   YUE.on(window,"load",function(){
	
	for(i=0;i<=44;i++){
	  aMenuCrl[i].init({
		    targetId:"level_"+i,
			contentId:"level_"+i+"_div",
			showDelayTime:150,
			hiddenDelayTime:150,
			excursion:[135,0]
		});
		
	var dTarget = get("level_"+i);
	var dContent = get("level_"+i+'_div');

    YUE.on(dContent,'mouseover',addClass,[dTarget,i]);
    YUE.on(dContent,'mouseout',removeClassDelay,[dTarget,i]);
    YUE.on(dTarget,'mouseover',addClass,[dTarget,i]);
    YUE.on(dTarget,'mouseout',removeClass,[dTarget,i]);
   }//end for
   
	});//end function

	function addClass (ev,obj){
		clearTimeout(categoryCurrentTimer[obj[1]]);
		YUD.addClass(obj[0],'current');
		}
		
    function removeClassDelay (ev,obj){
	   categoryCurrentTimer[obj[1]] = setTimeout(function(){YUD.removeClass(obj[0],'current');},20);
	}
	
    function removeClass (ev,obj){
	   categoryCurrentTimer[obj[1]] = setTimeout(function(){YUD.removeClass(obj[0],'current');},0);
	}
</script>

<div style="CLEAR: both"></div>
</td></tr>
                    <tr>
                <td>&nbsp; </td></tr></tbody></table>
</div>

</div>

<div id="center" class="containerIndexCenter">
   <div id="tablaOfertas" class="tablaOfertas">
      <div id="headerTabla" class="headerTabla"><img src="img/header.jpg" width="569" height="18" alt=""></div>
      <div id="tablaScroll" class="tablaScrollLeft">
         <style>
           UL.hotNews {
	         PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 50px; MARGIN: 0px; OVERFLOW: hidden; WIDTH: 100%; PADDING-TOP: 0px; HEIGHT: 180px
           }
           UL.hotNews LI {
	       PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-TOP: 0px
            }

          .leadsCycle {
	        MARGIN: 0px -10px; WIDTH: 462px
            }
.leadsCycle H2 {
	MARGIN: 5px 10px; FONT: bold 12px tahoma; COLOR: #33322d
}
.leadsCycle H2 A.more {
	FLOAT: right; FONT: lighter 0.9em tahoma
}
UL.leadsCycleContainer {
	PADDING-RIGHT: 0px; BORDER-TOP: #ffd99e 1px solid; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px 0px 8px; OVERFLOW: hidden; WIDTH: 230px; PADDING-TOP: 0px; BORDER-RIGHT-STYLE: none! important; BORDER-LEFT-STYLE: none! important; HEIGHT: 92px; BACKGROUND-COLOR: #fff; BORDER-BOTTOM-STYLE: none! important
}
UL.leadsCycleContainer LI {
	PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 3px; PADDING-TOP: 3px
}
UL.leadsCycleContainer LI.leadsCycleBg {
	BACKGROUND-COLOR: #f9f1e6
}
.leadsCycleDate {
	FONT-SIZE: 9px; FLOAT: right; COLOR: #655f5f
}
.leadsCycleContainer IMG {
	MARGIN: 2px 7px; VERTICAL-ALIGN: middle
}
UL.leadsCycleContainer {
	FONT-SIZE: 13px
}

</style>
<div align="left">


<ul class="hotNews" id="hotNews" style="LIST-STYLE-IMAGE: none">
<li>
<strong>

<div class="hotNews" align="center">
  <table width="269" border="0">
    <tr>
      <td width="45"><strong><img src="productos/imagenes/thumbs/img 1.JPG" width="42" height="31" /></strong></td>
      <td width="214">
      <div><a href="members.php?id=0002938">Coprodinsa</a> <strong>Compra </strong> - <a href="compras.php?estd=zul">Zulia</a></div>
      <div><strong><a href="compras.php?id=029302">In</a></strong><a href="compras.php?id=029302"><strong>sumos para la fabricacion</strong></a><strong></strong></div>
      </td>
    </tr>
  </table>
</div>

</strong>
</li>
<li><strong><div class="hotNews" align="center">
<strong>
<div class="hotNews">
  <table width="269" border="0">
    <tr>
      <td width="45"><strong><img src="productos/imagenes/thumbs/img 1.JPG" width="42" height="31" /></strong></td>
      <td width="214">
      <div><a href="members.php?id=0002938">Coprodinsa</a> <strong>Compra </strong> - <a href="compras.php?estd=zul">Zulia</a></div>
      <div><strong><a href="compras.php?id=029302">In</a></strong><a href="compras.php?id=029302"><strong>sumos para la fabricacion</strong></a><strong></strong></div>
      </td>
    </tr>
  </table>
</div>
</strong>
</div></strong></li>
<li><strong><div class="hotNews" align="center">
<strong>
<div class="hotNews">
  <table width="269" border="0">
    <tr>
      <td width="45"><strong><img src="productos/imagenes/thumbs/img 1.JPG" width="42" height="31" /></strong></td>
      <td width="214">
      <div><a href="members.php?id=0002938">Coprodinsa</a> <strong>Compra </strong> - <a href="compras.php?estd=zul">Zulia</a></div>
      <div><strong><a href="compras.php?id=029302">In</a></strong><a href="compras.php?id=029302"><strong>sumos para la fabricacion</strong></a><strong></strong></div>
      </td>
    </tr>
  </table>
</div>
</strong>
</div></strong></li>
<li><strong><div class="hotNews" align="center">
<strong>
<div class="hotNews">
  <table width="269" border="0">
    <tr>
      <td width="45"><strong><img src="productos/imagenes/thumbs/img 1.JPG" width="42" height="31" /></strong></td>
      <td width="214">
      <div><a href="members.php?id=0002938">Coprodinsa</a> <strong>Compra </strong> - <a href="compras.php?estd=zul">Zulia</a></div>
      <div><strong><a href="compras.php?id=029302">In</a></strong><a href="compras.php?id=029302"><strong>sumos para la fabricacion</strong></a><strong></strong></div>
      </td>
    </tr>
  </table>
</div>
</strong>
</div></strong></li>

<li><strong><div class="hotNews" align="center">
<strong>
<div class="hotNews">
  <table width="269" border="0">
    <tr>
      <td width="45"><strong><img src="productos/imagenes/thumbs/img 1.JPG" width="42" height="31" /></strong></td>
      <td width="214">
      <div><a href="members.php?id=0002938">Coprodinsa</a> <strong>Compra </strong> - <a href="compras.php?estd=zul">Zulia</a></div>
      <div><strong><a href="compras.php?id=029302">In</a></strong><a href="compras.php?id=029302"><strong>sumos para la fabricacion</strong></a><strong></strong></div>
      </td>
    </tr>
  </table>
</div>
</strong>
</div></strong></li>

<li><strong><div class="hotNews" align="center">
<strong>
<div class="hotNews">
  <table width="269" border="0">
    <tr>
      <td width="45"><strong><img src="productos/imagenes/thumbs/img 1.JPG" width="42" height="31" /></strong></td>
      <td width="214">
      <div><a href="members.php?id=0002938">Coprodinsa</a> <strong>Compra </strong> - <a href="compras.php?estd=zul">Zulia</a></div>
      <div><strong><a href="compras.php?id=029302">In</a></strong><a href="compras.php?id=029302"><strong>sumos para la fabricacion</strong></a><strong></strong></div>
      </td>
    </tr>
  </table>
</div>
</strong>
</div></strong></li>

<li><strong><div class="hotNews" align="center">
<strong>
<div class="hotNews">
  <table width="269" border="0">
    <tr>
      <td width="45"><strong><img src="productos/imagenes/thumbs/img 1.JPG" width="42" height="31" /></strong></td>
      <td width="214">
      <div><a href="members.php?id=0002938">Coprodinsa</a> <strong>Compra </strong> - <a href="compras.php?estd=zul">Zulia</a></div>
      <div><strong><a href="compras.php?id=029302">In</a></strong><a href="compras.php?id=029302"><strong>sumos para la fabricacion</strong></a><strong></strong></div>
      </td>
    </tr>
  </table>
</div>
</strong>
</div></strong></li>

<li><strong><div class="hotNews" align="center">
<strong>
<div class="hotNews">
  <table width="269" border="0">
    <tr>
      <td width="45"><strong><img src="productos/imagenes/thumbs/img 1.JPG" width="42" height="31" /></strong></td>
      <td width="214">
      <div><a href="members.php?id=0002938">Coprodinsa</a> <strong>Compra </strong> - <a href="compras.php?estd=zul">Zulia</a></div>
      <div><strong><a href="compras.php?id=029302">In</a></strong><a href="compras.php?id=029302"><strong>sumos para la fabricacion</strong></a><strong></strong></div>
      </td>
    </tr>
  </table>
</div>
</strong>
</div></strong></li>

<li><strong><div class="hotNews" align="center">
<strong>
<div class="hotNews">
  <table width="269" border="0">
    <tr>
      <td width="45"><strong><img src="productos/imagenes/thumbs/img 1.JPG" width="42" height="31" /></strong></td>
      <td width="214">
      <div><a href="members.php?id=0002938">Coprodinsa</a> <strong>Compra </strong> - <a href="compras.php?estd=zul">Zulia</a></div>
      <div><strong><a href="compras.php?id=029302">In</a></strong><a href="compras.php?id=029302"><strong>sumos para la fabricacion</strong></a><strong></strong></div>
      </td>
    </tr>
  </table>
</div>
</strong>
</div></strong></li>


</ul>
</div>
<script type="text/javascript">
var hotnewsAE = AE.widget.SimpleScroll.decorate('hotNews', {lineHeight: 20, startDelay: 1});
</script>

</div>

<div id="tablaScroll2" class="tablaScrollRight" align="center">

<ul class="hotNews" id="hotNews2" style="LIST-STYLE-IMAGE: none">
<?PHP
 $result = $memall->getProductosActivos();
 
 //Saco los resultados
  while($row = mysql_fetch_array($result)){
	$idProducto = $row["idproductos"];  
    $nombreProducto = $row["nombreProducto"];
    $imagenProducto = $row["rutaImagen"];
	$empresa = $row["nombreEmpresa"];
    $region = $row["descripcionRegion"];
?>
<li><strong><div class="hotNews" align="center">
<strong>
<div class="hotNews">
  <table width="269" border="0">
    <tr>
      <td width="54"><strong><img src="<?PHP echo $imagenProducto; ?>" width="42" height="31" /></strong></td>
      <td width="205">
      <div>
        <div align="left"><a href="members.php?id=<?PHP echo $idProducto; ?>"><?PHP echo $empresa;?></a> <strong>Vende </strong> - <a href="compras.php?estd=zul"><?PHP echo $region; ?></a></div>
      </div>
      <div>
        <div align="left"><a href="productos.php?pid=<?PHP echo $idProducto; ?>"><strong><?PHP echo $nombreProducto; ?></strong></a></div>
      </div>      </td>
    </tr>
  </table>
</div>
</strong>
</div></strong></li>
<?PHP
}//end while
?>
</ul>
</div>
   </div>
   
<div id="tablaBannerUno" class="tablaBannerUno"></div>
<div id="tablaUltimos" class="tablaUltimosProductos"></div>
   
</div>

<div id="right" class="containerIndexright">
  <div id="tablaLogin" class="tablaLogin">
      <div class="tituloLogin style2" id="tituloLogin" align="center"><strong>Bienvenido a Memall</strong></div>
      <div id="btnLogin" class="btnLogin"><a href="registro.php?ps=2"><img src="img/btnLogin.jpg" width="202" height="49" alt="" border="0"></a></div>
      <div class="btnYaEresUsuario style3" id="yaEresUsuario">¿Ya eres usuario?</div>
      <div class="btnEntrarCuenta style3" id="btnEntrar"><a  class="estilo2" href="entrar.php?ps=3">Entrar</a></div>
  </div>
  <div id="tablaInformacion" class="tablaInformacion">
     <div id="rentabilizaEmpresa" class="style2 rentabilizaEmpresa"><strong>Rentabiliza tu Empresa</strong></div>
  </div>
  <div id="tablaBannerDos" class="tablaBannerDos"></div>
  
  <div id="btnVender" class="btnVentas"><img src="img/btnPublicarVenta.jpg" width="230" height="40" alt=""></div>
  <div id="btnComprar" class="btnCompras"><img src="img/btnPublicarCompra.jpg" width="232" height="40" alt=""></div>
  <div id="tablaContacto" class="tablaContacto">
     <div id="btnContactar" class="btnContactar"><img src="img/btnContactar.jpg" width="106" height="33" alt=""></div>
  </div>
  <div id="tablaPreciosDia" class="tablaPreciosDelDia"></div>
    
</div>

<script type="text/javascript">
var hotnewsAE = AE.widget.SimpleScroll.decorate('hotNews2', {lineHeight: 20, startDelay: 1});
</script>



<div id="productosEnOferta" class="tablaProductosEnOferta"></div>
<div id="tablaBlogAliados" class="tablaBlogAliados"></div>

<div id="footer" class="footer">
<?PHP
  //include("footer.php");
?>
</div>

</div>
</body>
</html>
