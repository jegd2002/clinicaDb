<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <script>
		document.addEventListener("DOMContentLoaded", function() {
            var formulario = document.getElementById("formularioPrincipal");
            var enviarBoton = document.getElementById("enviar_formulario");

            formulario.addEventListener("submit", function(event) {
                var nombreInput = document.getElementById("usuario_nombre");
                var edadInput = document.getElementById("usuario_edad");
                var generoInput = document.getElementById("usuario_genero");
				var departamentoInput = document.getElementById("usuario_departamentoID");
				var municipioInput = document.getElementById("usuario_municipioID");
				var documento = document.getElementById("usuario_documento");
				var usuario = document.getElementById("usuario_usuario");
				var clave_1 = document.getElementById("usuario_clave_1");
				var clave_2 = document.getElementById("usuario_clave_2");
				
			
                // Verificar si los campos están vacíos
                if (nombreInput.value.trim() === "" || edadInput.value.trim() === "" || generoInput.value.trim() === "" || departamentoInput.value.trim()===""||
					municipioInput.value.trim()=== ""|| documento.value.trim() ==="" || usuario.value.trim() === "" ||clave_1.value.trim() === "" ||clave_2.value.trim() === ""
					){
                    alert("Por favor, complete todos los campos obligatorios.");
                    event.preventDefault(); // No se envia el formulario
                }
            });
        });
	</script> 
 </head> 
 <body>  
	
 <div class="container is-fluid mb-6">
	<h1 class="title">Usuarios</h1>
	<h2 class="subtitle">Nuevo usuario</h2>
</div>

<div class="container pb-6 pt-6">

	<form class="FormularioAjax" id="formularioPrincipal" action="<?php echo APP_URL;?>app/ajax/pacienteAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data" >

		<input type="hidden" name="modulo_usuario" value="registrar">

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombres</label>
				  	<input class="input" type="text" id="usuario_nombre" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Edad</label>
				  	<input class="input" type="text" id="usuario_edad" name="usuario_edad" pattern="[0-9]{0,3}" maxlength="3" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Genero</label>
				  	<input class="input" type="text" id="usuario_genero"pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,15}"  maxlength="15" name="usuario_genero" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Departamento</label>
				  	<input class="input" type="text" id="usuario_departamentoID" name="usuario_departamentoID" maxlength="70" required>
				</div>
		  	</div>
              <div class="column">
		    	<div class="control">
					<label>Municipio</label>
				  	<input class="input" type="text" id="usuario_municipioID" name="usuario_municipioID" maxlength="70" required >
				</div>
		  	</div>
		</div>
        <div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Documento Identidad</label>
				  	<input class="input" type="text" id="usuario_documento" name="usuario_documento" pattern="[0-9]{4,20}" maxlength="20" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Usuario</label>
				  	<input class="input" type="text" id="usuario_usuario" name="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
				</div>
		  	</div>
              
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Clave</label>
				  	<input class="input" type="password" id="usuario_clave_1" name="usuario_clave_1" pattern="[a-zA-Z0-9]{7,100}" maxlength="100" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Repetir clave</label>
				  	<input class="input" type="password" id="usuario_clave_2" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
				</div>
		  	</div>
		</div>
		
		<p class="has-text-centered">
			<button type="reset" class="button is-link is-light is-rounded">Limpiar</button>
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
 </div>
</body>
</html> 

