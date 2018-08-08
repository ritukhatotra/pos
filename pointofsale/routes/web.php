<?php

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
/* admin login*/
Route::get('/','AdminController@getSignin');
Route::get('login','AdminController@getSignin');
Route::post('admin/signin','AdminController@postSignin');
Route::get('admin/dashboard','AdminController@dashboard');
Route::get('admin/logout','AdminController@logout');

/* customer */
Route::get('admin/new-customer','CustomerController@newCusotmer');
Route::get('admin/customers','CustomerController@cusotmerList');
Route::post('save-customer','CustomerController@saveCusotmer');
Route::get('admin/customer/edit/{id}','CustomerController@editCustomer');
Route::post('update-customer','CustomerController@updateCusotmer');
Route::get('admin/customer/deleteProfilePhoto/','CustomerController@deleteProfilePhoto');

/* employee */
Route::get('admin/new-employee','EmployeeController@newEmployee');
Route::get('admin/employees','EmployeeController@employeeList');
Route::post('save-employee','EmployeeController@saveEmployee');
Route::get('admin/employee/edit/{id}','EmployeeController@editEmployee');
Route::post('update-employee','EmployeeController@updateEmployee');

/* item */
Route::get('admin/items','ItemController@itemList');
Route::get('admin/new-item','ItemController@newItem');
Route::get('admin/new-item/redirect','ItemController@redirect');
