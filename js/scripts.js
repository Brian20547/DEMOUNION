var inicio=function () {
	$(".cantidad").keyup(function(e){
		if($(this).val()!=''){
			if(e.keyCode==13){
				var id=$(this).attr('data-id');
				var precio=$(this).attr('data-precio');
				// obtenemos el valor del input
				var cantidad=$(this).val();
				$(this).parentsUntil('.producto').find('.subtotal').text('Subtotal: '+(precio*cantidad));
				// trabajamos con el archiv modificardatos.php
				$.post('./js/modificardatos.php',{
					Id:id,
					Precio:precio,
					Cantidad:cantidad
					// una función recibe un objeto evento (el echo enviado)
				},function(e){
						$("#total").text('Total: '+e);
				});
			}
		}
	});
}

// función de inicio
$(document).on('ready',inicio);