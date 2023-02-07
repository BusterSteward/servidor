<?php
usleep(300000);
?>

<div class="contenedor-formulario">
			<form id="formulario1" name="formulario1"
			ACTION="" TARGET="" METHOD="POST" autocomplete="off" ENCTYPE="multipart/form-data"
			onsubmit="consulta_API(document.getElementById('id').value,1);return false;">	 

			<legend class="leyenda">Modificar Cliente: </legend><br>
			
			<div class="form-group">
				<label>Id Cliente:</label>
				<input class="input-control" type="number" id="id" name="id"  min="1" max="999" style="width:10%" required autocomplete="off"
				onKeyPress="if(this.value.length>2) return false;">
			</div>
			
			<div class="form-group">
				<label>Nombre:</label>
				<input class="input-control" id="nombre" name="nombre" disabled value="" style="width: 35%">
			</div>

			<div class="form-group">
				<label>Salario:</label>
				<input class="input-control" id="salario" name="salario" disabled value="" style="width: 20%">
			</div>

			<div class="div_mensaje" id="div_mensaje" style="height:35px;"></div>

			<button class="boton" id="boton1" type="reset"
			onclick="document.getElementById('id').disabled=false;
						   document.getElementById('boton2').disabled=false;
						   document.getElementById('boton3').disabled=true;
						   document.getElementById('nombre').disabled=true;
						   document.getElementById('salario').disabled=true;						   
						   document.getElementById('div_mensaje').innerHTML='';
						   document.getElementById('id').focus();">
			<i class="fa fa-trash"></i> Limpiar
			</button>

			<button class="boton" id="boton2" type="submit" form="formulario1"
			onclick="">
			<i class="fa fa-home"></i> Consulta-API
			</button>		

			<button class="boton" id="boton3" type="button" disabled 
			onclick="modificar_API(document.getElementById('id').value)">
			<i class="fa fa-home"></i> Modificar-API
			</button>						
			
			<button class="boton" id="boton4" type="button"
			onclick="location.href=('index1.html');">
			<i class="fas fa-window-close"></i> Cancelar
			</button>										
</form>
</div>
