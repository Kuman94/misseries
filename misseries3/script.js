

$("#titulo").focusout(()=> {
	let datos = {
		"nombre": titulo.value ,
	};

	var url = "./comprobarSerie.php"; 

	enviarDatos(datos, url); 
	function enviarDatos(datos,url) {
		$.ajax({
	            data: {
	            	 datos,
	            }, 
 	            url: url,
	            type: 'post',
	            success:  function (response) {
	               console.log(response); 
	              if(response>0) {
	              	$("#alert_create").css("display","flex");
	              	$("#add").css("display","none");
	              } else {
	              	$("#add").css("display","flex");
	              }
	              
	            },
	            error: function (error) {
	                console.log(error.responseText); 
	            },
	    });
	}
});
