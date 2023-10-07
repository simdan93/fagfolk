$(document).ready(function() 
{	
	$(".msgFromWorker").click(function()
	{
		var buttonID = $(this).attr('id');
		var rsp_msg = $(this).val();
		var responseBox = "div#msgFromWorker"+buttonID;
		$(responseBox).toggle();
		
		$(responseBox).find("p#svarFraFagman").empty();
	
		$(responseBox).find("p#svarFraFagman").append(rsp_msg);
	});
});
