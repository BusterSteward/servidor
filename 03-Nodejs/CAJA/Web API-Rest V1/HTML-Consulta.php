<?php
usleep(300000);
?>

<div class="contenedor-formulario">
			<form id="formulario1" name="formulario1"
			ACTION="" TARGET="" METHOD="POST" autocomplete="off" ENCTYPE="multipart/form-data"
			onsubmit="consulta_API(document.getElementById('id').value,0);return false;">	 
			<!-- pongo un 0 en consulta_API() porque no tengo que habilitar "botón de modificar" -->
			<!-- estoy utilizando "consulta_API()" en la opción "consulta" y en la opción "modificar" -->
			
			<legend class="leyenda">Consulta de Cliente: </legend><br>
			
			<div class="form-group">
				<label>Id Cliente:</label>
				<input class="input-control" type="number" id="id" name="id"  min="1" max="999" style="width:15%" required autocomplete="off"
				onKeyPress="if(this.value.length>2) return false;">
			</div>
			
			<div class="form-group">
				<label>Nombre:</label>
				<input class="input-control" id="nombre" name="nombre" disabled value="" style="width: 60%">
			</div>

			<div class="form-group">
				<label>Salario:</label>
				<input class="input-control" id="salario" name="salario" disabled value="" style="width: 20%">
			</div>

			<div class="div_mensaje" id="div_mensaje" style="height:35px;"></div>

			<button class="boton" id="boton1" type="reset" form="formulario1"
			onclick="document.getElementById('id').disabled=false;
						   document.getElementById('boton2').disabled=false;
						   document.getElementById('div_mensaje').innerHTML='';
						   document.getElementById('id').focus();">
			<i class="fa fa-trash"></i> Limpiar
			</button>

			<button class="boton" id="boton2" type="submit" form="formulario1"
			onclick="">
			<i class="fa fa-home"></i> Consulta-API
			</button>					
			
			<button class="boton" id="boton3" type="button"
			onclick="location.href=('index1.html');">
			<i class="fas fa-window-close"></i> Cancelar
			</button>										
</form>
</div>
