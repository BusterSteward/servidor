<?php
usleep(300000);
?>

<div class="contenedor3">
		
		<button class="boton" id="boton1" type="button"  style="margin-bottom: 10px;"
		onclick="listado_API(document.getElementById('criterio').value);">		
		<i class="fas fa-question"></i> Consulta
		</button>

		<button class="boton" id="boton3" type="button"
		onclick="location.href=('index1.html');">
		<i class="fas fa-window-close"></i> Cancelar
		</button>										

		<label style="width:20%">Ordenar:</label>
		<select id="criterio" name= "criterio" STYLE="CURSOR:pointer;width:120px;height:31px;margin-right:10px">
					<option value="id">ID</option>
					<option value="nombre" selected="selected">NOMBRE</option>
					<option value="provincia">PROVINCIA</option>
					<option value="edad">EDAD</option>
		</select>
		
		<input class="input-control" id="info" name="info" disabled style="width:200px;height:30px;" autocomplete="off">
			
		<!-- donde se visualiza la tabla -->
		<div  id="pongotabla" style="border:1px solid green;">
		</div>			
</div>

