<?php
usleep(300000);
?>

<div class="contenedor-formulario">
				<form id="formulario1" name "formulario1" action="" method="post" autocomplete="off" 
				enctype="multipart/form-data"
				onsubmit="alta_API();return false;">	 				

				<legend class="leyenda">Alta de Cliente: </legend><br>

				<div class="form-group">
					<label>Nombre:</label>
					<input class="input-control" id="nombre" name="nombre" maxlength="15" style="width:50%" required autocomplete="off">
				</div>
				
				<div class="form-group">
					<label style="margin-right:3px">Provincia:</label>
					<select id="provincia" name= "provincia"  required style="CURSOR:pointer;width:40%;height:31px;margin-bottom:5px">
							<option selected>Selecciona...</option>
							<option value="ALBACETE">ALBACETE</option>
							<option value="CIUDAD REAL">CIUDAD REAL</option>
							<option value="CUENCA">CUENCA</option>
							<option value="GUADALAJARA">GUADALAJARA</option>
							<option value="TOLEDO">TOLEDO</option>                     
					</select> 		
				</div>					
				
				<div class="form-group">
					<label>Edad:</label>
					<input class="input-control" type="number" id="edad" name="edad" style="width: 15%" required
					 min="1" max="150" autocomplete="off" onclick="">
				</div>					
				
				<div class="form-group">
					<label>Fecha Alta:</label>
					<input class="input-control" type="date" id="fecha" name="fecha" required value="<?php echo date('Y-m-d');?>"
					 style="width:45%;cursor:pointer">
				</div>					

				<img id="img1" src="imagenes/usuario.png" width="80" height="80" style="border:1px solid blue" >
				
				<div class="form-group">
					<label>Imagen:</label>
					<input class="input-control" id="foto1" name="foto1" type="file"  required 
					style="padding-bottom: 10px;border:0px;" onchange="visualizo('foto1','img1')"></input>   
				</div>
			
				<div class="div_mensaje" id="div_mensaje" style="width:100%;height:35px;"></div>
			
				<button class="boton" id="boton1" type="reset" form="formulario1"
				onclick="document.getElementById('nombre').focus();
				borroimagen('img1');">
				<i class="fa fa-trash"></i> Limpiar
				</button>

				<button class="boton" id="boton2" type="submit" form="formulario1"
				onclick="">
				<i class="fa fa-home"></i> Alta
				</button>					
				
				<button class="boton" id="boton3" type="button"
				onclick="location.href=('index1.html');">
				<i class="fas fa-window-close"></i> Cancelar
				</button>										
</form>
</div>
