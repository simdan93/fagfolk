$(document).ready(function()
{
	$("#checkInfo").click(function()
	{
		var mainservice = $('#mainservice').val();
		var secondaryservice = $('#secondaryservice').val();
		var postnummer = $('#postnummer').val();
		var tilgjengelig = $('#tilgjengelig').val();

		$.ajax(
		{
			type: "GET",
			url: "/no/bruker/sjekk-info/" + mainservice + '/'+ secondaryservice + '/'+ postnummer + '/'+ tilgjengelig,
			cache: false,
			dataType: 'json',
			success: function(response)
			{
				console.log(response);

				var obj = jQuery.parseJSON(response);
				var counter = 0;
				$.each(obj, function(key,value)
				{
					counter++;
				});
				console.log('counter: '+counter);
				if(counter == 0)
					$("#result").html("Ingen selskap funnet med de kriteriene.");
				else if(counter == 1)
					$("#result").html("Ett selskap funnet med de kriteriene.");
				else
					$("#result").html(counter + " selskaper funnet med de kriteriene.");
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				console.log('jqXHR: '+jqXHR);
        console.log('textStatus: '+textStatus);
        console.log('errorThrown:');
        console.log(errorThrown);
			}
		});
	});
});
