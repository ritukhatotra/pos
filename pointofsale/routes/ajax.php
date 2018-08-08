<?php
/* customer */
Route::post('getState','AjaxController@getState');
Route::post('checkCustomerPhone','AjaxController@checkCustomerPhone');
Route::post('checkCustomerEmail','AjaxController@checkCustomerEmail');
Route::post('checkCustomerAccount','AjaxController@checkCustomerAccount');
Route::post('search','AjaxController@searchData');
Route::post('show-search-data','AjaxController@displayData');

/* employee */
Route::post('checkEmployeePhone','AjaxController@checkEmployeePhone');
Route::post('checkEmployeeEmail','AjaxController@checkEmployeeEmail');
Route::post('checkUsername','AjaxController@checkUsername');

/* item */
Route::post('save-item','AjaxController@saveItem');
