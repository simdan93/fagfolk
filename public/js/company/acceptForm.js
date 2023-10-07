$(document).ready(function()
{
	$(".acceptRequest").click(function()
	{
		var userNeedID = $(this).val();
		var buttonID = $(this).attr('id');
		var resultUser = "div.acceptRequest"+buttonID;

		$(resultUser).toggle();

		$(this).toggleClass('acceptRequest');
		if($(this).hasClass('acceptRequest')){
			$(this).text('Aksepter');
		} else {
			$(this).text('Avbryt');
		}

		var csrf_tag = $('meta[name="csrf-token"]').attr('content')

		$(resultUser).empty();
		$(resultUser).append('<form class="form-horizontal" method="POST" action="/no/selskap/aksepter-forespoorsel-kunde/'+userNeedID+'">\
														<input name="_token" value="'+csrf_tag+'" type="hidden">\
														<input type="text" id="response_message" name="response_message" class="form-control" placeholder="Melding til kunde..." required>\
														<br>\
														<input type="submit" id="submit" value="Send">\
													</form>');
	});
	$(".acceptRequestCompany").click(function()
	{
		var companyNeedID = $(this).val();
		console.log(companyNeedID);
		var buttonID = $(this).attr('id');
		var resultCompany = "div.acceptRequestCompany"+buttonID;
		console.log(resultCompany);

		$(resultCompany).toggle();

		$(this).toggleClass('acceptRequestCompany');
		if($(this).hasClass('acceptRequestCompany')){
			$(this).text('Aksepter');
		} else {
			$(this).text('Avbryt');
		}

		var csrf_tag2 = $('meta[name="csrf-token"]').attr('content')

		$(resultCompany).empty();
		$(resultCompany).append('<form class="form-horizontal" method="POST" action="/no/selskap/aksepter-forespoorsel-selskap/'+companyNeedID+'">\
														<input name="_token" value="'+csrf_tag2+'" type="hidden">\
														<input type="text" id="response_message" name="response_message" class="form-control" placeholder="Melding til selskap..." required>\
														<br>\
														<input type="submit" id="submit" value="Send">\
													</form>');
	});
});
