$(document).ready(function()
{
	var btnpressed;
	$('.submitbtn').click(function () {
		btnpressed = $(this).attr('name')
  })

  $('form').submit(function() {
		if(btnpressed == "seekingMultiple")
			var input = $("<input>", {type: "hidden", name: "befaring", value: 1});
		else
			var input = $("<input>", {type: "hidden", name: "befaring", value: 0});

		$('form').append($(input));

    btnpressed=''
    return true;
  })
});
