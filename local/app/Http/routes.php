<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
 // Normal routes here
    //User routes

Route::get('/', 'Auth\AuthController@Login');
Route::post('login', 'Auth\AuthController@Authenticate');
Route::get('logout', 'Auth\AuthController@getLogout');
//forgot password routes
Route::get('forgotpassword','UserController@viewforgotPassword');
Route::post('forgotpassword','UserController@forgotPassword');
Route::get('verifyforgotPassword/{vdata}',['as'=>'verifyforgotPassword','uses'=>'UserController@verifyforgotPassword']);
Route::post('updatepassword','UserController@updatepassword');


Route::group(['middleware' => 'auth'], function()
{
Route::get('dashboard', function () {
    return view('dashboard');
});
//User type routes
Route::get('usertypelist','MasterController@usertypelist');
Route::get('usertypecreate','MasterController@usertypecreate');
Route::post('usertypesave','MasterController@usertypesave');
Route::get('usertypedit/{id}',[
    'as' => 'master.usertypedit',
    'uses' => 'MasterController@usertypedit'
]);
Route::get('usertypedelete/{id}',[
    'as' => 'master.usertypedelete',
    'uses' => 'MasterController@usertypedelete'
]);
Route::get('usertypeaction/{id}',[
    'as' => 'master.usertypeaction',
    'uses' => 'MasterController@usertypeaction'
]);
//Designation routes
Route::get('designationlist','MasterController@designationlist');
Route::get('designationcreate','MasterController@designationcreate');
Route::post('designationsave','MasterController@designationsave');
Route::get('designation/{id}',[
    'as' => 'master.designationedit',
    'uses' => 'MasterController@designationedit'
]);
Route::get('designationdelete/{id}',[
    'as' => 'master.designationdelete',
    'uses' => 'MasterController@designationdelete'
]);
Route::get('designationaction/{id}',[
    'as' => 'master.designationaction',
    'uses' => 'MasterController@designationaction'
]);
//Menu routes
Route::get('menulist','MasterController@menulist');
Route::get('menulist','MasterController@menulist');
Route::get('menucreate','MasterController@menucreate');
Route::post('menusave','MasterController@menusave');
Route::get('menu/{id}',[
    'as' => 'master.menuedit',
    'uses' => 'MasterController@menuedit'
]);
Route::get('menudelete/{id}',[
    'as' => 'master.menudelete',
    'uses' => 'MasterController@menudelete'
]);
Route::get('menuaction/{id}',[
    'as' => 'master.menuaction',
    'uses' => 'MasterController@menuaction'
]);
//User Routes
Route::get('profile','UserController@userprofile');
Route::post('profile','UserController@userprofileUpdate');

//change password routes
Route::get('settings','UserController@settings');
Route::post('settings','UserController@update_settings');
Route::get('createUser','UserController@createUser');
Route::get('users','UserController@users');
Route::post('createUser','UserController@usersave');
Route::get('editUsers/{id}',[
    'as' => 'users.useredit',
    'uses' => 'UserController@useredit'
]);
Route::get('deleteUsers/{id}',[
    'as' => 'users.userdelete',
    'uses' => 'UserController@userdelete'
]);
Route::get('usersaction/{id}',[
    'as' => 'users.usersaction',
    'uses' => 'UserController@userAction'
]);

//prison type routes
Route::get('createprisontype','MasterController@createPrisonType');
Route::get('prisontypelist','MasterController@prisonTypeList');
Route::post('prisontypesave','MasterController@prisonTypeSave');
Route::get('editprisontype/{id}',[
    'as' => 'master.editprisontype',
    'uses' => 'MasterController@editPrisonType'
]);
Route::get('deleteprisontype/{id}',[
    'as' => 'master.deleteprisontype',
    'uses' => 'MasterController@deletePrisonType'
]);
Route::get('prisontypeaction/{id}',[
    'as' => 'master.prisontypeaction',
    'uses' => 'MasterController@prisonTypeAction'
]);
//prison wing routes
Route::get('createprisonwing','MasterController@createPrisonWing');
Route::get('prisonwinglist','MasterController@prisonWingList');
Route::post('prisonwingsave','MasterController@prisonWingSave');
Route::get('editprisonwing/{id}',[
    'as' => 'master.editprisonwing',
    'uses' => 'MasterController@editPrisonWing'
]);
Route::get('deleteprisonWing/{id}',[
    'as' => 'master.deleteprisonwing',
    'uses' => 'MasterController@deletePrisonWing'
]);
Route::get('prisonwingaction/{id}',[
    'as' => 'master.prisonwingaction',
    'uses' => 'MasterController@prisonWingAction'
]);
//prisoner type routes
Route::get('createprisonertype','MasterController@createPrisonerType');
Route::get('prisonertypelist','MasterController@prisonerTypeList');
Route::post('prisonertypesave','MasterController@prisonerTypeSave');
Route::get('editprisonertype/{id}',[
    'as' => 'master.editprisonertype',
    'uses' => 'MasterController@editPrisonerType'
]);
Route::get('deleteprisonertype/{id}',[
    'as' => 'master.deleteprisonertype',
    'uses' => 'MasterController@deletePrisonerType'
]);
Route::get('prisonertypeaction/{id}',[
    'as' => 'master.prisonertypeaction',
    'uses' => 'MasterController@prisonerTypeAction'
]);
 
   
});


