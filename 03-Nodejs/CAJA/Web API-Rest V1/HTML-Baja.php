<?php
usleep(300000);
?>

<div class="contenedor-formulario">
			<form id="formulario1" name="formulario1"
			ACTION="" TARGET="" METHOD="POST" autocomplete="off" ENCTYPE="multipart/form-data"
			onsubmit="baja_API(document.getElementById('id').value);return false;">	 
			
			<legend class="leyenda">Baja de Cliente: </legend><br>
			
			<div class="form-group">
				<label>Id Cliente:</label>
				<input class="input-control" type="number" id="id" name="id"  min="1" max="999" style="width:15%" required autocomplete="off"
				onKeyPress="">
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
			<i class="fa fa-home"></i> Baja-API
			</button>					
			
			<button class="boton" id="boton3" type="button"
			onclick="location.href=('index1.html');">
			<i class="fas fa-window-close"></i> Cancelar
			</button>										
</form>
</div>
