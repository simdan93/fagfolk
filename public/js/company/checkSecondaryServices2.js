$(document).ready(function()
{
	$("#mainservice2").change(function()
	{
		var mainservice_id = null;
		var secondaryservice = null;
		var mainservice_id = $('#mainservice2').val();
		$.ajax(
		{
			type: "GET",
			url: "/no/selskap/sjekk-servicer-for-hovedfag-selskap" + '/' + mainservice_id,
			cache: false,
			dataType: 'json',
			success: function(response)
			{
				secondaryservice = jQuery.parseJSON(response);

				for (i = 0; i < 60; i++) {
					var OptionValueString = "#secondaryservice2 option[value='"+i+"']";
					$(OptionValueString).remove()
				}
				$('#secondaryservice2').append($('<option>').text('--').attr('value', 0));
				$.each(secondaryservice, function(key,value) {
						$('#secondaryservice2').append($('<option>').text(value.spesialisering).attr('value', value.id));
				});
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				console.log('jqXHR:');
        console.log(jqXHR);
        console.log('textStatus:');
        console.log(textStatus);
        console.log('errorThrown:');
        console.log(errorThrown);
			}
		});
	});
});
