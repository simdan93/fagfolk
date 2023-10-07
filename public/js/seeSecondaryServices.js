$(document).ready(function()
{
	$(".mainService").click(function()
	{
		var mainServiceID = $(this).attr('value');
		var linkID = $(this).attr('id');
		var resultBox = "#seeSecondaryServices" + linkID;
		var mainServiceName = $(this).text();

		var forValue = 0;
		if(linkID > 3 && linkID <= 6){
			forValue = 3;
		}
		else if (linkID > 6 && linkID <= 9){
			forValue = 6;
		}
		else if (linkID > 9 && linkID <= 12) {
			forValue = 9;
		}
		else if (linkID > 12 && linkID <= 15) {
			forValue = 12;
		}
		else if (linkID > 15 && linkID <= 18){
			forValue = 15;
		}
		else {
			forValue = 0;
		}
		for(i = forValue+1; i <= forValue+3; i++) {
		 $("#seeSecondaryServices" + i).empty()
		}
		for(i = 1; i < 14; i++){
			$( 'div#mainServiceBox'+ i).removeClass( "mainServiceBox2" );
			$( 'div.secServiceRow').removeClass( "secServiceRow2" );
		}

		$(resultBox).toggle();
	 	$( 'div#mainServiceBox'+ linkID).toggleClass( "mainServiceBox2" );
		$( 'div.secServiceRow').toggleClass( "secServiceRow2" );

		$(resultBox).append('<div class="secServiceInfoBox" id="info'+mainServiceID+'" style="">\
													<p><b>'+mainServiceName+'</b>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean \
													commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient \
													montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, \
													sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate \
													eget, arcu.</p>\
												</div>');

	  $("div#info"+mainServiceID).append('<div class="secServiceInnerBox" id="secBoxMain'+mainServiceID +'" style="border: 1px solid #DDDDDD;"></div>');

		var csrf_field = $('meta[name="csrf-token"]').attr('content')
		$("div#modules").append('<div class="modal fade" id="findHelpAsUser2">\
															<div class="modal-dialog">\
																	<div class="modal-content">\
																		<form class="form-horizontal" method="POST" action="no/bruker/logg-inn-3">\
																			<input name="_token" value="'+csrf_field+'" type="hidden">\
																			<input name="mainServiceID" value="'+mainServiceID+'" type="hidden">\
																			<div class="modal-header">\
																					<h3 class="modal-title">Login som en kunde</h3>\
																					<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
																							<span aria-hidden="true">&times;</span>\
																					</button>\
																			</div>\
																			<div class="modal-body">\
																				<div class="form-group">\
																						<label for="email" class="col-md-4 control-label">Email</label>\
																						<div class="col-md-6">\
																								<input id="email" type="email" class="form-control" name="email" required autofocus>\
																						</div>\
																				</div>\
																				<div class="form-group">\
																						<label for="password" class="col-md-4 control-label">Passord</label>\
																						<div class="col-md-6">\
																								<input id="password" type="password" class="form-control" name="password" required>\
																						</div>\
																				</div>\
																				<div class="form-group">\
																						<div class="col-md-4 col-md-offset-4-ds">\
																								<a class="btn btn-link" href="no/bruker/passord/tilbakestill">\
																										Glemt passordet?\
																								</a>\
																						</div>\
																				</div>\
																				<div class="form-group">\
																						<div class="col-md-6 col-md-offset-4-ds">\
																								<div class="checkbox">\
																										<label>\
																												<input type="checkbox" name="remember"> Husk meg\
																										</label>\
																								</div>\
																						</div>\
																				</div>\
																				<div class="form-group">\
																					<a href="no/bruker/registrer">Registrer deg som en kunde</a>\
																				</div>\
																			</div>\
																			<div class="modal-footer">\
																					<button type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>\
																					<button type="submit" class="btn btn-primary">Login</button>\
																			</div>\
																		</form>\
																	</div>\
															</div>\
														</div>');
			$('div#modules').append('<div class="modal fade" id="findHelpAsCompany2">\
	                              <div class="modal-dialog">\
	                                <div class="modal-content">\
	                                  <form class="form-horizontal" method="POST" action="no/selskap/logg-inn-3">\
	                                    <input name="_token" value="'+csrf_field+'" type="hidden">\
	                                    <input name="mainServiceIDCompany" value="'+mainServiceID+'" type="hidden">\
	                                    <div class="modal-header">\
	                                        <h3 class="modal-title">Login som en fagman</h3>\
	                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
	                                            <span aria-hidden="true">&times;</span>\
	                                        </button>\
	                                    </div>\
	                                    <div class="modal-body">\
	                                      <div class="form-group">\
	                                          <label for="email" class="col-md-4 control-label">Email</label>\
	                                          <div class="col-md-6">\
	                                              <input id="emailCompany" type="email" class="form-control" name="email" required autofocus>\
	                                          </div>\
	                                      </div>\
	                                      <div class="form-group">\
	                                          <label for="password" class="col-md-4 control-label">Passord</label>\
	                                          <div class="col-md-6">\
	                                              <input id="passwordCompany" type="password" class="form-control" name="password" required>\
	                                          </div>\
	                                      </div>\
	                                      <div class="form-group">\
	                                          <div class="col-md-4 col-md-offset-4-ds">\
	                                              <a class="btn btn-link" href="no/selskap/passord/tilbakestill">\
	                                                  Glemt passordet?\
	                                              </a>\
	                                          </div>\
	                                      </div>\
	                                      <div class="form-group">\
	                                          <div class="col-md-6 col-md-offset-4-ds">\
	                                              <div class="checkbox">\
	                                                  <label>\
	                                                      <input type="checkbox" name="remember"> Husk meg\
	                                                  </label>\
	                                              </div>\
	                                          </div>\
	                                      </div>\
	                                      <div class="form-group">\
	                                        <a href="no/selskap/registrer">Registrer deg som selskap</a>\
	                                      </div>\
	                                    </div>\
	                                    <div class="modal-footer">\
	                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>\
	                                        <button type="submit" class="btn btn-primary">Login</button>\
	                                    </div>\
	                                  </form>\
	                                </div>\
	                              </div>\
	                            </div>');

		$.ajax(
		{
			type: "GET",
			url: "/no/get-secondary-services/" + mainServiceID,
			cache: false,
			dataType: 'json',
			success: function(response)
			{
				var secServices = jQuery.parseJSON(response);

				var count = 0;
				var newCount = 1;
				var secRowCount = 0;
				var lenghtDividedByThree = Math.ceil((secServices.length / 3));
				var jValue = 3;

				//Check if we have any secondary services for main service, if not let user register help
				//with out secondary service filled out.
				if (secServices.length > 0)
				{
					for(i = 0; i < lenghtDividedByThree; i++)
					{
						secRowCount = secRowCount + 1;

						$("div#secBoxMain"+mainServiceID).append('<div class="secServiceInnerRow" id="main'+mainServiceID+'SecRow'+i+'"></div>');
						if((secServices.length-count) < 3)
							jValue = secServices.length-count;
						for(j = 0; j < jValue; j++)
						{
							$("div#main"+mainServiceID+"SecRow"+i).append('<div class="secServiceBox" id="secServiceBox'+newCount+'">\
																															<div class="descriptionField" id="'+newCount+'" value="'+secServices[count].id+'" >\
																																<img src="images/Services/secondary_services/service_id_'+secServices[count].id+'.jpg" width="100%" alt="'+secServices[count].spesialisering+'">\
																																<h4 class="service-name pull-left">'+secServices[count].spesialisering+'</h4>\
																															</div>\
																														</div>');
							count = count + 1;
							newCount = newCount + 1;
						}
						for(k = count-(j-1); k <= count; k++)
						{
							$("div#secBoxMain"+mainServiceID).append('<div class="describtionRow" id="describtionRow'+k+'"></div>');
						}
					}
				}
				else {
					var loggedUser = $('div#modules').attr('value');
			    if(loggedUser == "costumer"){
			      $("div#secBoxMain"+mainServiceID).append('<p><a href="no/bruker/finn-hjelp/hovedfag='+mainServiceID+'" ><button type="button" class="btn btn-primary" style="color:white;padding: 12px 24px;">Find fagfolk</button></a></p>');
			    }
			    else if(loggedUser == "company"){
			      $("div#secBoxMain"+mainServiceID).append('<p><a href="no/selskap/finn-hjelp/hovedfag='+mainServiceID+'" ><button type="button" class="btn btn-primary" style="color:white;padding: 12px 24px;">Find andre fagfolk</button></a></p>');
			    }
			    else {
			      $("div#secBoxMain"+mainServiceID).append('<a href = "#" data-toggle="modal" data-target="#findHelpAsUser2"><button type="button" class="btn btn-primary" style="color:white;padding: 12px 24px;">Find fagfolk</button></a>\
			                                <a href = "#" data-toggle="modal" data-target="#findHelpAsCompany2"><button type="button" class="btn btn-primary" style="color:white;padding: 12px 24px;">Find andre fagfolk</button></a>');
			    }
				}
			}
		});
	});
});
