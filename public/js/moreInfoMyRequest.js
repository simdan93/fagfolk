$(document).ready(function()
{
	$(".moreInfoButtonUser").click(function()
	{
		var userneed_id = $(this).val();
		var buttonID = $(this).attr('id');
		var resultUser = "div.moreInfoUser"+buttonID;
		$(resultUser).toggle()

		$.ajax(
		{
			type: "GET",
			url: "/no/bruker/mer-info-om-mitt-behov/" + userneed_id,
			cache: false,
			dataType: 'json',
			success: function(response)
			{
				var user_needs = jQuery.parseJSON(response);

				$(resultUser).find("p.resultTilgjengelig").empty()
				$(resultUser).find("p.resultOppsummering").empty()
				$(resultUser).find("p.resultBeskrivelse").empty()
				$.each(user_needs, function(key,value) {
						$(resultUser).find("p.resultTilgjengelig").append('Tilgjengelig: ', value.tilgjengelig);
						$(resultUser).find('p.resultOppsummering').append('Oppsumering: ',value.oppsummering);
						$(resultUser).find('p.resultBeskrivelse').append('Beskrivelse: ', value.beskrivelse);
				});
			}
		});
	});

	$(".moreInfoButtonCompany").click(function()
	{
		var companyneed_id = $(this).val();
		var buttonID = $(this).attr('id');
		var resultCompany = "div.moreInfoCompany"+buttonID;

		$(resultCompany).toggle()

		$.ajax(
		{
			type: "GET",
			url: "/no/selskap/mer-info-om-mitt-behov/" + companyneed_id,
			cache: false,
			dataType: 'json',
			success: function(response)
			{
				var company_needs = jQuery.parseJSON(response);

				$(resultCompany).find("p.resultTilgjengelig").empty()
				$(resultCompany).find("p.resultOppsummering").empty()
				$(resultCompany).find("p.resultBeskrivelse").empty()
				$.each(company_needs, function(key,value) {
						$(resultCompany).find("p.resultTilgjengelig").append('Tilgjengelig: ', value.tilgjengelig);
						$(resultCompany).find('p.resultOppsummering').append('Oppsumering: ',value.oppsummering);
						$(resultCompany).find('p.resultBeskrivelse').append('Beskrivelse: ', value.beskrivelse);
				});
			}
		});
	});
});
