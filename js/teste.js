 $("#retorno").on('click',function(e){
	         var value = e;
	         $.ajax({
	         	type:'POST',
	         	url:'recebe.php',
	         	datatype:'json',
	         	data:{arquivo:value},
	         	success: function(response){
	         		alert(response);

	         	}
	         });
         });