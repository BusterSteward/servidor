//CÓMO LLAMAR A UN SCRIPT PHP

//usando iframes
var el_iframe = window.frames['iframe_id'];
	// borro contenido del iframe correspondiente
	el_iframe.document.open();
	el_iframe.document.close();
	// llamo al script PHP correspondiente
	// le paso un valor
	el_iframe.src="script.php";

    //pasamos parametros por get
    el_iframe.src="script.php?PARAMETRO=VALOR";

//usando jquery
//              script      valor por get   valor por post     callback
$("#div").load("prueba.php?valor2=999",     {"VALOR":numero}, function()
		{
			//código del callback
		});