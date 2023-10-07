<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'WelcomeController@showSite')->name('welcome');
//Norwegian translation
Route::prefix('no')->group(function()
{
	Route::get('/', 'WelcomeController@showSite');
	Route::get('/get-secondary-services/{id}', 'WelcomeController@sjekk_servicer');
	Route::prefix('bruker')->group(function()
	{
		/* GUEST */
		Route::get('/registrer', 'Auth\UserRegisterController@showRegistrationForm')->name('user.register');
		Route::post('/registrer', 'Auth\UserRegisterController@register')->name('user.register.submit');
		//Register addresses
		Route::get('/registrer-addresser', 'UserAddressesController@showRegistrationForm')->name('user.register-addresses');
		Route::post('/registrer-addresser', 'UserAddressesController@register')->name('user.register-addresses.submit');
		Route::get('/logg-inn', 'Auth\UserLoginController@showLoginForm')->name('user.login');
		Route::post('/logg-inn', 'Auth\UserLoginController@login')->name('user.login.submit');
		Route::post('/logg-inn-2', 'Auth\UserLoginController@login2')->name('user.login.submit2');
		Route::post('/logg-inn-3', 'Auth\UserLoginController@login3')->name('user.login.submit3');

		// Password reset routes
		Route::get('/passord/tilbakestill', 'Auth\UserForgotPasswordController@showLinkRequestForm')->name('user.password.request');
		Route::post('/passord/email', 'Auth\UserForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
		Route::get('/passord/tilbakestill/{token}', 'Auth\UserResetPasswordController@showResetForm')->name('user.password.reset');
		Route::post('/passord/tilbakestill', 'Auth\UserResetPasswordController@reset');
		/* AUTH */
		Route::post('logg-ut', 'Auth\UserLoginController@logout')->name('user.logout');
		Route::get('/', 'UserController@getDBInfo')->name('user.dashboard');
		//User information
		Route::get('/mine-behov', 'UserController@getDBInfoNeeds')->name('user.usersNeeds');
		Route::get('/mine-responser', 'UserController@getDBInfoResponses')->name('user.usersResponses');
		//Find help
		Route::get('/finn-hjelp', 'FindHelpController@showRegisterForm')->name('findHelp');
		Route::get('/finn-hjelp/spesialisering={specID}', 'FindHelpController@showRegisterForm2')->name('user.findHelp2');
		Route::get('/finn-hjelp/hovedfag={mainID}', 'FindHelpController@showRegisterForm3')->name('user.findHelp3');
		Route::post('/finn-hjelp', 'FindHelpController@registerNeed')->name('findHelp.submit');
		Route::get('/mer-info-om-mitt-behov/{cnID}', 'FindHelpController@moreInfoMyNeed');
		Route::get('/sjekk-info/{mainservice}/{secondaryservice}/{postnummer}/{tilgjengelig}', 'FindHelpController@checkInfo');
		Route::get('/sjekk-servicer-for-hovedfag/{id}', 'FindHelpController@sjekk_servicer');
		//Edit help
		Route::get('/slett-hjelp/{needID}', 'EditNeedController@deleteNeed');
		//Get info about help
		Route::get('/oppdater-hjelp/{needID}', 'EditNeedController@showUpdateForm');
		Route::post('/oppdater-hjelp/{needID}', 'EditNeedController@updateNeed');
		//Register and edit Details
		Route::prefix('mine-detaljer')->group(function()
		{
			//Edit details
			Route::get('/', 'UserDetailsController@showUserInfo')->name('user.details');
			Route::get('/oppdater-detaljer', 'UserDetailsController@showUpdateForm')->name('user.update-details');
			Route::post('/oppdater-detaljer', 'UserDetailsController@updateDetails');
			Route::get('/oppdater-addresser', 'UserAddressesController@showUpdateForm')->name('user.update-addresses');
			Route::post('/oppdater-addresser', 'UserAddressesController@updateDetails')->name('user.submit.addresses-updates');
			//Route::get('/registrer-addresser', 'UserAddressesController@showRegistrationForm')->name('user.register-addresses');
			//Route::post('/registrer-addresser', 'UserAddressesController@register')->name('user.register-addresses.submit');
		});
		//Handle responses
		Route::get('/aksepter-respons/{responseID}/{needID}', 'UserResponseController@acceptResponse')->name('acceptResponse');
		Route::get('/ignorer-respons/{responseID}/{needID}', 'UserResponseController@ignoreResponse')->name('ignoreResponse');

		Route::get('/test-mail/{responseID}', 'UserResponseController@acceptResponse')->name('testMail');
	});

	Route::prefix('selskap')->group(function()
	{
		/* GUEST */
		Route::get('/registrer', 'Auth\CompanyRegisterController@showRegistrationForm')->name('company.register');
		Route::post('/register', 'Auth\CompanyRegisterController@register')->name('company.register.submit');
		/// Fill in company info
		Route::get('/register-detaljer', 'CompanyDetailsController@showRegistrationForm')->name('company.fillInfo');
		Route::post('/register-detaljer', 'CompanyDetailsController@register')->name('company.register.submit_details');
		// Finn in company addresses
		Route::get('/registrer-addresser', 'CompanyAddressesController@showRegistrationForm')->name('company.register-addresses');
		Route::post('/registrer-addresser', 'CompanyAddressesController@register')->name('company.register-addresses.submit');
		/// Register addresses
		Route::get('/registrer-service', 'CompanyDetailsController@showRegistrationFormAddService')->name('company.register.service');
		Route::post('/registrer-service', 'CompanyDetailsController@registerService');
		//Registrer første servicerRoute::get('/registrer-addresser', 'CompanyAddressesController@showRegistrationForm_2')->name('company.register-adresses-2');
		Route::get('/logg-inn', 'Auth\CompanyLoginController@showLoginForm')->name('company.login');
		Route::post('/logg-inn', 'Auth\CompanyLoginController@login')->name('company.login.submit');
		Route::post('/logg-inn-2', 'Auth\CompanyLoginController@login2')->name('company.login.submit2');
		Route::post('/logg-inn-3', 'Auth\CompanyLoginController@login3')->name('company.login.submit3');

		// Password reset routes
		Route::post('/passord/email', 'Auth\CompanyForgotPasswordController@sendResetLinkEmail')->name('company.password.email');
		Route::get('/passord/tilbakestill', 'Auth\CompanyForgotPasswordController@showLinkRequestForm')->name('company.password.request');
		Route::get('/passord/tilbakestill/{token}', 'Auth\CompanyResetPasswordController@showResetForm')->name('company.password.reset');
		Route::post('/passord/tilbakestill', 'Auth\CompanyResetPasswordController@reset');
		/* AUTH */
		Route::post('logg-ut', 'Auth\CompanyLoginController@logout')->name('company.logout');
		// CompanyController
		Route::get('/', 'CompanyController@getDBInfo')->name('company.dashboard');
		Route::get('/mine-behov', 'CompanyController@getDBInfoNeeds')->name('company.usersNeeds');

		Route::get('/responser-fra-kunder', 'CompanyController@getDBInfoResponsesToUsers')->name('company.usersResponses');
		Route::get('/responser-på-mine-behov', 'CompanyController@getDBInfoResponsesMyNeeds')->name('company.myNeedResponses');
		Route::get('/mine-servicer', 'CompanyController@getDBInfoServices')->name('company.services');
		// FindHelpCompanyController
		Route::get('/finn-hjelp', 'FindHelpCompanyController@showRegisterForm')->name('findHelpCompany');
		Route::get('/finn-hjelp/spesialisering={specID}', 'FindHelpCompanyController@showRegisterForm2')->name('company.findHelpCompany2');
		Route::get('/finn-hjelp/hovedfag={mainID}', 'FindHelpCompanyController@showRegisterForm3')->name('company.findHelpCompany3');
		Route::post('/finn-hjelp', 'FindHelpCompanyController@registerNeed')->name('findHelpCompany.submit');
		Route::get('/mer-info-om-mitt-behov/{cnID}', 'FindHelpCompanyController@moreInfoMyNeed');
		Route::get('/sjekk-info-selskap/{mainservice}/{secondaryservice}/{postnummer}/{tilgjengelig}', 'FindHelpCompanyController@checkInfo');
		/// Register services
		Route::get('/sjekk-servicer-for-hovedfag-selskap/{mainserviceid}', 'FindHelpCompanyController@sjekk_servicer');
		// CompanyDetailsController
		Route::prefix('konfigurasjoner')->group(function()
		{
			Route::get('/', 'CompanyDetailsController@showDBInfoDetails')->name('company.details');
			/// Update company info
			//Route::get('/oppdater-detaljer', 'CompanyDetailsController@showUpdateForm')->name('company.update-details');
			Route::post('/oppdater-detaljer', 'CompanyDetailsController@updateDetails')->name('company.submit.update-details');
			/// Update company info
			Route::post('/oppdater-arbeidsområder', 'CompanyDetailsController@updateWorkAreas')->name('company.submit.update-workAreas');
			/// Register work areas
			Route::get('/registrer-arbeidsområder', 'CompanyDetailsController@showRegistrationFormWorkAreas')->name('company.fillWorkAreaInfo');
			Route::post('/registrer-arbeidsområder', 'CompanyDetailsController@registerWorkAreas')->name('company.register.submit_work_areas');
			/// Edit addresses
			Route::get('/oppdater-addresser', 'CompanyAddressesController@showUpdateForm')->name('company.update-addresses');
			Route::post('/oppdater-addresser', 'CompanyAddressesController@updateDetails')->name('company.submit.addresses-updates');
		});
		Route::get('/oppdater-service/{csID}', 'CompanyDetailsController@showUpdateFormServices')->name('company.update-services');
		Route::post('/oppdater-service/{csID}', 'CompanyDetailsController@updateServices')->name('company.submit.update-services');

		Route::post('/legg-til-service', 'CompanyDetailsController@registerNewService')->name('company.submit.add-services');
		Route::get('/slett-service/{cdID}', 'CompanyDetailsController@deleteService');
		// CompanyEditNeedController
		Route::get('/slett-hjelp/{cnID}', 'CompanyEditNeedController@deleteNeed');
		// RequestUpdateController
		Route::get('/forespoorsler', 'RequestUpdateController@getRequests')->name('company.requests');
		Route::get('/mer-info-om-forespoorsel-selskap/{cnID}', 'RequestUpdateController@moreInfoCompanyNeed');
		Route::get('/mer-info-om-forespoorsel-kunde/{cnID}', 'RequestUpdateController@moreInfoCustomerNeed');
		/// Company accepts requests
		Route::post('/aksepter-forespoorsel-kunde/{userID}', 'RequestUpdateController@submitAcceptRequestUser');
		Route::post('/aksepter-forespoorsel-selskap/{userID}', 'RequestUpdateController@submitAcceptRequestCompany');
		Route::get('/respons-lagt-til', 'RequestUpdateController@showResponseConfirmation')->name('accept.request');
		//CompanyResponseController - Handle responses
		Route::get('/aksepter-respons-selskap/{responseID}/{needID}', 'CompanyResponseController@acceptResponse')->name('acceptResponse');
		Route::get('/ignorer-respons-selskap/{responseID}/{needID}', 'CompanyResponseController@ignoreResponse')->name('ignoreResponse');
		// CompanyProfileController
		Route::prefix('profil')->group(function()
		{
			Route::get('/', 'ProfileController@showProfile')->name('company.profile');
			Route::get('/hent-arbeidsområder', 'CompanyDetailsController@getWorkAreas');
			Route::get('/uploadImages', 'ProfileController@showForm')->name('company.uploadImages');
			Route::post('/uploadImages', 'ProfileController@uploadImages');
			Route::post('/slett-bilder', 'ProfileController@deleteImages')->name('company.deleteImages');
		});
	});
});

/*
//English translation
Route::prefix('en')->group(function()
{
	Route::get('/', function () {
		return view('welcome');
	})->name('welcome');
	Route::prefix('user')->group(function()
	{
		Route::get('/register', 'Auth\UserRegisterController@showRegistrationForm')->name('user.register');
		Route::post('/register', 'Auth\UserRegisterController@register')->name('user.register.submit');
		Route::get('/login', 'Auth\UserLoginController@showLoginForm')->name('user.login');
		Route::post('/login', 'Auth\UserLoginController@login')->name('user.login.submit');
		// Password reset routes
		Route::post('/password/email', 'Auth\UserForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
		Route::get('/password/reset', 'Auth\UserForgotPasswordController@showLinkRequestForm')->name('user.password.request');
		Route::post('/password/reset', 'Auth\UserResetPasswordController@reset');
		Route::get('/password/reset/{token}', 'Auth\UserResetPasswordController@showResetForm')->name('user.password.reset');

		Route::post('logout', 'Auth\UserLoginController@logout')->name('user.logout');
		Route::get('/', 'UserController@getDBInfo')->name('user.dashboard');
		//Find help
		Route::get('/find-help', 'FindHelpController@showRegisterForm')->name('findHelp');
		Route::post('/find-help', 'FindHelpController@registerNeed')->name('findHelp.submit');
		//Edit help
		Route::get('/delete-help/{needID}', 'EditNeedController@deleteNeed');
		Route::get('/update-help/{needID}', 'EditNeedController@showUpdateForm');
		Route::post('/update-help/{needID}', 'EditNeedController@updateNeed')->name('company.submit.detail-updates');
		//Register and edit Details
		Route::prefix('my-details')->group(function()
		{
			//Edit details
			Route::get('/', 'UserDetailsController@showUserInfo')->name('user.details');
			Route::get('/update-details', 'UserDetailsController@showUpdateForm')->name('user.update-details');
			Route::post('/update-details/{userID}', 'UserDetailsController@updateDetails');
			//Register addresses
			Route::get('/register-addresses', 'UserAddressesController@showRegistrationForm')->name('user.register-addresses');
			Route::post('/register-addresses', 'UserAddressesController@register')->name('user.register-addresses.submit');
			//Edit addresses
			Route::get('/update-home-address', 'UserHomeAddressesController@showUpdateForm')->name('user.update-home-address');
			Route::post('/update-home-address/{userID}', 'UserHomeAddressesController@updateDetails')->name('user.submit.home-updates');
			Route::get('/update-pay-address', 'UserPayAddressesController@showUpdateForm')->name('user.update-pay-address');
			Route::post('/update-pay-address/{userID}', 'UserPayAddressesController@updateDetails')->name('user.submit.pay-updates');
		});
		//Handle responses
		Route::get('/accept-response/{responseID}', 'UserResponseController@acceptResponse')->name('acceptResponse');
		Route::get('/ignore-response/{responseID}', 'UserResponseController@ignoreResponse')->name('ignoreResponse');

		Route::get('/test-mail/{responseID}', 'UserResponseController@acceptResponse')->name('testMail');
	});

	Route::prefix('company')->group(function()
	{
		Route::get('/register', 'Auth\CompanyRegisterController@showRegistrationForm')->name('company.register');
		Route::post('/register', 'Auth\CompanyRegisterController@register')->name('company.register.submit');
		Route::get('/login', 'Auth\CompanyLoginController@showLoginForm')->name('company.login');
		Route::post('/login', 'Auth\CompanyLoginController@login')->name('company.login.submit');
		// Password reset routes
		Route::post('/password/email', 'Auth\CompanyForgotPasswordController@sendResetLinkEmail')->name('company.password.email');
		Route::get('/password/reset', 'Auth\CompanyForgotPasswordController@showLinkRequestForm')->name('company.password.request');
		Route::post('/passsudword/reset', 'Auth\CompanyResetPasswordController@reset');
		Route::get('/password/reset/{token}', 'Auth\CompanyResetPasswordController@showResetForm')->name('company.password.reset');

		Route::post('logout', 'Auth\CompanyLoginController@logout')->name('company.logout');
		Route::get('/', 'CompanyController@getDBInfo')->name('company.dashboard');
		//Get User Requests
		Route::get('/user-requests', 'UserRequestUpdateController@getUserRequests')->name('company.user-requests');

		//Fill in company info
		Route::get('/register-details', 'CompanyDetailsController@showRegistrationForm')->name('company.fillInfo');
		Route::post('/register-details', 'CompanyDetailsController@register')->name('company.register.submit_details');
		//Update company info
		Route::get('/update-details/{companyID}', 'CompanyDetailsController@showUpdateForm')->name('company.update-details');
		Route::post('/update-details/{companyID}', 'CompanyDetailsController@updateDetails')->name('company.submit.detail-updates');
		Route::get('/update-services/{companyID}', 'CompanyDetailsController@showUpdateFormServices')->name('company.update-services');
		Route::post('/update-services/{companyID}', 'CompanyDetailsController@updateServices')->name('company.submit.update-services');

		Route::get('/add-services', 'CompanyDetailsController@showRegistrationFormAddService')->name('company.add-services');
		Route::post('/add-services', 'CompanyDetailsController@registerNewService')->name('company.submit.add-services');
		//Company accepts requests
		Route::get('/accept-request/{userID}', 'UserRequestUpdateController@submitAcceptRequest');
		Route::get('/response-submitted/', 'UserRequestUpdateController@showResponseConfirmation')->name('accept.request');

	});
});

Route::get('/', function () {
	if (App::getLocale() == 'en')
		return view('welcome');
	else
		return view('no.velkommen');

})->name('welcome');

//Changing languages User and company middlewares
Route::get('/changed-to-en', 'ChangeLanguageController@changeToEn')->name('changeLanguageEn');
Route::get('/changed-to-no', 'ChangeLanguageController@changeToNo')->name('changeLanguageNo');
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
