<?php
Route::get('/', 'WelcomeController@welcome')->name('welcome');
Auth::routes();
Route::group(['middleware' => ['web', 'activity']], function () {
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);
    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
	Route::get('/admin/home', ['as' => 'admin.home',   'uses' => 'LoginController@index']);
	
});

Route::group(['middleware' => ['auth', 'activated', 'activity']], function () {
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep']], function () {
	Route::get('/admin/home', ['as' => 'admin.home',   'uses' => 'UserController@index']);
    Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep']], function () {
    $this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
	$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');
});

Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep']], function () {
	
	Route::resource('admin/doners', 'Admin\DonersController');
    Route::delete('doners_mass_destroy', ['uses' => 'Admin\DonersController@massDestroy', 'as' => 'users.mass_destroy']);
	Route::get('donergifts/{id}', ['uses' => 'Admin\DonersController@donergifts', 'as' => 'users.donergifts']);
	Route::get('doner/gifts/{id}', ['uses' => 'Admin\DonersController@donergiftssingle', 'as' => 'users.doner.gifts']);
	
    Route::resource('admin/distributors', 'Admin\DistributorsController');
    Route::delete('distributors_mass_destroy', ['uses' => 'Admin\DistributorsController@massDestroy', 'as' => 'distributors.mass_destroy']);
	
	Route::resource('childrens', 'Admin\ChildrensController');
    Route::delete('childrens_perma_del', ['uses' => 'Admin\ChildrensController@perma_del', 'as' => 'childrens.perma_del']);
	
    Route::get('admin/imports', ['uses' => 'Admin\ImportsController@index', 'as' => 'imports.index']);
    Route::post('admin/imports/csv', ['uses' => 'Admin\ImportsController@import', 'as' => 'imports.import']);
	
	
});


Route::group(['middleware' => ['auth', 'activated', 'role:donor', 'activity', 'twostep']], function () {
	
	Route::get('childrenslist','Doner\ChildrenslistController@index')->name('childrenslist.index');
	Route::get('childrenslist/{id}','Doner\ChildrenslistController@show')->name('childrenslist.show');
	Route::get('sendgift/{id}','Doner\ChildrenslistController@sendgift')->name('childrenslist.sendgift');
	Route::post('sendgifts','Doner\ChildrenslistController@sendgifts')->name('childrenslist.sendgifts');
	Route::post('selectdistributed','Doner\ChildrenslistController@distributed')->name('gifts.distributed');
	 
	Route::resource('gifts', 'Admin\GiftsController');
    Route::post('gifts_mass_destroy', ['uses' => 'Admin\GiftsController@massDestroy', 'as' => 'gifts.mass_destroy']);
	
	
	Route::resource('ordertrack', 'Doner\OrdertrackController'); 
	Route::get('showgifts/{ids}', 'Doner\OrdertrackController@showgifts')->name('doner.sendgifts');  
	
}); 


Route::group(['middleware' => ['auth', 'activated', 'role:warehouse', 'activity', 'twostep']], function () {


});

