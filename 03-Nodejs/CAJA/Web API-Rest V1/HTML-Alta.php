<?php
usleep(300000);
?>

<div class="contenedor-formulario">
			
			<form id="formulario1" name="formulario1"
			ACTION="" TARGET="" METHOD="POST" autocomplete="off" ENCTYPE="multipart/form-data"
			onsubmit="alta_API();return false;">	 

				<legend class="leyenda">Alta de Cliente: </legend><br>

				<div class="form-group">
					<label>Nombre:</label>
					<input class="input-control" id="nombre" name="nombre" maxlength="20" style="width:50%" required
					autocomplete="off">
				</div>
				
				<div class="form-group">
					<label>Salario:</label>
					<input class="input-control" type="number" id="salario" name="salario" style="width: 40%" required
					 min="1" max="9999999999" autocomplete="off" onclick="">
				</div>					
				
				<div class="div_mensaje" id="div_mensaje" style="height:35px;"></div>
			
				<button class="boton" id="boton1" type="reset" form="formulario1"
				onclick="document.getElementById('nombre').disabled=false;	
				                document.getElementById('salario').disabled=false;
								document.getElementById('div_mensaje').innerHTML='';
								document.getElementById('boton2').disabled=false;
								document.getElementById('nombre').focus();">
				<i class="fa fa-trash"></i> Limpiar
				</button>

				<button class="boton" id="boton2" type="submit" form="formulario1"
				onclick="">
				<i class="fa fa-home"></i> Alta-API
				</button>					
				
				<button class="boton" id="boton3" type="button"
				onclick="location.href=('index1.html');">
				<i class="fas fa-window-close"></i> Cancelar
				</button>										
</form>
</div>
