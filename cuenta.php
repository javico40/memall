<?PHP
session_start();
include("include/core/main.php");
include("include/connection.php");
include("include/config.php");

if (!isset($_SESSION['validate'])) {
    header("location: entrar.php");
} else {
//variable usuario en session
    $usuario = $_SESSION['validate'];
//create client
    $cliente = new Cliente;
    $result = $cliente->getClientInformation($usuario);
//Saco los resultados
    while ($row = mysql_fetch_array($result)) {
        $email = $row["email"];
        $emailAlt = $row["emailAlternativo"];
        $telefono = $row["telefono"];
        $cargo = $row["cargo"];
        $sexo = $row["sexo"];
        $login = $row["login"];
        $nombreApellido = $row["nombreApellido"];
    }//end while


    if ($sexo == 1) {
        $mujer = "checked = 'checked'";
        $hombre = "";
    } else if ($sexo == 0) {
        $hombre = "checked = 'checked'";
        $mujer = "";
    } else {
        $hombre = "checked = 'checked'";
        $mujer = "";
    }//end if-else

    $status = "";

    if ($_POST["send"]) {

        $nombreApellido = mysql_real_escape_string($_POST["txtNombreApellido"]);
        $genero = mysql_real_escape_string($_POST["radio"]);
        $emailAlternativo = mysql_real_escape_string($_POST["txtEmailAlt"]);
        $telefono = mysql_real_escape_string($_POST["txtTelefono"]);
        $cargo = mysql_real_escape_string($_POST["txtCargoEmpresa"]);

        if ($nombreApellido == NULL | $genero == NULL | $emailAlternativo == NULL | $telefono == NULL | $cargo == NULL) {
            $status = "<span class='letrasIncorrecto'><label><strong>Debe llenar todos los campos requeridos.</strong></label></span>";
        } else {
//create client
            $cliente = new Cliente;
//Actualizar los usuarios
            $cliente->updateCuenta($usuario, $nombreApellido, $genero, $emailAlternativo, $telefono, $cargo);
//Confirmar al usuario la actualizacion de datos
            $status = "<span class='letrasCorrecto'><label><strong>Los datos han sido actualizados correctamente.</strong></label></span>";
        }//end validator espacio
//$ciudadEmpresa =  mysql_real_escape_string($_POST["txtCalleCiudad"]);
    }//end post send
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
            <link type="text/css" href="scripts/jquery-ui/css/redmond/jquery-ui-1.8.7.custom.css" rel="stylesheet" />
            <link href="css/users.css" rel="stylesheet" type="text/css" />
            <link href="css/visual.css" rel="stylesheet" type="text/css" />
            <style type="text/css">
                <!--
                .letrasCorrecto{color: #00CC00}
                .letrasIncorrecto{color:#FF0000}
                -->
            </style>
            <script type="text/javascript" src="scripts/jquery-ui/js/jquery-1.4.4.min.js"></script>
            <script type="text/javascript" src="scripts/jquery-ui/js/jquery-ui-1.8.7.custom.min.js"></script>
            <script type="text/javascript">

                    // width to resize large images to
                    var maxWidth=5000;
                    // height to resize large images to
                    var maxHeight=5000;
                    // valid file types
                    var fileTypes=["bmp","gif","png","jpg","jpeg"];
                    // the id of the preview image tag
                    var outImage="previewField";
                    // what to display when the image is not valid
                    var defaultPic="img/sin_imagen.jpg";

                    var globalPic;

                    function preview(origen){

                        var source = origen.value;
                        var ext = source.substring(source.lastIndexOf(".")+1,source.length).toLowerCase();
                        
                        for (var i=0; i<fileTypes.length; i++){
                        
                        if(fileTypes[i] == ext){

                        globalPic = new Image();

                        if (i < fileTypes.length){
                          globalPic.src=source;
                        }else {
                          globalPic.src=defaultPic;
                          alert("THAT IS NOT A VALID IMAGEnPlease load an image with an extention of one of the following:nn"+fileTypes.join(", "));
                        }//end if-else
                        
                        setTimeout("applyChanges()",200);
                        }//end is extension
                      }//end for

                      }//end function
                        
                        

                        function applyChanges(){

                         var field = document.getElementById(previewField);
                         var x = parseInt(globalPic.width);
                         var y = parseInt(globalPic.height);

                         if (x>maxWidth) {
                           y*= maxWidth/x;
                           x= maxWidth;
                        }
                        
                        if (y > maxHeight) {
                         x*=maxHeight/y;
                         y=maxHeight;
                        }
                        
                        field.style.display=(x<1 || y<1)?"none":"";
                        field.src = globalPic.src;
                        field.width = x;
                        field.height = y;
                        }
                        // End -->


                function openDialog(){
                
                    $('#dialog').dialog({
                    modal: true,
                    width: 400,
                    buttons: {
        		"Aceptar": function() {
        							$(this).dialog("close");
        						},
        						"Cancelar": function() {
        							$(this).dialog("close");
        						}
        					}
        				});
                    }//end

                    $(document).ready(function() {
                    $("#dialog").css("display", "none");
	            $('#subir_foto').click(function() {
                    ("#dialog").css("display", "yes");
                    });
                    });
                
            </script>
        </head>
        <body>
            <div id="pagina" align="center" class="paginaUsuarios">

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


            <div id="menuIzquierdo" class="menuLateral" align="left">

                <div id="contenedorMenu" class="contenedorMenu" align="center">
                    <div class="botonIzquierdo posicionBotonUno" align="left"><a id="dialog_link" name ="subir_foto" class="letradBotonesMenuIzquierdo estilo3" href="#" onclick="openDialog()">Subir mi Foto</a></div>
                    <div class="botonIzquierdo posicionBotonDos botonSeleccionado" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="cuenta.php">Editar Perfil</a></div>
                    <div class="botonIzquierdo posicionBotonTres" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="cambiar.php">Cambiar Email</a></div>
                    <div class="botonIzquierdo posicionBotonCuatro" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="contrasena.php">Cambiar Contraseña</a></div>
                    <div class="botonIzquierdo posicionBotonCuatro" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="contrasena.php">Cambiar Contraseña</a></div>
                </div>

                <div id="navegacionCentral" class="navegacion">

                    <div id="titulo" class="tituloContenedorVender letrasTituloContenedor" align="left">Detalles de la Cuenta</div>
                    <div id="formul" style="float:left;">
                        <form action="cuenta.php" method="post" >
                            <table width="816" border="0">
                                <tr>
                                    <td width="16">&nbsp;</td>
                                    <td width="258">&nbsp;</td>
                                    <td width="484">&nbsp;</td>
                                    <td width="40">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><div align="right"><strong><span class="asteriscos">*</span>Nombre y Apellido:</strong></div></td>
                                    <td><label>
                                            <div align="left">
                                                <input name="txtNombreApellido" type="text" id="txtNombreApellido" value="<?PHP echo $nombreApellido; ?>" size="30" />
                                            </div>
                                        </label></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><div align="right"><strong><span class="asteriscos">*</span>Genero:</strong></div></td>
                                    <td><label>
                                            <div align="left">
                                                <input name="radio" type="radio" id="radio" value="0" <?PHP echo $hombre; ?> />
                                                Masulino
                                                <input type="radio" name="radio" id="radio2" value="1" <?PHP echo $mujer; ?> />
                                                Femenino      </div>
                                        </label></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><div align="right"><strong><span class="asteriscos">*</span>Email:</strong></div></td>
                                    <td><label>
                                            <div align="left">
                                                <input name="txtEmail" type="text" id="txtEmail" size="30" value="<?PHP echo $email; ?>" readonly="readonly"/>
                                            </div>
                                        </label></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><div align="right"><strong><span class="asteriscos">*</span>Email Alternativo:</strong></div></td>
                                    <td><label>
                                            <div align="left">
                                                <input name="txtEmailAlt" type="text" id="txtEmailAlt" size="30" value="<?PHP echo $emailAlt; ?>" />
                                            </div>
                                        </label></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><div align="right"><strong><span class="asteriscos">*</span>Telefono:</strong></div></td>
                                    <td><label>
                                            <div align="left">
                                                <input type="text" name="txtTelefono" id="txtTelefono" value="<?PHP echo $telefono; ?>" />
                                            </div>
                                        </label></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><div align="right"><strong>Cargo en la Empresa:</strong></div></td>
                                    <td><label>
                                            <div align="left">
                                                <input type="text" name="txtCargoEmpresa" id="txtCargoEmpresa" value="<?PHP echo $cargo; ?>" />
                                            </div>
                                        </label></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><div align="right"><strong><span class="asteriscos">*</span>Usuario:</strong></div></td>
                                    <td><label>
                                            <div align="left">
                                                <input type="text" name="txtNombreUsuario" id="txtNombreUsuario" value="<?PHP echo $login; ?>" readonly="readonly" />
                                            </div>
                                        </label></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><div align="left"><?PHP echo $status; ?></div></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><div align="left">
                                            <input type="submit" name="send" id="send" value="Enviar" />
                                        </div></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>


            </div>

        </div>
            <div id="dialog" title="Subir Foto">
			<p>Seleccione una foto para su perfil de usuario.</p>
                      <form name="formulario" enctype="multipart/form-data" method="POST" action="subir.php">
                        <p align="center" ><img alt="Graphic will preview here" id="previewField" src="img/sin_imagen.jpg" /></p>
                        <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                        <input type="file" name="foto" id="foto" onchange="preview(this)" />
                       </form>
	   </div>
    </body>
</html>
<?PHP
            }//END IF-ELSE
?>