$(document).on('click', '.descriptionField', function()
{
    var secServiceID = $(this).attr('value');
		var linkID = $(this).attr('id');
		var resultdescBox = "#describtionRow" + linkID;
		var secServiceName = $(this).text();
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
    for(i = forValue+1; i <= (forValue+3); i++) {
     $("#describtionRow" + i).empty()
    }

    for(i = 1; i < 60; i++){
      $( 'div#secServiceBox'+ i).removeClass( "secServiceBox2" );
      $( 'div.describtionRow').removeClass( "describtionRow2" );
    }
    $(resultdescBox).toggle()
    $( 'div#secServiceBox'+ linkID).toggleClass( "secServiceBox2" );
    $( 'div.describtionRow').toggleClass( "describtionRow2" );

    var loggedUser = $('div#modules').attr('value');
    if(loggedUser == "costumer"){
      $(resultdescBox).append('<div class="" style="">\
                                <p><b>'+secServiceName+'</b>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean\
      													commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient\
      													montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,\
      													sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate\
      													eget, arcu.</p>\
                                <a href="no/bruker/finn-hjelp/spesialisering='+secServiceID+'" ><button type="button" class="btn btn-primary" style="color:white;padding: 12px 24px;">Find fagfolk</button></a>\
                              </div>');
    }
    else if(loggedUser == "company"){
      $(resultdescBox).append('<div class="" style="">\
                                <p><b>'+secServiceName+'</b>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean\
                                commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient\
                                montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,\
                                sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate\
                                eget, arcu.</p>\
                                <a href="no/selskap/finn-hjelp/spesialisering='+secServiceID+'" ><button type="button" class="btn btn-primary" style="color:white;padding: 12px 24px;">Find andre fagfolk</button></a>\
                              </div>');
    }
    else {
      $(resultdescBox).append('<div class="" style="">\
                                <p><b>'+secServiceName+'</b>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean\
                                commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient\
                                montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,\
                                sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate\
                                eget, arcu.</p>\
                                <a href = "#" data-toggle="modal" data-target="#findHelpAsUser"><button type="button" class="btn btn-primary" style="color:white;padding: 12px 24px;">Find fagman som kunde</button></a>\
                                <a href = "#" data-toggle="modal" data-target="#findHelpAsCompany"><button type="button" class="btn btn-primary" style="color:white;padding: 12px 24px;">Find andre fagfolk som fagman</button></a>\
                              </div>');
    }
    var csrf_field = $('meta[name="csrf-token"]').attr('content')
    $('div#modules').append('<div class="modal fade" id="findHelpAsUser">\
                              <div class="modal-dialog">\
                                  <div class="modal-content">\
                                    <form class="form-horizontal" method="POST" action="no/bruker/logg-inn-2">\
                                      <input name="_token" value="'+csrf_field+'" type="hidden">\
                                      <input name="secServiceID" value="'+secServiceID+'" type="hidden">\
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
    $('div#modules').append('<div class="modal fade" id="findHelpAsCompany">\
                              <div class="modal-dialog">\
                                <div class="modal-content">\
                                  <form class="form-horizontal" method="POST" action="no/selskap/logg-inn-2">\
                                    <input name="_token" value="'+csrf_field+'" type="hidden">\
                                    <input name="secServiceIDCompany" value="'+secServiceID+'" type="hidden">\
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

});
