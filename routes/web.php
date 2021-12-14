<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();
Route::group(array('before' => 'auth'), function() 
{

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', function () {
    Auth::logout();
   return redirect('/login');
});

Route::get('/prf', 'PrfController@index');
Route::get('/prf/create-prf', 'PrfController@create');
Route::post('/prf/create-prf/store', 'PrfController@store');
Route::get('/prf/view-prf/{id}', 'PrfController@view');
Route::get('/prf/edit-prf/{id}', 'PrfController@edit');
Route::post('/prf/update-prf/{id}', 'PrfController@update');
Route::post('/prf/submit', 'PrfController@submit');
Route::post('/prf/delete-prf', 'PrfController@deleteCreated');

Route::get('/approvals', 'ApprovalController@index');
Route::get('/approvals/review-prf/{id}', 'ApprovalController@view');
Route::post('/approvals/save-review/{id}', 'ApprovalController@save_review');
Route::get('/approvals/edit-review/{id}', 'ApprovalController@edit_review');
Route::post('/approvals/update-review/{id}', 'ApprovalController@update_review');
Route::post('/approvals/return', 'ApprovalController@return_to_investigator');
Route::post('/approvals/approve', 'ApprovalController@approve_prf');
Route::get('/approvals/generate-comment-form/{id}', 'ApprovalController@generate_comment_form');
Route::get('/approvals/generate-prf/{id}', 'ApprovalController@generate_prf');
Route::get('/approvals/generate-forms/{id}', 'ApprovalController@generate_forms');
Route::get('/approvals/process-approval/{id}', 'ApprovalController@process_approval');
Route::post('/approvals/review-prf/upload_attachment', 'ApprovalController@upload_attachment');
Route::post('/approvals/review-prf/remove_attachment', 'ApprovalController@remove_attachment');
Route::post('/approvals/sec-approval-submit/{id}', 'ApprovalController@sec_approval_submit');

//approved

Route::get('/approved', 'ApprovedController@index');
Route::get('/approved/review/{id}', 'ApprovedController@review');

//rejected

Route::get('/resubmit', 'RejectedController@index');

//add and edit protocol #
Route::post('/prf/updateProtocolNo', 'ApprovalController@updateProtocol');


Route::post('/prf/updateCategory', 'ApprovalController@updateCategory');

Route::post('/prf/updateDuration', 'ApprovalController@updateDuration');


//user
Route::get('/user', 'UserController@index');
Route::get('/user/create', 'UserController@create');
Route::post('/user/store', 'UserController@store');
Route::get('/user/edit/{id}', 'UserController@edit');
Route::post('/user/update/{id}', 'UserController@update');
Route::get('/user/password', 'UserController@changePassword');
Route::post('/user/password/update', 'UserController@updatePassword');
Route::get('/user/userPassword/{id}', 'UserController@changeUserPassword');
Route::post('/user/updateUserPassword/{id}', 'UserController@updateUserPassword');
//endofUserMaintenance
});


