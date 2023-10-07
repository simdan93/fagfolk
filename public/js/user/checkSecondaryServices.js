$(document).ready(function()
{
	$("#mainservice").change(function()
	{
		var mainservice_id = null;
		var secondaryservice = null;
		var mainservice_id = $('#mainservice').val();

		$("#secondaryservice").empty()

		$.ajax(
		{
			type: "GET",
			url: "/no/bruker/sjekk-servicer-for-hovedfag" + '/' + mainservice_id,
			cache: false,
			dataType: 'json',
			success: function(response)
			{
				secondaryservice = jQuery.parseJSON(response);
				
				$('#secondaryservice').append($('<option>').text('--').attr('value', 0));
				$.each(secondaryservice, function(key,value) {
						$('#secondaryservice').append($('<option>').text(value.spesialisering).attr('value', value.id));
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
