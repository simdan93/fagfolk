$(document).on('click', '#linkToFindHelpUser', function()
{
  $.get( "/ajax/login-status", function( data )
  {
      var status = data.status; //== false ? $( 'li#status').show() : $( 'li#status').hide();
  });
});
