$(document).ready(function(){
	$("#textarea_noticia").focus(function(){
		document.getElementById("textarea_noticia").value = "";
		$("#textarea_noticia").value = "";
		return false;
	});
	// Enviar Noticia
	$(".enviar_noticia").click(function(){
		var element = $(this);
		// Recuperar valos de la caja de texto
		var textarea_noticia = $("#textarea_noticia").val();
		var dataString = "textarea_noticia="+textarea_noticia;
		// Comprobar que tenga algun valor 
		if(textarea_noticia == ""){
			alert("Debe ingresar una noticia");
		} else {
			// Motrar feedback
			$("#cargando")
			.show()
			.html("<img src='omg/moreajax.gif' />");
			// Enviar datos
			
			$.ajax({
				type: "POST",
				url: "insertarNoticia.php",
				data: dataString,
				cache: false,
				success: function(html){
					// Agregar datos devueltos por el archivo insertarNoticia
					$("#mostrar").prepend($(html).fadeIn(1200));
					// Quitar contenido de la caja de texto de enviar noticia
					document.getElementById("textarea_noticia").value = "";
					$("#textarea_noticia").value = "";
					// Hacer un focus
					$("#textarea_noticia").focus();
					// Ocultar feedback
					$("#cargando").hide();
				}
			})
		}
		// Esto se hace para que el codigo no haga que se refresque la pagina
		return false;
	});	
	// Borrar Noticia
	$('.eliminar_noticia_actualizado').live("click",function(){
		var ID = $(this).attr("id");
		var dataString = 'msg_id='+ ID;
		// Enviar datos
		$.ajax({
			type: "POST",
	  		url: "borrarNoticia.php",
	   	data: dataString,
	  		cache: false,
	  		success: function(html){
	  			// Clase a la cual va afectar
	 	 		$(".bar"+ID)
	 	 		.animate({ backgroundColor: "#fbc7c7" }, 800)
				.animate({ opacity: "hide" }, 1200);
			}
	 	});
	 	return false;
	});
	// Mostrar la caja de texto para comentar
	$('.comentar').live("click",function(){
		// Obtener valor del id
		var ID = $(this).attr("id");
		$(".contenedor_textarea_comentario"+ID).slideToggle(300);
		return false;
	});
	// Insertar Comentario
	$('.enviar_comentario').live("click",function(){
		var ID = $(this).attr("id");
		var comentario_valor = $("#textarea"+ID).val();
		// lo que se pasa en string son las variables que se le pasaran al archivo .php
		var dataString = 'comentario_valor='+ comentario_valor + '&id=' + ID;
		if(comentario_valor==''){
			alert("Por favor ingresa un comentario");
		} else {
			$.ajax({
				type: "POST",
		  		url: "insertarComentario.php",
		   	data: dataString,
		  		cache: false,
		  		success: function(html){
		  			$("#comentario_cargado"+ID).append($(html).fadeIn(1200));
	   			document.getElementById("textarea"+ID).value='';
		   		$("#textarea"+ID).focus();
		  
		  		}
	 		});
		}
		return false;
	});
	// Borrar comentario
	$(".comentario_borrar_actualizar").live("click",function(){
		// Obtener valor del id
		var com_id = $(this).attr("id");
		var dataString = "com_id="+com_id;
		$.ajax({
			type: "POST",
			url: "borrarComentario.php",
			data: dataString,
			cache: false,
			success: function(){
				$("#conetenedor_comentarios"+com_id)
				.animate({ backgroundColor: "#fbc7c7" }, 500)
				.animate({ opacity: "hide" }, 1000);
			}
		});
		return false;
	});
	// Ver los demas comentarios
	$(".view_comments").click(function(){
		var id = $(this).attr("id");
		var dataString = "msg_id="+id;
		$.ajax({
			type: "POST",
			url: "verTodosComentarios.php",
			data: dataString,
			cache: false,
			success: function(data){
				// Mostrar todos los comentarios
				$("#view_comments"+id).prepend($(data).fadeIn("fast"));
				// Remover enlace de ver ...... comentarios
				$("#view"+id).remove();
				// Remover contenedor principal
				$("#two_comments"+id).remove();
			}
		});
		return false;
	}); 
});